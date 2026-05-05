@extends('layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('title')
    {{ trans('ambulance.add_new_ambulance') }}
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">{{ trans('ambulance.ambulances') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('ambulance.add_new_ambulance') }}</span>
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
                <form action="{{route('Ambulance.store')}}" method="post" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label>{{ trans('ambulance.car_number') }}</label>
                            <input type="text" name="car_number"  value="{{old('car_number')}}" class="form-control @error('car_number') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{ trans('ambulance.car_model') }}</label>
                            <input type="text" name="car_model"  value="{{old('car_model')}}" class="form-control @error('car_model') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{ trans('ambulance.car_year_made') }}</label>
                            <input type="number" name="car_year_made"  value="{{old('car_year_made')}}" class="form-control @error('car_year_made') is-invalid @enderror">
                        </div>

                        <div class="col">
                            <label>{{ trans('ambulance.car_type') }}</label>
                            <select class="form-control" name="car_type">
                                <option value="1">{{ trans('ambulance.owned') }}</option>
                                <option value="2">{{ trans('ambulance.rented') }}</option>
                            </select>
                        </div>

                    </div>
                    <br>

                    <div class="row">
                        <div class="col">
                            <h5>{{ trans('ambulance.driver_data') }}</h5>
                            <button type="button" class="btn btn-primary btn-sm mb-3" id="addDriverBtn">{{ trans('ambulance.add_driver') }}</button>
                        </div>
                    </div>

                    <div id="driversContainer">
                        <!-- Driver rows will be added here -->
                    </div>

                    <div class="row">
                        <div class="col">
                            <label>{{ trans('ambulance.car_notes') }}</label>
                            <textarea rows="5" cols="10" class="form-control" name="notes" placeholder="{{ trans('ambulance.car_notes_placeholder') }}"></textarea>
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
        const tDriverLabel = @json(trans('ambulance.driver'));
        const tDriverNameLabel = @json(trans('ambulance.driver_name'));
        const tDriverLicenseLabel = @json(trans('ambulance.driver_license_number'));
        const tDriverPhoneLabel = @json(trans('ambulance.driver_phone'));

        let driverCount = 0;

        function createDriverRow(index) {
            const driverRow = document.createElement('div');
            driverRow.className = 'driver-row card mb-3';
            driverRow.id = 'driver-' + index;
            driverRow.innerHTML = `
                <div class="card-header bg-light">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0">${tDriverLabel} #${index + 1}</h6>
                        </div>
                        <div class="col-auto">
                            ${index > 0 ? `<button type="button" class="btn btn-danger btn-sm" onclick="removeDriver(${index})">${@json(trans('ambulance.remove'))}</button>` : ''}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <label>${tDriverNameLabel} <span class="text-danger">*</span></label>
                            <input type="text" name="drivers[${index}][driver_name]"
                                value="${index === 0 ? "{{old('drivers.0.driver_name', '')}}" : ''}"
                                class="form-control @error('drivers.${index}.driver_name') is-invalid @enderror"
                                required>
                            @error('drivers.{{ $index }}.driver_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label>${tDriverLicenseLabel} <span class="text-danger">*</span></label>
                            <input type="text" name="drivers[${index}][driver_license_number]"
                                value="${index === 0 ? "{{old('drivers.0.driver_license_number', '')}}" : ''}"
                                class="form-control @error('drivers.${index}.driver_license_number') is-invalid @enderror"
                                required>
                            @error('drivers.{{ $index }}.driver_license_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label>${tDriverPhoneLabel} <span class="text-danger">*</span></label>
                            <input type="tel" name="drivers[${index}][driver_phone]"
                                value="${index === 0 ? "{{old('drivers.0.driver_phone', '')}}" : ''}"
                                class="form-control @error('drivers.${index}.driver_phone') is-invalid @enderror"
                                required>
                            @error('drivers.{{ $index }}.driver_phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            `;
            return driverRow;
        }

        function addDriver() {
            const container = document.getElementById('driversContainer');
            container.appendChild(createDriverRow(driverCount));
            driverCount++;
        }

        function removeDriver(index) {
            const row = document.getElementById('driver-' + index);
            if (row) {
                row.remove();
            }
        }

        // Initialize with one empty driver row
        document.addEventListener('DOMContentLoaded', function() {
            const addBtn = document.getElementById('addDriverBtn');
            if (addBtn) {
                addBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    addDriver();
                });
                // Add first driver row
                addDriver();
            }
        });
    </script>
@endsection
