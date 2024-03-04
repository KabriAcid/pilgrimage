<?php

use App\Http\Controllers\AlhajiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SpaceAllocationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\IDCardController;
use Illuminate\Support\Facades\Route;

Route::prefix('report')->middleware(['auth'])->group(function () {
Route::get('/qr', [QRController::class, 'show'])->name('generate_qr');
Route::get('/all-alhazai/', [ReportController::class, 'allAlhazai'])->name('all_alhazai');
Route::get('/alhazai/{status}/', [ReportController::class, 'alhazaiByAccomodation']);
Route::get('/uploaded-spaces', [ReportController::class, 'uploadedSpaces'] )->name('uploaded_spaces');
Route::post('/fetch-spaces', [ReportController::class, 'fetchUploadedSpaces'] )->name('fetch_spaces');
Route::get('/occupied-spaces', [ReportController::class, 'getOccupiedSpaces'] )->name('get_occupied_spaces');
Route::post('/fetch-occupied-spaces', [ReportController::class, 'fetchOccupiedSpaces'] )->name('fetch_occupied_spaces');
Route::get('/unoccupied-spaces', [ReportController::class, 'getUnOccupiedSpaces'] )->name('get_unoccupied_spaces');
Route::post('/fetch-unoccupied-spaces', [ReportController::class, 'fetchUnOccupiedSpaces'] )->name('fetch_unoccupied_spaces');
Route::get('/summary', [ReportController::class, 'reportSummary'] )->name('summary');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/warn', [LoginController::class, 'warnIntrusion']);
Route::get('/home', [HomeController::class, 'home']);
Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::get('/logout', [LoginController::class, 'logout']);


Route::prefix('properties')->middleware(['auth'])->group(function () {
    Route::get('/add', [PropertyController::class, 'create'])->name('add_property');
    // Only Accomodation can access it
    // Route::post('/store', [PropertyController::class, 'store'])->name('store_property');

    Route::get('/{property}/rooms', [PropertyController::class, 'index'])->name('property_rooms');
    Route::get('/{property}/details', [PropertyController::class, 'propertyDetails'])->name('property_details');
    Route::get('/{property}/{floor}/rooms', [PropertyController::class, 'propertyFloorRooms'])->name('floor_rooms');
    Route::get('/{property}/{room}/{bed_space}/details', [PropertyController::class, 'bedSpaceDetails'])->name('bed_space_details');
    Route::post('/{property}/picture', [PropertyController::class, 'storePropertyPicture'])->name('upload_propety_picture');
    Route::get('/{property}/{room}/room-bed-spaces', [RoomController::class, 'roomSpaces'])->name('room_bed_spaces');
});

Route::prefix('properties')->middleware(['auth', 'proftmanager'])->group(function () {
    
     Route::post('/store', [PropertyController::class, 'store'])->name('store_property');
     Route::post('/room/add-bed-spaces', [RoomController::class, 'addRoomSpaces'])->name('add_bed_spaces');
     Route::post('/room-spaces', [PropertyController::class, 'addRoomsAndSpaces'])->name('add_rooms_and_spaces');
    

   
});

Route::prefix('alhazai')->middleware(['auth', 'alhazaimanager'])->group(function () {
    
   //Route::get('/upload', [AlhajiController::class, 'uploadAlhazaiView'])->name('upload_alhazai');
    //Only Alhazai Manager Can do it
    Route::get('/download', [AlhajiController::class, 'alhazaiExcelTemplate'])->name('alhazai_excel_template');
    Route::post('/upload', [AlhajiController::class, 'storeUploadedAlhazai'])->name('store_uploaded_alhazai');
    Route::get('/officials', [AlhajiController::class, 'manageOfficials'])->name('manage_officials');
    Route::get('/download-officials', [AlhajiController::class, 'officialExcelTemplate'])->name('officials_excel_template');
    Route::post('/upload-officials', [AlhajiController::class, 'storeUploadedOfficials'])->name('store_uploaded_officials');
  
});
Route::prefix('alhazai')->middleware(['auth'])->group(function () {
    Route::get('/new', [AlhajiController::class, 'getForm'])->name('register_alhaji');
    Route::post('/new', [AlhajiController::class, 'storeAlhaji'])->name('alhajis.store');
    Route::get('/manage', [AlhajiController::class, 'index'])->name('manage_alhazai');
   
    Route::post('/{alhaji}/picture', [AlhajiController::class, 'storeAlhajiPicture'])->name('upload_alhaji_picture');

    Route::get('/all', [AlhajiController::class, 'listAlhazai'])->name('list_alhazai');
    Route::get('/{alhaji}/alhaji-bed-space', [AlhajiController::class, 'alhajiBedSpace'])->name('alhaji_space');

    Route::get('/{lga}/filter', [AlhajiController::class, 'filterAlhajis'])->name('alhazai.filter.alhajis');
    Route::get('/{lga}/{gender}/filter', [AlhajiController::class, 'filterAlhajisByLgaAndGender'])->name('alhazai.filter.lga_gender');
    Route::get('/id', [IDCardController::class, 'show'])->name('generate_ids');
});
Route::prefix('allocation')->middleware(['auth', 'allocationmanager'])->group(function () {
    //Only Accomodation Officer can handle it
    Route::get('/manage', [SpaceAllocationController::class, 'index'])->name('manage_allocation');
    Route::get('/officials', [SpaceAllocationController::class, 'allocateToOfficials'])->name('officials_allocation');
    Route::post('/officials', [SpaceAllocationController::class, 'storeAllocation'])->name('store_official_allocation');
    Route::post('/lga-gender', [SpaceAllocationController::class, 'allocationByLgaAndGender'])->name('lga_gender');
    Route::get('/special', [SpaceAllocationController::class, 'specialAllocation'])->name('special_allocation');
    Route::post('/store-special', [SpaceAllocationController::class, 'storeSpecialAllcation'])->name('store_special');
});

// Route::prefix('room')->middleware(['auth'])->group(function () {
 
//     //Only Property Manager
  
// });
Route::prefix('users')->middleware(['auth', 'superAdmin'])->group(function () {
    //Only super Admin
    // Route::get('/add-user', [UserController::class, 'addUserForm'])->name('add_user');
    Route::get('/role', [RoleController::class, 'index'])->name('role');
    Route::get('/list', [UserController::class, 'usersList'])->name('user_list');
    Route::post('/add-user', [UserController::class, 'storeUser'])->name('store_user');
    Route::post('/role', [RoleController::class, 'storeRole'])->name('add_role');
    Route::get('/{role}/delete', [RoleController::class, 'destroy'])->name('delete_role');
    Route::post('/asign-role', [RoleController::class, 'assignRoletoUser'])->name('assign_role');
    Route::get('/{user}/details', [UserController::class, 'userDetails'])->name('user_details');
});
