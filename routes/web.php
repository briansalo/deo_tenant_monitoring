<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\backend\tenant\TenantRegistrationController;

use App\Http\Controllers\backend\rental\AdvanceRentalPaymentController;
use App\Http\Controllers\backend\rental\UnpaidRentalController;

use App\Http\Controllers\backend\electricity\ElectricityPaymentController;
use App\Http\Controllers\backend\electricity\UnpaidElectricityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect()->route('tenant.view');
})->name('dashboard');


    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');





Route::prefix('tenant')->group(function(){

    Route::get('/view', [TenantRegistrationController::class, 'TenantView'])->name('tenant.view');

    Route::post('/store', [TenantRegistrationController::class, 'TenantStore'])->name('tenant.store');

        Route::get('/edit', [TenantRegistrationController::class, 'TenantEdit'])->name('tenant.edit');

 
}); // end of tenant prefix


Route::prefix('advance_payment')->group(function(){

    Route::get('/advance/rental/payment/add', [AdvanceRentalPaymentController::class, 'AdvanceRentalPaymentAdd'])->name('advance.rental.payment.add');
    Route::post('/advance/rental/payment/store', [AdvanceRentalPaymentController::class, 'AdvanceRentalPaymentStore'])->name('advance.rental.payment.store');
 
}); // end of advance_payment prefix


Route::prefix('Unpaid_Rental')->group(function(){

    Route::get('/unpaid/rental/view', [UnpaidRentalController::class, 'UnpaidRentalView'])->name('unpaid.rental.view');

     Route::get('/unpaid/rental/compute/penalty', [UnpaidRentalController::class, 'UnpaidRentalComputePenalty'])->name('unpaid.rental.compute.penalty');

 
}); // end of tenant prefix






Route::prefix('electricity_payment')->group(function(){

    Route::get('/electricity/payment/add', [ElectricityPaymentController::class, 'ElectricityPaymentAdd'])->name('electricity.payment.add');
    Route::post('/electricity/payment/store', [ElectricityPaymentController::class, 'ElectricityPaymentStore'])->name('electricity.payment.store'); 
 
}); // end of electricity_payment prefix



Route::prefix('unpaid_electricity')->group(function(){

    Route::get('/unpaid/electricity/view', [UnpaidElectricityController::class, 'UnpaidElectricityView'])->name('unpaid.electricity.view');

 
}); // end of electricity_payment prefix


