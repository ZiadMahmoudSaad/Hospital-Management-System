<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\Dashboard\SingleServiceController;
use App\Http\Controllers\Dashboard\InsuranceController;

use App\Livewire\GroupServices\CreateGroupServices;

//################################ Admin Routes ##############################################

Route::middleware([ 'auth:admin'])->group(function () {
        Route::get('admin', [DashboardController::class,'index_admin'])->name('admin.dashboard');

        //################################ section Routes ##############################################

        Route::get('sections', [SectionController::class,'index'])->name('sections.index');
        Route::post('sections/store', [SectionController::class,'store'])->name('Sections.store');
        Route::put('sections/update', [SectionController::class,'update'])->name('Sections.update');
        Route::delete('sections/destroy', [SectionController::class,'destroy'])->name('Sections.destroy');

        Route::get('sections/show/{id}', [SectionController::class,'show'])->name('Sections.show');

        //################################ End section Routes #########################################

        //################################ doctor Routes ##############################################

        Route::get('doctors', [DoctorController::class,'index'])->name('doctors.index');
        Route::post('doctors/store', [DoctorController::class,'store'])->name('Doctors.store');
        Route::get('doctors/create', [DoctorController::class,'create'])->name('Doctors.create');
        Route::get('doctors/{id}/edit', [DoctorController::class,'edit'])->name('Doctors.edit');
        Route::put('doctors', [DoctorController::class,'update'])->name('Doctors.update');
        Route::delete('doctors/{id}', [DoctorController::class,'destroy'])->name('Doctors.destroy');

        Route::put('doctors/update_status', [DoctorController::class,'update_status'])->name('Doctors.update_status');
        Route::put('doctors/update_password', [DoctorController::class,'update_password'])->name('Doctors.password_update');
       //################################ End doctor Routes #########################################


        //################################ Service Routes ##############################################

        Route::resource('Service',SingleServiceController::class);
        Route::get('Add_GroupServices',  CreateGroupServices::class)->name('Add_GroupServices');
        // Route::livewire('Add_GroupServices','livewire::group_services.create_group_services')->name('Add_GroupServices');
        // Route::view('Add_GroupServices','livewire.group_services.include_create')->name('Add_GroupServices');

       //################################ End Service Routes #########################################

               //############################# insurance route ##########################################

        Route::resource('insurance', InsuranceController::class);

        //############################# End insurance route ######################################
        // Route::put('doctors/{id}/update_appointment', [DoctorController::class,'update_appointment'])->name('Doctors.update_appointment');
});

//################################ End Admin Routes #########################################

//################################ User Routes ##############################################

Route::middleware(['auth:web'])->group(function () {
    Route::get('/user', [DashboardController::class, 'index'])->name('user.dashboard');
});

//################################ End User Routes #########################################



// Route::prefix( LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ])->group(function () {
//     // route here
// });

// Route::get('/', function () {
//     return view('dashboard.index');
// });
// Route::get('/login', [DashboardController::class, 'login'])->name('admin.login');
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', [DashboardController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

