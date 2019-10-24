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
    $mineCount = ceil(($mapSize['y'] * $mapSize['x']) * 0.25);

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

    function checkCell($map, $x, $y){
        $cell = $map[$y][$x];
        $nearbyMines = 0;
        $result = [
            'x' => $x,
            'y' => $y,
            'mine' => false,
            'nearby' => null,
            'player' => 3,
        ];

        if($cell['type'] == 'mine'){
            $result['mine'] = true;

            return $result;
        }

        // N
        if($map[$y][$x - 1]['type'] == "mine"){
            $nearbyMines++;
        }

        // NE
        if($map[$y + 1][$x - 1]['type'] == "mine"){
            $nearbyMines++;
        }

        // E
        if($map[$y + 1][$x]['type'] == "mine"){
            $nearbyMines++;
        }

        // SE
        if($map[$y + 1][$x + 1]['type'] == "mine"){
            $nearbyMines++;
        }

        // S
        if($map[$y][$x + 1]['type'] == "mine"){
            $nearbyMines++;
        }

        // SW
        if($map[$y - 1][$x + 1]['type'] == "mine"){
            $nearbyMines++;
        }

        // W
        if($map[$y - 1][$x]['type'] == "mine"){
            $nearbyMines++;
        }

        // NW
        if($map[$y - 1][$x - 1]['type'] == "mine"){
            $nearbyMines++;
        }

        $result['nearby'] = $nearbyMines;

        return $result;
    }

    return view('testgrid')->with([
        'map' => $map,
        'check' => checkCell($map, 19, 3)
    ]);
})->name('map');

Route::post('/message', 'MessageController@store')->name('message.store');