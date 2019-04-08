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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('circle/{radius}', 'CircleController@index');
Route::get('triangle/{a}/{b}/{c}', 'TriangleController@index');

// Ovaj dio zadatka mi nije bio najjasniji pa sam improvizirao (predpostavio sam da Vas ne zanima samo a+b)
// za sumu dva kruga saljete a (radius) i b (radius) (to je minimum koji se salje na ovu rutu)
// za sumu kruga i trokuta saljete a (radius) i b, c, d (stranice trokuta)
// za sumu dva trokuta saljete a, b, c (stranice trokuta 1) i d, e, f (stranice trokuta 2)
Route::get('calculator/{a}/{b}/{c?}/{d?}/{e?}/{f?}', 'CalculatorController@index');

Route::fallback(function () {
    $data = array(
        'status' => 'error',
        'message' => 'Unknown or wrong route!'
    );
    return Response::json($data, 500);
});
