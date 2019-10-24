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
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/{vue}', function () {
        return view('app');
    })->where('vue', '[\/\w\.-]*');
});

Route::namespace('api')->prefix('api')->group(function () {
    Route::get('user', function () {
        return \Auth::user();
    });
});


Route::get('/testgrid', function () {
    // Settings
    $map = [];
    $mapSize = [
        'x' => 50,
        'y' => 25
    ];
    $mineCount = ceil(($mapSize['y'] * $mapSize['x']) * 0.5);

    // Generate map
    for($y = 0; $y < $mapSize['y']; $y++){
        $map[$y] = [];
        for($x = 0; $x < $mapSize['x']; $x++){
            $map[$y][$x] = [
                'type' => "unknown"
            ];
        }
    }

    // Generate mines
    $mines = 0;
    while($mines < $mineCount){
        $x = rand(0, $mapSize['x'] - 1);
        $y = rand(0, $mapSize['y'] - 1);

        if($map[$y][$x]['type'] == "unknown"){
            $map[$y][$x]['type'] = "mine";
            $mines++;
        }
    }

    return view('testgrid')->with([
        'map' => $map
    ]);
})->name('map');

Route::post('/message', 'MessageController@store')->name('message.store');