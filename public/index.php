<?php

use IlluminateHttpRequest;

$app = require __DIR__.'/../bootstrap/app.php';

class Dev extends IlluminateDatabaseEloquentModel {
    protected $table = 'devs';
}

$app->get('dev', function() {
    return response()->json(Dev::all());
});

$app->get('dev/{id}', function($id) {
    return response()->json(Dev::find($id));
});

$app->post('dev', function(Request $request) {
    $dev = new Dev();
    $dev->name = $request->input('name');
    $dev->focus = $request->input('focus');
    $dev->hireDate = $request->input('hireDate');

    $dev->save();
    return response()->json($dev, 201);
});

$app->delete('dev/{id}', function($id) {
    Dev::find($id)->delete();
    return response('', 200);
});

$app->patch('dev/{id}', function(Request $request, $id) {
    $dev = Dev::find($id);
    $dev->name = $request->input('name', $dev->name);
    $dev->focus = $request->input('focus', $dev->focus);
    $dev->hireDate = $request->input('hireDate', $dev->hireDate);

    $dev->save();
    return response()->json($dev);
});

$app->run();
