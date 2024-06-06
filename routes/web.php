<?php

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Admin\AjaxDataController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContractorController;
use App\Http\Controllers\Admin\LoadDataController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Front\FontendController;
use Illuminate\Support\Facades\Route;

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
Auth::routes();
/* start 301 pages */
Route::redirect('/home', '/', 301);
Route::redirect('/register', '/login', 301);
/* end 301 pages */

Route::get('/', [FontendController::class, 'index'])->name('home');
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    echo '<pre>';
    echo Artisan::output();
    echo '</pre>';
});
Route::get('/foo', function () {
    Artisan::call('storage:link');
    echo Artisan::output();
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    // Dashboard
    Route::get('/', [FontendController::class, 'adminHome'])->name('admin.home');
    Route::get('/load-data/{func}', [LoadDataController::class, 'loadData'])->name('admin.load_data');
    Route::post('/ajax/{func}', [AjaxDataController::class, 'getStringRaw'])->name('admin.getStringRaw');

    // User Module
    Route::resource('user', UserController::class, [
        'names' => ['index' => 'user.index'],
    ]);
    Route::get('userimage/{filename}', [UserController::class, 'displayUserImage'])->name('adminimage.displayUserImage');
    Route::post('/user/active-deactive', [UserController::class, 'ActiveDeactiveStatus'])->name('admin.user.active-deactive');

    // Media Manager
    Route::group(
        ['prefix' => 'media'],
        function (): void {
            Route::get('/', [MediaController::class, 'index'])->name('admin.media.index');
            Route::post('/store-upload', [MediaController::class, 'storeFile'])->name('admin.media.store_file');
            Route::post('/add-folder', [MediaController::class, 'addFolder'])->name('admin.media.add-folder');
            Route::delete('/delete-image', [MediaController::class, 'destroy'])->name('admin.media.destroy');
            Route::get(
                '/folder/{folder}',
                [MediaController::class, 'index']
            )
                ->name('admin.media.folder')
                ->where('folder', '[0-9]+');
            Route::post('file-upload', [MediaController::class, 'dropzoneStore'])->name('admin.dropzone.upload');
            Route::post('store', [MediaController::class, 'store'])->name('store');
            Route::post('uploads', [MediaController::class, 'uploads'])->name('uploads');
            Route::post('getfiledata', [MediaController::class, 'getfiledata'])->name('getfiledata');
        }
    );
    // File Manager
    Route::group(['prefix' => 'file-manager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    // Error Handler
    Route::get('/error-logs', [UserController::class, 'getErrorLogs'])->name('admin.user.error_log');
    // User Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
    Route::post('/update-profile-info', [ProfileController::class, 'updateInfo'])->name('adminUpdateInfo');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('adminChangePassword');
    Route::post('/profile', [ProfileController::class, 'update_avatar'])->name('updateavatar');
    Route::get('/setting', [SettingController::class, 'index']);
    Route::post('/settingupdate', [SettingController::class, 'updateSettings'])->name('settings-update');

    /* Customer list */
    Route::resource('/customer', CustomerController::class)->names([
        'index' => 'admin.customer.index',
    ]);
    /* Contractor list */
    Route::resource('/contractor', ContractorController::class)->names([
        'index' => 'admin.contractor.index',
    ]);
    /* START CONTACTS */
    Route::resource('/contacts', ContactController::class, [
        'names' => ['index' => 'admin.contacts'],
    ]);
    /* delete contact */
    Route::delete('/post-type/contacts/{id}/del', [ContactController::class, 'destroy'])->name('post-type.delete-contacts');
    /* page bulk action */
    Route::post('/post-type/contacts/bulk-action', [ContactController::class, 'bulkActionContact'])->name('post-type.bulk-action-contacts');
    /* END MODULES */

    Route::get('export/customer/excel', [ExportController::class, 'customerExportExcel'])->name('customer.export.excel');
    Route::get('export/contractor/excel', [ExportController::class, 'contractorExportExcel'])->name('contractor.export.excel');

});