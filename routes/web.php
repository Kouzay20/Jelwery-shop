<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*customer*/
Route::get('customers/customerhomepage',[ProductController::class,'customerhomepage']);
Route::get('customers/products',[ProductController::class,'products']);
Route::get('customers/contact',[ProductController::class,'contact']);
Route::get('customers/productsdetail',[ProductController::class,'productsdetail']);
Route::get('customers/checkout',[ProductController::class,'checkout']);
Route::get('customers/customerregister',[CustomerController::class,'customerregister']);
Route::post('customers/registerProcess',[CustomerController::class,'registerProcess']);
Route::post('customers/loginProcess',[CustomerController::class,'loginProcess']);
Route::get('customers/customerlogin',[CustomerController::class,'customerlogin']);
Route::get('customers/logout',[CustomerController::class,'logout']);


/*admin*/
/*Admin dashboard*/
// Route::get('customers/admin',[ProductController::class,'indexs']);

/*Admin login-check-logout*/
Route::get('admin/register',[ProductController::class,'register']);
Route::get('admin/adminindex',[AdminController::class,'adminindex'])->middleware('isLoggedAdmin');
Route::get('admin/adminlogin',[AdminController::class,'adminlogin'])->name('adminlogin');
Route::post('admin/checkLogin',[AdminController::class,'checkLogin'])->name('checkLogin');
Route::get('admin/logout',[AdminController::class,'logout'])->name('logout');

/*Product manage*/
Route::get('admin/productlist',[ProductController::class,'productsAdmin'])->name('productlist');
Route::get('admin/productadd',[ProductController::class,'productsAdd'])->name('addproduct');
// Route::get('admin/productadd',[ProductController::class,'productadd']);
Route::post('saveProduct',[ProductController::class,'save']);
Route::get('admin/productedit/{id}',[ProductController::class,'productedit']);
Route::post('update',[ProductController::class,'update']);
Route::get('admin/delete/{id}',[ProductController::class,'delete']);


/*Customer manage*/
Route::get('admin/customerlist',[ProductController::class,'Customershow'])->name('customerlist')->middleware('isLoggedAdmin');
Route::get('admin/customerdelete/{cid}',[ProductController::class,'customerdelete']);
Route::get('admin/customeredit/{cid}',[ProductController::class,'EditCustomer']);
Route::post('customerupdate',[ProductController::class,'customerupdate']);
Route::post('customersave',[ProductController::class,'customersave']);
// Route::get('customers/productsdetail',[ProductController::class,'productsdetail']);


/*Admin manage*/
Route::get('admin/adminlist',[AdminController::class,'adminShow'])->name('adminlist')->middleware('isLoggedAdmin');

Route::get('admin/admindelete/{aid}',[AdminController::class,'admindelete']);

Route::get('admin/adminadd',[AdminController::class,'adminadd'])->middleware('isLoggedAdmin');
Route::get('admin/adminedit/{aid}',[AdminController::class,'EditAdmin'])->middleware('isLoggedAdmin');
Route::post('adminupdate',[AdminController::class,'adminupdate'])->middleware('isLoggedAdmin');

Route::post('save',[AdminController::class,'save']);



