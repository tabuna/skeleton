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

use  :vendor\:package_name\Http\Screens\:package_nameList;
use  :vendor\:package_name\Http\Screens\:package_nameEdit;


Route::get('/hello', function () {
    return view(':_package_name::hello');
});


$this->router->screen('/{:_package_name}/edit', :package_nameEdit::class)->name('edit');
$this->router->screen('/create', :package_nameEdit::class)->name('create');
$this->router->screen('/', :package_nameList::class)->name('list');