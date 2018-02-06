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

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('gerbang.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/login', function () {
	return redirect()->route('gerbang.login');
});
Route::group(['prefix'=>'gerbang'], function(){
	Route::get('login','AuthCtrl@showLoginForm')->name('gerbang.login');
	Route::post('login','AuthCtrl@login')->name('gerbang.loginpost');
	Route::get('logout','AuthCtrl@logout')->name('gerbang.logout');
});
Route::group(['prefix'=>'backend','as'=>'backend.','namespace' => 'Backend','middleware' => 'auth'], function(){
	Route::get('/', 'DashboardCtrl@getIndex')->name('index');
	Route::get('dashboard/index', ['as' => 'dashboard.index', 'uses' => 'DashboardCtrl@getIndex']);
	
	
	
	Route::resource('officers', 'OfficerCtrl');
	/*Route::group(['prefix'=>'dokumen','as'=>'dokumen.'], function(){
		Route::get('/','DokumenCtrl@getIndex')->name('index');
		Route::get('/tambah','DokumenCtrl@getTambah')->name('tambah');
		Route::get('/array','DokumenCtrl@getInformasiArray')->name('getdata');
		Route::get('/{id}/edit','DokumenCtrl@getEdit')->name('edit');
		Route::delete('/{id}/delete','DokumenCtrl@postDelete')->name('delete');
		Route::post('/post','DokumenCtrl@postDokumen')->name('post');
		Route::get('{id}/download','DokumenCtrl@postDownload')->name('download');
	});*/
	//Layer
	/*
	Route::resource('layer', 'LayerCtrl',['only' => ['index', 'create', 'edit', 'destroy']]);
	Route::post('layer/post','LayerCtrl@postLayer')->name('layer.post');*/
	
	//Link
	Route::resource('link', 'LinkCtrl',['only' => ['index', 'create', 'edit', 'destroy']]);
	Route::post('link/post','LinkCtrl@postLink')->name('link.post');
	Route::post('link/postimage','LinkCtrl@postImage')->name('link.postimage');

	Route::resource('pengumuman', 'PengumumanCtrl',['only' => ['index', 'create', 'edit', 'destroy']]);
	Route::post('pengumuman/post','PengumumanCtrl@postPengumuman')->name('pengumuman.post');

	Route::get('setting/index', ['as' => 'setting.index', 'uses' => 'SettingCtrl@index']);
	Route::get('setting/profile', ['as' => 'setting.profile', 'uses' => 'SettingCtrl@profile']);
    //Route::get('setting/sop', ['as' => 'setting.sop', 'uses' => 'SettingCtrl@sop']);
	Route::post('setting', ['as' => 'setting.store', 'uses' => 'SettingCtrl@store']);
	//Route::resource('files', 'FileCtrl');
	Route::resource('log', 'LogCtrl', ['only' => ['index', 'show']]);
	//Route::resource('album', 'AlbumCtrl');
	//Route::resource('media', 'MediaCtrl',['only'=> ['index','create','store','edit','update','destroy']]);
	//Route::post('media/postimage', 'MediaCtrl@postimage')->name('media.postimage');

	Route::resource('faq', 'FaqCtrl');

	Route::resource('tags', 'TagCtrl',['only' => ['index', 'create', 'edit', 'destroy']]);
	Route::post('tags/post','TagCtrl@postTag')->name('tags.post');

	Route::resource('kategori', 'CategoryCtrl',['only' => ['index', 'create', 'edit', 'destroy']]);
	Route::post('kategori/post','CategoryCtrl@postCategory')->name('kategori.post');

	Route::resource('mobil', 'MobilCtrl',['only' => ['index', 'create', 'edit', 'destroy']]);
	Route::post('mobil/post','MobilCtrl@postMobil')->name('mobil.post');
	Route::resource('fasilitas', 'FasilitasCtrl',['only' => ['index', 'create', 'edit', 'destroy']]);
	Route::post('fasilitas/post','FasilitasCtrl@postFasilitas')->name('fasilitas.post');

	
	// User Profile
    Route::group(['prefix' => 'me'], function($router){
        $router->get('/', 'MeCtrl@index')->name('me.profile');
        $router->post('update-password', 'MeCtrl@updatePassword')->name('me.update_password');
	});
	
	Route::group(['prefix'=>'pengaturan'], function(){
		Route::get('user','UserCtrl@getIndex')->name('pengaturan.users');
		Route::get('user/tambah','UserCtrl@getTambah')->name('pengaturan.users.create');
		Route::post('user/post','UserCtrl@postAddEdit')->name('pengaturan.users.post');
		Route::get('user/edit/{id}','UserCtrl@getUbah')->name('pengaturan.users.edit');
		Route::delete('user/hapus/{id}','UserCtrl@postHapus')->name('pengaturan.users.delete');
		Route::get('user/aktif/{id}','UserCtrl@getAktifnonaktif')->name('pengaturan.users.na');
		Route::get('user/gantipassword','UserCtrl@getGantiPassword')->name('pengaturan.users.gantipassword');
		Route::post('user/gantipassword','UserCtrl@postGantiPassword')->name('pengaturan.users.gantipasswordpost');
		Route::get('user/resetpassword/{id}','UserCtrl@resetPassword')->name('pengaturan.users.resetpassword');
		Route::post('user/changephoto/{id}','UserCtrl@changePhoto')->name('pengaturan.users.postimage');
		Route::get('notify/{id}', ['as' => 'notify',   'uses' => 'UserCtrl@notifyJedi']);
		//Route::get('role','RoleCtrl@getIndex');
		//Route::get('role/setting/{id}','RoleCtrl@getSettingRole');
	});
});

Route::get('user/verify/{verification_code}', 'AuthCtrl@verifyUser');
//Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
//Route::post('password/reset', 'Auth\PasswordController@reset');
