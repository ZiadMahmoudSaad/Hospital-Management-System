@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
    {{ trans('ambulance.edit_ambulance') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('ambulance.ambulances') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('ambulance.edit_ambulance') }}</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
@include('dashboard.messages_alert')
<!-- row -->
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form action="{{route('Ambulance.update','test')}}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label>{{ trans('ambulance.car_number') }}</label>
                            <input type="text" name="car_number"  value="{{$ambulance->car_number}}" class="form-control @error('car_number') is-invalid @enderror">
                            <input type="hidden" name="id" value="{{$ambulance->id}}">
                        </div>

                        <div class="col">
                            <label>{{ trans('ambulance.car_model') }}</label>
                            <input type="text" name="car_model"  value="{{$ambulance->car_model}}" class="form-control @error('car_model') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{ trans('ambulance.car_year_made') }}</label>
                            <input type="number" name="car_year_made"  value="{{$ambulance->car_year_made}}" class="form-control @error('car_year_made') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{ trans('ambulance.car_type') }}</label>
                            <select class="form-control" name="car_type">
                                <option value="1" {{$ambulance->car_type == 1 ? 'selected':''}}>{{ trans('ambulance.owned') }}</option>
                                <option value="2" {{$ambulance->car_type == 2 ? 'selected':''}}>{{ trans('ambulance.rented') }}</option>
                            </select>
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col">
                            <h5>{{ trans('ambulance.drivers') }}</h5>
                            <button type="button" class="btn btn-primary btn-sm mb-3" id="addDriverBtn">{{ trans('ambulance.add_driver') }}</button>
                        </div>
                    </div>

                    <!-- Existing Drivers Section -->
                    <div id="existingDrivers">
                        @foreach($ambulance->drivers as $driver)
                            <div class="driver-row card mb-3" id="existing-driver-{{ $driver->id }}">
                                <div class="card-header bg-light">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="mb-0">{{ $driver->name }}</h6>
                                        </div>
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeExistingDriver({{ $driver->id }})">{{ trans('ambulance.remove') }}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <label>{{ trans('ambulance.driver_name') }}</label>
                                            <input type="text" name="existing_drivers[{{ $driver->id }}][driver_name]"
                                                value="{{ $driver->name }}" class="form-control">
                                        </div>
                                        <div class="col-4">
                                            <label>{{ trans('ambulance.driver_license_number') }}</label>
                                            <input type="text" name="existing_drivers[{{ $driver->id }}][driver_license_number]"
                                                value="{{ $driver->driver_license_number }}" class="form-control">
                                        </div>
                                        <div class="col-4">
                                            <label>{{ trans('ambulance.driver_phone') }}</label>
                                            <input type="tel" name="existing_drivers[{{ $driver->id }}][driver_phone]"
                                                value="{{ $driver->driver_phone }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- New Drivers Section -->
                    <div id="newDriversContainer">
                        <!-- New driver rows will be added here -->
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <label>{{ trans('ambulance.car_notes') }}</label>
                            <textarea rows="5" cols="10" class="form-control" name="notes">{{$ambulance->notes}}</textarea>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col">
                            <label>{{ trans('ambulance.activation_status') }}</label>
                            &nbsp;
                            <input name="is_available" {{$ambulance->is_available == 1 ? 'checked' : ''}} value="1" type="checkbox" class="form-check-input" id="exampleCheck1">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success">{{ trans('ambulance.save_data') }}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    <script src="{{URL::asset('dashboard/plugins/notify/js/notifIt.js')}}"></script>
    <script src="{{URL::asset('/plugins/notify/js/notifit-custom.js')}}"></script>

    <script>
        const tNewDriverLabel = @json(trans('ambulance.new_driver'));
        const tRemoveLabel = @json(trans('ambulance.remove'));
        const tDriverNameLabel = @json(trans('ambulance.driver_name'));
        const tDriverLicenseLabel = @json(trans('ambulance.driver_license_number'));
        const tDriverPhoneLabel = @json(trans('ambulance.driver_phone'));

        let newDriverCount = 0;
        const deletedDrivers = [];

        function createNewDriverRow(index) {
            const driverRow = document.createElement('div');
            driverRow.className = 'driver-row card mb-3';
            driverRow.id = 'new-driver-' + index;
            driverRow.innerHTML = `
                <div class="card-header bg-light">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0">${tNewDriverLabel} #${index + 1}</h6>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeNewDriver(${index})">${tRemoveLabel}</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <label>${tDriverNameLabel} <span class="text-danger">*</span></label>
                            <input type="text" name="new_drivers[${index}][driver_name]"
                                class="form-control" required>
                        </div>
                        <div class="col-4">
                            <label>${tDriverLicenseLabel} <span class="text-danger">*</span></label>
                            <input type="text" name="new_drivers[${index}][driver_license_number]"
                                class="form-control" required>
                        </div>
                        <div class="col-4">
                            <label>${tDriverPhoneLabel} <span class="text-danger">*</span></label>
                            <input type="tel" name="new_drivers[${index}][driver_phone]"
                                class="form-control" required>
                        </div>
                    </div>
                </div>
            `;
            return driverRow;
        }

        function addNewDriver() {
            const container = document.getElementById('newDriversContainer');
            container.appendChild(createNewDriverRow(newDriverCount));
            newDriverCount++;
        }

        function removeNewDriver(index) {
            const row = document.getElementById('new-driver-' + index);
            if (row) {
                row.remove();
            }
        }

        function removeExistingDriver(driverId) {
            const row = document.getElementById('existing-driver-' + driverId);
            if (row) {
                row.style.display = 'none';
                // Add hidden input to mark for deletion
                const deleteInput = document.createElement('input');
                deleteInput.type = 'hidden';
                deleteInput.name = 'deleted_drivers[]';
                deleteInput.value = driverId;
                document.querySelector('form').appendChild(deleteInput);
                deletedDrivers.push(driverId);
            }
        }

        // Initialize event listener
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('addDriverBtn');
            if (addBtn) {
                addBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    addNewDriver();
                });
            }
        });
    </script>
