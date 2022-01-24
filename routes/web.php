<?php

define('PAGINATION_COUNT','2');
Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home') ->middleware('verified');
Route::get('/',function(){

    return 'Home';
});
Route::get('/dashboard',function(){

    return 'Not adault';
})-> name('not.adault');

Route::get('fillable', 'CrudController@getOffers');
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ] ], function () {
    Route::group(['prefix' => 'offers'], function () {

        Route::get('create', 'CrudController@create');

        //Route::get('store', 'CrudController@store');
        Route::post('store', 'CrudController@store') -> name('offers.store');

        Route::get('edit/{offer_id}', 'CrudController@editOffer');
        Route::get('delete/{offer_id}', 'CrudController@delete')-> name('offers.delete');

    Route::post('update/{offer_id}', 'CrudController@updateOffer') -> name('offers.update');

    Route::get('all', 'CrudController@getAllOffers')-> name('offers.all');
    Route::get('get-inactive-offer', 'CrudController@getInactiveOffers');



    });

    Route::get('youtube', 'CrudController@gitVideo')->middleware('auth');

 });

 ############### ajax ##############



Route::group(['prefix' => 'ajax-offers'], function() {
 Route::get('create', 'OfferController@create');
    Route::post('store', 'OfferController@store') -> name('ajax.offers.store');
    Route::get('all', 'OfferController@all') -> name('ajax.offers.all');
    Route::post('delete', 'OfferController@delete') -> name('ajax.offers.delete');
    Route::get('edit/{offer_id}', 'OfferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'OfferController@Update')->name('ajax.offers.update');

});

 ###############  end ajax ##############


###########Begin Auth#########
Route::group(['middleware' => 'CheckAge','namespace'=>'Auth'], function() {
Route::get('adualt','CustomAuthController@adualt')->name('adult');



});

                                                                //middleware('auth')
 Route::get('site', 'Auth\CustomAuthController@site')->middleware('auth:web')-> name('site');
 Route::get('admin', 'Auth\CustomAuthController@admin')->middleware('auth:admin') -> name('admin');

Route::get('admin/login', 'Auth\CustomAuthController@adminLogin')-> name('admin.login');
Route::post('admin/login', 'Auth\CustomAuthController@checkAdminLogin')-> name('save.admin.login');


###########end Auth#########
##########################Relation############
 Route::get('has-one','Relation\RelationsController@hasOneRelation');
 Route::get('has-one-reserve','Relation\RelationsController@hasOneRelationReserve');
 Route::get('get-user-has-phone','Relation\RelationsController@getUserHasPhone');
 Route::get('get-user-has-not-phone','Relation\RelationsController@getUserHasNotPhone');
 Route::get('get-user-code','Relation\RelationsController@getUserIsCode');

##########################Relation############


##########################one to manyRelation############
Route::get('hospital-has-many','Relation\RelationsController@getHospitalDoctor');

Route::get('hospitals','Relation\RelationsController@hospitals')->name('hospital.all');
Route::get('hospitals/{hospitals_id}','Relation\RelationsController@deleteHospital')->name('hospital.delete');

Route::get('doctors/{hospitals_id}','Relation\RelationsController@doctors') -> name('hospital.doctors');
##########################
Route::get('hospitals-has-doctors','Relation\RelationsController@hospitalsHasDoctors');
Route::get('hospitals-has-doctors-male','Relation\RelationsController@hospitalsHasOnlyMale');
Route::get('hospitals-not-has-doctors','Relation\RelationsController@hospitalsNotHasDoctors');

##########################one to many Relation############






############# Many  To Many #############
Route::get('doctors-services','Relation\RelationsController@getDoctorService');

Route::get('services-doctors','Relation\RelationsController@getServiceDoctores');

Route::get('doctors/services/{doctor_id}','Relation\RelationsController@getDoctorServiceById') -> name('doctors.services');
Route::post('saveServices-to-doctor','Relation\RelationsController@saveServicesToDoctors') -> name('save.doctors.services');



############# Many  To Many #############

########has ona through##############
Route::get('has-one-through','Relation\RelationsController@getPatientDoctor');
Route::get('has-many-through','Relation\RelationsController@getCountrieDoctor');



########has ona through##############

########### accessors and mutators ##############

Route::get('accessors','Relation\RelationsController@getDoctor');//get data
Route::get('ahmed','SecondController@showString3');



########### accessors and mutators ##############