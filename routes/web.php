<?php

use Illuminate\Support\Facades\Route;

/** @var Illuminate\Support\Facades\Route $router */

$router->group([],function() use ($router){

    Auth::routes();

    $router->post('password/change', 'UserController@changePassword')->middleware('auth');

    $router->get('search', 'HomeController@search');

    $router->resource('discussion', 'DiscussionController', ['except' => 'destroy']);

    $router->group(['prefix' => 'user'], function () use ($router){
        $router->get('/', 'UserController@index');

        $router->group(['middleware' => 'auth'], function () use ($router){
            $router->get('profile', 'UserController@edit');
            $router->put('profile/{id}', 'UserController@update');
            $router->post('follow/{id}', 'UserController@doFollow');
            $router->get('notification', 'UserController@notifications');
            $router->post('notification', 'UserController@markAsRead');
        });

        $router->group(['prefix' => '{username}'], function () use ($router){
            $router->get('/', 'UserController@show');
            $router->get('comments', 'UserController@comments');
            $router->get('following', 'UserController@following');
            $router->get('discussions', 'UserController@discussions');
        });
    });

    $router->group(['middleware' => 'auth', 'prefix' => 'setting'], function () use ($router){
        $router->get('/', 'SettingController@index')->name('setting.index');
        $router->get('binding', 'SettingController@binding')->name('setting.binding');

        $router->get('notification', 'SettingController@notification')->name('setting.notification');
        $router->post('notification', 'SettingController@setNotification');
    });

    $router->get('link', 'LinkController@index');

    $router->group(['prefix' => 'category'], function () use ($router){
        $router->get('{category}', 'CategoryController@show');
        $router->get('/', 'CategoryController@index');
    });

    $router->group(['prefix' => 'tag'], function () use ($router){
        $router->get('/', 'TagController@index');
        $router->get('{tag}', 'TagController@show');
    });

    $router->group(['prefix' => 'dashboard', 'middleware' => ['auth', 'admin']], function () use ($router){
       $router->get('{path?}', 'HomeController@dashboard')->where('path', '[\/\w\.-]*');
    });

    $router->get('/', 'ArticleController@index');
    $router->get('{slug}', 'ArticleController@show');

});