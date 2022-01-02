<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\backend\payment\PaymentController;

use App\Http\Controllers\backend\acknowledgement\AcknowledgmentReceiptController;

use App\Http\Controllers\backend\tenant\TenantRegistrationController;

use App\Http\Controllers\backend\rental\UnpaidRentalController;

use App\Http\Controllers\backend\electricity\ElectricityPaymentController;

use App\Http\Controllers\backend\electricity\UnpaidElectricityController;

use App\Http\Controllers\backend\deepwell\DeepWellController;

use App\Http\Controllers\backend\to_do\ToDoRegisterController;

use App\Http\Controllers\backend\official_receipt\OfficialReceiptRecordController;

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


Route::middleware(['auth:sanctum', 'verified'])->get('', function () {
    return redirect()->route('tenant.view');
})->name('dashboard');


    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');





Route::prefix('tenant')->group(function(){

    Route::get('/tenant_view', [TenantRegistrationController::class, 'TenantView'])->name('tenant.view');

    Route::get('/tenant_add', [TenantRegistrationController::class, 'TenantAdd'])->name('tenant.add');
    Route::post('/tenant_store', [TenantRegistrationController::class, 'TenantStore'])->name('tenant.store');

    Route::get('/tenant_edit/{tenant_id}', [TenantRegistrationController::class, 'TenantEdit'])->name('tenant.edit');
    Route::post('/tenant_update/{tenant_id}', [TenantRegistrationController::class, 'TenantUpdate'])->name('tenant.update');

    Route::get('/tenant_deactivate/{tenant_id}', [TenantRegistrationController::class, 'TenantDeactivate'])->name('tenant.deactivate');
    Route::get('/tenant_activate/{tenant_id}', [TenantRegistrationController::class, 'TenantActivate'])->name('tenant.activate');

 
}); // end of tenant prefix


Route::prefix('manage')->group(function(){

    //official receipt
    Route::get('/official_receipt/view', [OfficialReceiptRecordController::class, 'OfficialReceiptView'])
        ->name('official.receipt.view');

    Route::get('/official_receipt/edit/{or_number}', [OfficialReceiptRecordController::class, 'OfficialReceiptEdit'])
        ->name('official.receipt.edit');
    Route::post('/official_receipt/update/{or_number}', [OfficialReceiptRecordController::class, 'OfficialReceiptUpdate'])
        ->name('official.receipt.update');

       //acknowlegment receipt 
    Route::get('/acknowledgment_receipt/view', [AcknowledgmentReceiptController::class, 'AcknowledgmentReceiptView'])
        ->name('acknowledge.receipt.view');

    Route::get('/acknowledge_receipt/edit/{ar_number}', [AcknowledgmentReceiptController::class, 'AcknowledgmentReceiptEdit'])
        ->name('acknowledge.receipt.edit');
    Route::post('/acknowledge_receipt/update/{ar_number}', [AcknowledgmentReceiptController::class, 'AcknowledgmentReceiptUpdate'])
        ->name('acknowledge.receipt.update');

    //payment
    Route::get('/payment/add', [PaymentController::class, 'PaymentAdd'])->name('payment.add');
    Route::post('/payment/store', [PaymentController::class, 'PaymentStore'])->name('payment.store');

    Route::get('/payment/edit/{or_number}', [PaymentController::class, 'PaymentEdit'])->name('payment.edit');
    Route::post('/payment/update/{or_number}', [PaymentController::class, 'PaymentUpdate'])->name('payment.update');

});// manage prefix


Route::prefix('unpaid_bill')->group(function(){

    Route::get('/unpaid/rental/view', [UnpaidRentalController::class, 'UnpaidRentalView'])->name('unpaid.rental.view');
    Route::get('/unpaid/rental/compute/penalty', [UnpaidRentalController::class, 'UnpaidRentalComputePenalty'])
     ->name('unpaid.rental.compute.penalty');

    Route::get('/unpaid/electricity/view', [UnpaidElectricityController::class, 'UnpaidElectricityView'])
        ->name('unpaid.electricity.view');

    Route::get('/unpaid/deepwell/view', [DeepWellController::class, 'UnpaidDeepwellView'])
        ->name('unpaid.deepwell.view');

});// unpaid bill prefix




Route::prefix('to_do_list')->group(function(){

    Route::get('/to_do/view', [ToDoRegisterController::class, 'TodoView'])->name('to_do.view');

    Route::get('/to_do/add', [ToDoRegisterController::class, 'TodoAdd'])->name('to_do.add');
    Route::post('/to_do/store', [ToDoRegisterController::class, 'TodoStore'])->name('to_do.store');

    Route::get('/to_do/delete/{tenant_id}', [ToDoRegisterController::class, 'TodoDelete'])->name('to_do.delete');

 
}); // end of todo prefix

