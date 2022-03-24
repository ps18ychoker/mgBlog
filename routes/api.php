<?php

/** @var Illuminate\Support\Facades\Route $router */

$router->group([
    'namespace' => 'Api',
],function() use ($router) {

    $router->group(['middleware' => ['auth:api', 'admin'],], function () use ($router){
        $router->get('statistics', 'HomeController@statistics');

        $router->get('user', 'UserController@index')->middleware(['permission:list_user']);
        $router->post('user', 'UserController@store')->middleware(['permission:create_user']);
        $router->get('user/{id}/edit', 'UserController@edit')->middleware(['permission:update_user']);
        $router->patch('user/{id}', 'UserController@update')->middleware(['permission:update_user']);
        $router->delete('user/{id}', 'UserController@destroy')->middleware(['permission:destroy_user']);
        $router->post('/user/{id}/status', 'UserController@status')->middleware(['permission:update_user']);

        $router->get('article', 'ArticleController@index')->name('api.article.index')->middleware(['permission:list_article']);
        $router->post('article', 'ArticleController@store')->name('api.article.store')->middleware(['permission:create_article']);
        $router->get('article/{id}/edit', 'ArticleController@edit')->name('api.article.edit')->middleware(['permission:update_article']);
        $router->patch('article/{id}', 'ArticleController@update')->name('api.article.update')->middleware(['permission:update_article']);
        $router->delete('article/{id}', 'ArticleController@destroy')->name('api.article.destroy')->middleware(['permission:destroy_article']);

        $router->get('category', 'CategoryController@index')->middleware(['permission:list_category']);
        $router->post('category', 'CategoryController@store')->middleware(['permission:create_category']);
        $router->get('category/{id}/edit', 'CategoryController@edit')->middleware(['permission:update_category']);
        $router->patch('category/{id}', 'CategoryController@update')->middleware(['permission:update_category']);
        $router->delete('category/{id}', 'CategoryController@destroy')->middleware(['permission:destroy_category']);
        $router->get('/categories', 'CategoryController@getList')->middleware(['permission:create_article|update_article']);

        $router->get('discussion', 'DiscussionController@index')->middleware(['permission:list_discussion']);
        $router->post('discussion', 'DiscussionController@store')->middleware(['permission:create_discussion']);
        $router->get('discussion/{id}/edit', 'DiscussionController@edit')->middleware(['permission:update_discussion']);
        $router->patch('discussion/{id}', 'DiscussionController@update')->middleware(['permission:update_discussion']);
        $router->delete('discussion/{id}', 'DiscussionController@destroy')->middleware(['permission:destroy_discussion']);
        $router->post('/discussion/{id}/status', 'DiscussionController@status')->middleware(['permission:update_discussion']);

        $router->get('comment', 'CommentController@index')->middleware(['permission:list_comment']);
        $router->get('comment/{id}/edit', 'CommentController@edit')->middleware(['permission:update_comment']);
        $router->patch('comment/{id}', 'CommentController@update')->middleware(['permission:update_comment']);
        $router->delete('comment/{id}', 'CommentController@destroy')->middleware(['permission:destroy_comment']);

        $router->get('tag', 'TagController@index')->middleware(['permission:list_tag']);
        $router->post('tag', 'TagController@store')->middleware(['permission:create_tag']);
        $router->get('tag/{id}/edit', 'TagController@edit')->middleware(['permission:update_tag']);
        $router->patch('tag/{id}', 'TagController@update')->middleware(['permission:update_tag']);
        $router->delete('tag/{id}', 'TagController@destroy')->middleware(['permission:destroy_tag']);

        $router->get('link', 'LinkController@index')->middleware(['permission:list_link']);
        $router->post('link', 'LinkController@store')->middleware(['permission:create_link']);
        $router->get('link/{id}/edit', 'LinkController@edit')->middleware(['permission:update_link']);
        $router->patch('link/{id}', 'LinkController@update')->middleware(['permission:update_link']);
        $router->delete('link/{id}', 'LinkController@destroy')->middleware(['permission:destroy_link']);
        $router->post('/link/{id}/status', 'LinkController@status')->middleware(['permission:update_link']);

        $router->get('role', 'RoleController@index')->middleware(['permission:list_role']);
        $router->post('role', 'RoleController@store')->middleware(['permission:create_role']);
        $router->get('role/{id}/edit', 'RoleController@edit')->middleware(['permission:update_role']);
        $router->patch('role/{id}', 'RoleController@update')->middleware(['permission:update_role']);
        $router->delete('role/{id}', 'RoleController@destroy')->middleware(['permission:destroy_role']);
        $router->get('permissions', 'PermissionsController@index')->middleware(['permission:update_role_permissions']);
        $router->post('role/{role}/permissions', 'RoleController@updateRolePermissions')->middleware(['permission:update_role_permissions']);

        $router->get('visitor', 'VisitorController@index')->middleware(['permission:list_visitor']);

        $router->get('upload', 'UploadController@index')->middleware(['permission:list_file']);
        $router->post('upload', 'UploadController@uploadForManager')->middleware(['permission:upload_file']);
        $router->post('folder', 'UploadController@createFolder')->middleware(['permission:create_file_folder']);
        $router->post('folder/delete', 'UploadController@deleteFolder')->middleware(['permission:destroy_file']);
        $router->post('file/delete', 'UploadController@deleteFile')->middleware(['permission:destroy_file']);

        $router->get('system', 'SystemController@getSystemInfo')->middleware(['permission:list_system_info']);
    });

    $router->post('file/upload', 'UploadController@fileUpload')->middleware('auth:api');

    $router->post('crop/avatar', 'UserController@cropAvatar')->middleware('auth:api');

    $router->get('commentable/{commentableId}/comment', 'CommentController@show')->middleware('api');
    $router->post('comments', 'CommentController@store')->middleware('auth:api');
    $router->delete('comments/{id}', 'CommentController@destroy')->middleware('auth:api');
    $router->post('comments/vote/{type}', 'MeController@postVoteComment')->middleware('auth:api');
    $router->get('tags', 'TagController@getList');

});
