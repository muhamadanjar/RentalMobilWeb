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
	return response()->json($user);
});

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::post('logout', 'AuthCtrl@logoutjwt');
    Route::get('test', function(){
        return response()->json(['foo'=>'bar'])->header('Authorization','Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3QvYXBpL2xvZ2luIiwiaWF0IjoxNTE2NDExNjU1LCJleHAiOjE1MTY0NDc2NTUsIm5iZiI6MTUxNjQxMTY1NSwianRpIjoiNEV2UHhxNFFTeUZWTVZuRSJ9.ftQjWB9lHK1LA8BveAsVAgFDc3dIu4xiq5SCOOuH37I');
        //return JWTAuth::parseToken()->authenticate();
    });
});



Route::get('/user', function () {
    try {
		if (! $user = JWTAuth::parseToken()->authenticate()) {
			return response()->json(['error'=>'user_not_found'], 404);
		}
	} catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
		return response()->json(['error'=>'token_expired'], $e->getStatusCode());
	} catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
		return response()->json(['error'=>'token_invalid'], $e->getStatusCode());
	} catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
		return response()->json(['error'=>'token_absent'], $e->getStatusCode());
	}
	// the token is valid and we have found the user via the sub claim
	$data = \App\User::find($user->id);
	return response(['user'=> [
		'id'=>$user->id,
		'name'=>$user->name,
		'email'=>$user->email,
		'uuid'=>$user->uuid,
		'username'=>$user->name,
		'foto'=>$user->foto,
		'customer'=>$user->customer],
		'customer'=>$user->customer],200);
});

Route::post('register', 'AuthCtrl@register')->name('api.register');
Route::post('login', 'AuthCtrl@loginjwt')->name('api.login');
Route::get('mobil','ApiCtrl@getAllMobil')->name('api.getmobil');
Route::get('mobil/{id}/status','ApiCtrl@updateStatusMobil')->name('api.updatestatusmobil');
Route::get('mobil/{id}/checkstatus','ApiCtrl@checkstatusmobil')->name('api.checkstatusmobil');
Route::get('totalmobil','ApiCtrl@getTotalMobil')->name('api.gettotalmobil');
Route::get('mobil/{id}/driverinfo','ApiCtrl@getDriverInfo')->name('api.getdriverinfo');
Route::get('mobil/datatable','ApiCtrl@getMobil')->name('api.getmobil');
Route::get('mobil/detail-data/datatable/{id}','ApiCtrl@getMobilDriver')->name('api.getmobil');

Route::get('reservation','ApiCtrl@getReservation')->name('api.getreservation');
Route::get('reservation/{id}/detail','ApiCtrl@getReservationDetailsData')->name('api.getreservationdetail');

Route::get('bookings/{id}/notcomplete','ApiCtrl@getReservationNotComplete')->name('api.notcomplete');
Route::get('bookings/{id}/bycustomer','ApiCtrl@getReservationByCustomer')->name('api.bycostumer');

Route::post('bookings','ApiCtrl@makeSewaRental')->name('api.makesewarental');
Route::post('bookings/reguler','ApiCtrl@makeSewaReguler')->name('api.makesewareguler');
Route::get('bookings/{id}/checkstatus','ApiCtrl@checkstatuspesanan')->name('api.checkstatuspesanan');
Route::get('bookings/{id}/cancelled','ApiCtrl@cancelledPesanan')->name('api.cancelpesanan');
Route::get('bookings/{id}/collected','ApiCtrl@cancelledPesanan')->name('api.collectpesanan');
Route::get('pemesananbulanan','ApiCtrl@getDataPemesananBulanan')->name('api.getpemesananbulanan');

Route::get('task','ApiCtrl@getTask')->name('api.gettask');
Route::get('promo','ApiCtrl@getPromo')->name('api.getpromo');


Route::post('customer/create','ApiCtrl@createCustomer')->name('api.customer.create');


Route::get('/getprovinsi',function ($id=''){
	return DB::table('wilayah_provinsi')->orderBy('nama_provinsi','ASC')->get();
});
Route::get('/getkabupaten/{id}',function ($id=''){
	return DB::table('wilayah_kabupaten')->where('kode_prov',$id)->orderBy('nama_kabupaten','ASC')->get();
});
Route::get('/getkecamatan/{id}',function ($id=''){
	return DB::table('wilayah_kecamatan')->where('kode_kab',$id)->get();
});
Route::get('/getdesa/{id}',function ($id=''){
	return DB::table('wilayah_desa')->where('kode_kec',$id)->get();
});