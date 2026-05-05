<?php

namespace App\Repository\Eloquent\Ambulances;

use App\Repository\Eloquent\BaseRepository;
use App\Interfaces\Ambulances\AmbulanceRepositoryInterface;
use App\Models\Ambulance;
class AmbulanceRepository extends BaseRepository implements AmbulanceRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct(Ambulance $model)
    {
        parent::__construct($model);
    }
    public function index()
    {
        $ambulances = $this->all();
        return view('Dashboard.Ambulances.index',compact('ambulances'));
    }

        public function create_view()
    {

        return view('dashboard.Ambulances.create');
    }


    public function store($request)
    {
        try {
            // Create the ambulance with car data only
            $ambulance = $this->create([
                'car_number' => $request->input('car_number'),
                'car_model' => $request->input('car_model'),
                'car_year_made' => $request->input('car_year_made'),
                'car_type' => $request->input('car_type'),
                'is_available' => 1,
                'notes' => $request->input('notes'),
            ]);

            // Process drivers - handle multiple drivers per ambulance
            $drivers = $request->input('drivers', []);

            if (!empty($drivers) && is_array($drivers)) {
                foreach ($drivers as $driverData) {
                    // Skip empty driver entries
                    if (empty($driverData['driver_name']) && empty($driverData['driver_license_number'])) {
                        continue;
                    }

                    // Create AmbulanceDriver record
                    $driver = $ambulance->drivers()->create([
                        'driver_license_number' => $driverData['driver_license_number'] ?? null,
                        'driver_phone' => $driverData['driver_phone'] ?? null,
                    ]);

                    // Store translatable fields (driver_name) in the default locale
                    $driver->name = $driverData['driver_name'] ?? null;
                    $driver->save();
                }
            }

            session()->flash('add');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit_view($id)
    {
        $ambulance = Ambulance::findorfail($id);
        return view('dashboard.Ambulances.edit',compact('ambulance'));
    }

    public function edit($request)
    {
        if (!$request->has('is_available'))
            $request->request->add(['is_available' => 2]);
        else
            $request->request->add(['is_available' => 1]);

        try {
            // Update ambulance car data and notes
            $this->update([
                'car_number' => $request->input('car_number'),
                'car_model' => $request->input('car_model'),
                'car_year_made' => $request->input('car_year_made'),
                'car_type' => $request->input('car_type'),
                'is_available' => $request->input('is_available'),
                'notes' => $request->input('notes'),
            ], $request->id);

            // Get the ambulance instance
            $ambulance = Ambulance::findOrFail($request->id);

            // Handle deleted drivers
            $deletedDrivers = $request->input('deleted_drivers', []);
            if (!empty($deletedDrivers)) {
                \App\Models\AmbulanceDriver::whereIn('id', $deletedDrivers)
                    ->where('ambulance_id', $ambulance->id)
                    ->delete();
            }

            // Handle existing drivers updates
            $existingDrivers = $request->input('existing_drivers', []);
            foreach ($existingDrivers as $driverId => $driverData) {
                // Skip if driver was deleted
                if (in_array($driverId, $deletedDrivers)) {
                    continue;
                }

                $driver = \App\Models\AmbulanceDriver::findOrFail($driverId);

                // Update basic fields
                $driver->update([
                    'driver_license_number' => $driverData['driver_license_number'] ?? $driver->driver_license_number,
                    'driver_phone' => $driverData['driver_phone'] ?? $driver->driver_phone,
                ]);

                // Update translatable field
                $driver->name = $driverData['driver_name'] ?? $driver->driver_name;
                $driver->save();
            }

            // Handle new drivers
            $newDrivers = $request->input('new_drivers', []);
            foreach ($newDrivers as $driverData) {
                // Skip empty driver entries
                if (empty($driverData['driver_name']) && empty($driverData['driver_license_number'])) {
                    continue;
                }

                $driver = $ambulance->drivers()->create([
                    'driver_license_number' => $driverData['driver_license_number'] ?? null,
                    'driver_phone' => $driverData['driver_phone'] ?? null,
                ]);

                // Store translatable fields
                $driver->name = $driverData['driver_name'] ?? null;
                $driver->save();
            }

            session()->flash('edit');
            return redirect()->route('Ambulance.index');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function destroy($id)
    {
        Ambulance ::destroy($id);
        session()->flash('delete');
        return redirect()->back();
    }
}
