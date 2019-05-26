<?php

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

use  :vendor\:package_name\Http\Screens\PackageList;
use  :vendor\:package_name\Http\Screens\PackageEdit;


Route::get('/', function () {
    return view(':package_name::hello');
});


$this->router->screen(':package_name/{:package_name}/edit', PackageEdit::class)->name('edit');
$this->router->screen(':package_name/create', PackageEdit::class)->name('create');
$this->router->screen(':package_name', PackageList::class)->name('list');