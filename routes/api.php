<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('userlogin', 'AuthController@userlogin');
Route::get('getprofile', 'AuthController@getprofile');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

$router->group(['prefix' => 'master'], function () use ($router) {
	Route::resource('role', 'MasterRoleController');
	Route::resource('employees', 'employeesController');
	Route::resource('dep', 'DepController');
	Route::resource('function', 'FunctionController');
	Route::resource('company', 'CompanyController');
	Route::resource('award', 'AwardController');
});
