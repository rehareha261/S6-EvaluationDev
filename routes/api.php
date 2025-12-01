<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Api\v1\Controllers\AccountingImportController;

Route::group(['prefix' => 'v1'], function () {
    Route::post('import/csv', [AccountingImportController::class, 'importCsv']);
    Route::post('import/excel', [AccountingImportController::class, 'importExcel']);
});