<?php

/**
 * Department
 *
 */
Route::group(['namespace' => 'Api\Gallery'], function () {
	Route::get('/gallery_setup_form', 'GallerySetupController@gallery_setup_form');
	Route::get('/gallery_setup', 'GallerySetupController@index');
	Route::post('/gallery_setup/store', 'GallerySetupController@store');
	Route::post('/gallery_setup/get_form_data', 'GallerySetupController@get_form_data');
	Route::post('/video_gallery/store', 'GallerySetupController@store_video_gallery');
	Route::post('/video_gallery/edit', 'GallerySetupController@edit_video_gallery');
	Route::post('/video_gallery/delete', 'GallerySetupController@delete_video_gallery');
	Route::post('/video_gallery/view', 'GallerySetupController@view_video_gallery');
	Route::get('/video_gallery/list', 'GallerySetupController@video_gallery_list');
	Route::get('/gallery_setup/gallerysetup_list', 'GallerySetupController@gallerysetup_list');
	Route::post('/gallery_setup/gallerysetup_edit', 'GallerySetupController@gallerysetup_edit');
	Route::post('/gallery_setup/gallerysetup_delete', 'GallerySetupController@gallerysetup_delete');
	Route::get('/gallery_setup/gallery_list', 'GallerySetupController@gallery_list');

	Route::post('/gallery_setup/edit', 'GallerySetupController@gallery_edit');
	Route::post('/gallery_setup/delete', 'GallerySetupController@gallery_delete');
	Route::post('/gallery_setup/update', 'GallerySetupController@gallery_update');
	Route::post('/gallery_setup/view', 'GallerySetupController@gallery_view');
	Route::post('/gallery/delete_single_image', 'GallerySetupController@delete_single_image');

	Route::post('/gallery/delete_temp_files', 'GallerySetupController@delete_temp_files');
	Route::post('/gallery/delete_uploaded_file', 'GallerySetupController@delete_uploaded_file');
});