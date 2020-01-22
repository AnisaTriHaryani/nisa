<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/siswa', ['uses' => 'SiswaController@show']);
$router->post('/siswa', ['uses' => 'SiswaController@store']);
$router->patch('/siswa/{id}',['uses' =>'SiswaController@update']);
$router->delete('/siswa/{id}',['uses' =>'SiswaController@delete']);
$router->get('/siswa/kelas/{id}',['uses' =>'SiswaController@showbykelas']);
$router->get('/siswa/sekolah/{id}',['uses' =>'SiswaController@showbysekolah']);
$router->get('/siswa/sekolah/kelas/{id}',['uses' =>'SiswaController@sortirkelas']);


$router->get('/kelas', ['uses' =>'KelasController@show']);
$router->post('/kelas', ['uses' =>'KelasController@store']);
$router->patch('/kelas/{id}',['uses' =>'KelasController@update']);
$router->delete('/kelas/{id}',['uses' =>'KelasController@delete']);


$router->get('/sekolah', ['uses' =>'SekolahController@show']);
$router->post('/sekolah', ['uses' =>'SekolahController@store']);
$router->patch('/sekolah/{id}',['uses' =>'SekolahController@update']);
$router->delete('/sekolah/{id}',['uses' =>'SekolahController@delete']);


