<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::post('recover', 'AuthCtrl@recover');
Route::get('/test2', function () {
    try {

		if (! $user = JWTAuth::parseToken()->authenticate()) {
			return response()->json(['user_not_found'], 404);
		}

	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

		return response()->json(['token_expired'], $e->getStatusCode());

	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

		return response()->json(['token_invalid'], $e->getStatusCode());

	} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

		return response()->json(['token_absent'], $e->getStatusCode());

	}

	// the token is valid and we have found the user via the sub claim
	return response()->json(compact('user'));
});

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::post('logout', 'AuthCtrl@logoutjwt');
    Route::get('test', function(){
        return response()->json(['foo'=>'bar'])->header('Authorization','Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3QvYXBpL2xvZ2luIiwiaWF0IjoxNTE2NDExNjU1LCJleHAiOjE1MTY0NDc2NTUsIm5iZiI6MTUxNjQxMTY1NSwianRpIjoiNEV2UHhxNFFTeUZWTVZuRSJ9.ftQjWB9lHK1LA8BveAsVAgFDc3dIu4xiq5SCOOuH37I');
        //return JWTAuth::parseToken()->authenticate();
    });
});

Route::get('user',function(){
	return 'foo';
});

Route::post('register', 'AuthCtrl@register')->name('api.register');
Route::post('login', 'AuthCtrl@loginjwt')->name('api.login');
Route::get('mobil','ApiCtrl@getAllMobil')->name('api.getmobil');
Route::get('totalmobil','ApiCtrl@getTotalMobil')->name('api.gettotalmobil');
Route::get('reservation','ApiCtrl@getReservation')->name('api.getreservation');
Route::post('bookings','ApiCtrl@makeSewa')->name('api.makesewa');
Route::get('pemesananbulanan','ApiCtrl@getDataPemesananBulanan')->name('api.getpemesananbulanan');