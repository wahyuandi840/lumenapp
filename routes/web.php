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

$router->get('/checklists/{checklistId}','ChecklistsController@showChecklistById');
$router->patch('/checklists/{checklistId}','ChecklistsController@updateChecklistById');
$router->delete('/checklists/{checklistId}','ChecklistsController@deleteChecklistById');
$router->post('/checklists','ChecklistsController@addChecklist');
