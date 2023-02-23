<?php

Route::group(['namespace' => 'Api\Frontend'], function () {
    Route::post('frontend_tiles/store', 'FrontendTilesController@store');
    Route::get('frontend_tiles/list', 'FrontendTilesController@list');
    Route::post('/frontend_tiles/edit', 'FrontendTilesController@edit');
    Route::post('/frontend_tiles/view', 'FrontendTilesController@view');
    Route::post('/frontend_tiles/delete', 'FrontendTilesController@delete');
});
