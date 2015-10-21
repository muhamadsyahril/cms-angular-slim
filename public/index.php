<?php

require '../vendor/autoload.php';
require '../models/Users.php';

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'slimapp_db',
    'username'  => 'root',
    'password'  => 'g3mb0k',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$app = new \Slim\Slim();

$app->get('/', function() use ($app) {
    readfile('index.html');
    $app->stop();
});


$app->get('/slimapp/users', function() {
    $users = Users::all();
    echo $users->toJson();
});

$app->get('/slimapp/users/:id', function($id) use($app) {
    $users = Users::find($id);
    if (is_null($users)) {
        $app->response->status(404);
        $app->stop();
    }
    echo $users->toJson();    
});

$app->post('/slimapp/users', function() use($app) {
    $body = $app->request->getBody();
    $obj = json_decode($body);
    $users = new Users;
    
    $users->username = $obj->{'username'};
    $users->email = $obj->{'email'};
    $users->password = $obj->{'password'};
    $users->updated_at = date("Y-m-d");
    $users->created_at = date("Y-m-d");
    $users->save();
    $app->response->status(201);
    echo $users->toJson();    
});

$app->put('/slimapp/users/:id', function($id) use($app) {
    $body = $app->request->getBody();
    $obj = json_decode($body);
    $users = Users::find($id);
    if (is_null($users)) {
        $app->response->status(404);
        $app->stop();
    }
    
    $users->username = $obj->{'username'};
    $users->email = $obj->{'email'};
    $users->password = $obj->{'password'};
    $users->updated_at = date("Y-m-d");

    $users->save();
    echo $users->toJson();    
});

$app->delete('/slimapp/users/:id', function($id) use($app) {
    $users = Users::find($id);
    if (is_null($users)) {
        $app->response->status(404);
        $app->stop();
    }
    $users->delete();
    $app->response->status(204);
});



$app->run();
