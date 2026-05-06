@extends('layouts.master')
@section('css')

@endsection
@section('title')
    {{ trans('patient.patient_information') }}
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('patient.patient_information') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ $Patient->name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-lg-12 col-md-12">
            <div class="card" id="basic-alert">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-1">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li class="nav-item"><a href="#tab1" class="nav-link active"
                                                                    data-toggle="tab">{{ trans('patient.patient_information') }}</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                    <div class="tab-content">
                                        {{-- Strat Show Information Patient --}}
                                        <div class="tab-pane active" id="tab1">
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-hover text-md-nowrap text-center">
                                                    <thead>
                                                    <tr>
                                                        
                                                        <th>{{ trans('patient.patient_name') }}</th>
                                                        <th>{{ trans('patient.phone_number') }}</th>
                                                        <th>{{ trans('patient.email') }}</th>
                                                        <th>{{ trans('patient.date_of_birth') }}</th>
                                                        <th>{{ trans('patient.gender') }}</th>
                                                        <th>{{ trans('patient.blood_group') }}
                                                    </thead>
                                                    <tbody>
                                                    <tr>

                                                        <td>{{$Patient->name}}</td>
                                                        <td>{{$Patient->Phone}}</td>
                                                        <td>{{$Patient->email}}</td>
                                                        <td>{{$Patient->Date_Birth}}</td>
                                                        <td>{{$Patient->Gender == 1 ? trans('patient.male') : trans('patient.female')}}</td>
                                                        <td>{{$Patient->Blood_Group}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        {{-- End Show Information Patient --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
@endsection
@section('js')
@endsection
