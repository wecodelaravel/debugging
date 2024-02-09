<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Static Seo
    Route::post('static-seos/media', 'StaticSeoApiController@storeMedia')->name('static-seos.storeMedia');
    Route::apiResource('static-seos', 'StaticSeoApiController');

    // Service
    Route::post('services/media', 'ServiceApiController@storeMedia')->name('services.storeMedia');
    Route::apiResource('services', 'ServiceApiController');

    // Testimonial
    Route::post('testimonials/media', 'TestimonialApiController@storeMedia')->name('testimonials.storeMedia');
    Route::apiResource('testimonials', 'TestimonialApiController');

    // Success Stories
    Route::post('success-stories/media', 'SuccessStoriesApiController@storeMedia')->name('success-stories.storeMedia');
    Route::apiResource('success-stories', 'SuccessStoriesApiController');

    // Page Section
    Route::apiResource('page-sections', 'PageSectionApiController');
});
