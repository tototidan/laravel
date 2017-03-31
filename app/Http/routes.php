<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//connexion
Route::get("login",
    array(
        "as" => "login",
        "uses" => "LoginsController@index"
    ));



Route::post("connexion",
    array(
        "as" => "connexion",
        "uses" => "LoginsController@connexion"
    ));

Route::get("deconnexion",
    array(
        "as" => "deconnexion",
        "uses" => "LoginsController@deconnexion"
    ));

Route::group(['middleware' => array("auth", "admin")], // s'execute avant controller, verifie si log

    function()
{

    Route::get("admin", "AdminsController@admin");

    Route::get("adminpp", "AdminsController@adminpp");

    route::get("addnotes", "NotesController@addnotes");

    route::get("addtags", "TagsController@show");

    Route::get('tags/{site}/delete', ['as' => 'tags.delete', 'uses' => 'TagsController@destroy']);

    Route::get("notes/store", ['as' => 'notes.store', 'uses' => 'NotesController@store']);

    Route::get("notes/{id}/update", ['as' => 'notes.update', 'uses' => 'NotesController@update']);

    Route::get('user/{site}/delete', ['as' => 'user.delete', 'uses' => 'UsersController@destroy']);

    Route::get('user/{site}/update', ['as' => 'user.update', 'uses' => 'UsersController@update']);

    Route::get('note/{site}/delete', ['as' => 'notes.delete', 'uses' => 'NotesController@destroy']);

    Route::get('commentaire/{site}/delete', ['as' => 'commentaire.delete', 'uses' => 'CommentairesController@destroy']);

    route::post('bindTtoU',"Tagscontroller@assignTagToUser");

    route::post('debindTtoU','TagsController@debindTagToUser');

    Route::resource("tags","TagsController");

    Route::get("bindTag" , 'TagsController@showUserTag');

});

Route::group(['middleware' => array("auth")], // s'execute avant controller, verifie si log

    function()
    {

        Route::get('/', "UsersController@index");

        Route::get("userpp", "UsersController@userpp");

        Route::resource("users","UsersController");

        Route::resource("commentaire", "CommentairesController");


    });
