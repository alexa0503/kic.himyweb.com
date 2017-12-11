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
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::any('/wechat', 'WechatController@serve');
Route::get('/', function () {
    return view('index');
});
Route::post('/info', function (Request $request) {
    $info = new App\Info;
    $info->name = $request->name;
    $info->qq = $request->qq;
    $info->team = $request->team;
    $info->telephone = $request->telephone;
    $info->save();
    return ['ret'=>0];
});
Route::group(['middleware' => ['role:superadmin,global privileges', 'menu'], 'prefix' => 'admin'], function () {
    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });
    Route::get('/dashboard', 'Admin\IndexController@index');
    Route::get('/export', 'Admin\IndexController@export');
    Route::any('/delete/{id}', 'Admin\IndexController@destroy');
});
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/install', function () {
    if (\App\User::count() == 0) {
        $role = Role::create(['name' => 'superadmin']);
        //$permission = Permission::create(['name' => 'global privileges']);
        $role->givePermissionTo('global privileges');
        $user = new \App\User();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('admin@2017');
        $user->save();
        $user->givePermissionTo('global privileges');
        $user->assignRole(['superadmin']);
        $user->roles()->pluck('name');
        $user->givePermissionTo('global privileges');
    }
    return redirect('/login');
});

Auth::routes();
