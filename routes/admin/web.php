<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PhotoController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('admin/login', [LoginController::class, 'getLogin']);
Route::post('admin/login', [LoginController::class, 'postLogin'])->name('login');

Route::prefix(LaravelLocalization::setLocale())
     ->middleware([

                      'localeSessionRedirect',
                      'localizationRedirect',
                      'localeViewPath',
                      'auth',
                      'role:admin|super_admin',
                  ])
     ->group(function () {
         Route::name('admin.')->prefix('admin')->group(function () {
             //Auth::routes();
             //home
             Route::get('/home/statistics', 'HomeController@topStatistics')->name('home.top_statistics');
             Route::get('/home', 'HomeController@index')->name('home');

             //Role routes
             Route::get('/roles/data', 'RoleController@data')->name('roles.data');
             Route::delete('/roles/bulk_delete', 'RoleController@bulkDelete')->name('roles.bulk_delete');
             Route::resource('roles', 'RoleController');

             //Admin routes
             Route::get('/admins/data', 'AdminController@data')->name('admins.data');
             Route::delete('/admins/bulk_delete', 'AdminController@bulkDelete')->name('admins.bulk_delete');
             Route::resource('admins', 'AdminController');

             //Sliders routes
             Route::get('/sliders/data', 'SliderController@data')->name('sliders.data');
             Route::delete('/sliders/bulk_delete', 'SliderController@bulkDelete')->name('sliders.bulk_delete');
             Route::resource('sliders', 'SliderController');

             //Users routes
             Route::get('/users/data', 'UserController@data')->name('users.data');
             Route::delete('/users/bulk_delete', 'UserController@bulkDelete')->name('users.bulk_delete');
             Route::resource('users', 'UserController');
             Route::get('/users/{id}/change-status', 'UserController@changeStatus')->name('users.changeStatus');

             //Users routes
             Route::get('/users/data', 'UserController@data')->name('users.data');
             Route::delete('/users/bulk_delete', 'UserController@bulkDelete')->name('users.bulk_delete');
             Route::resource('users', 'UserController');

             //Aqar types routes
             Route::get('/aqar-types/data', 'AqarTypeController@data')->name('aqar-types.data');
             Route::delete('/aqar-types/bulk_delete', 'AqarTypeController@bulkDelete')->name('aqar-types.bulk_delete');
             Route::resource('aqar-types', 'AqarTypeController');

             //Payment Methods routes
             Route::get('/payment-methods/data', 'PaymentMethodController@data')->name('payment-methods.data');
             Route::delete('/payment-methods/bulk_delete', 'PaymentMethodController@bulkDelete')->name('payment-methods.bulk_delete');
             Route::resource('payment-methods', 'PaymentMethodController');

             //regions routes
             Route::get('cities/{id}/regions/data', 'RegionController@data')->name('regions.data');
             Route::delete('/regions/bulk_delete', 'RegionController@bulkDelete')->name('regions.bulk_delete');
             Route::resource('cities.regions', 'RegionController');

             //Branches routes
             Route::get('companies/{id}/branches/data', 'BranchController@data')->name('branches.data');
             Route::delete('/branches/bulk_delete', 'BranchController@bulkDelete')->name('branches.bulk_delete');
             Route::resource('companies.branches', 'BranchController');

             //Job titles routes
             Route::get('companies/{id}/branches/{branch_id}/job-titles/data', 'JobTitleController@data')->name('job-titles.data');
             Route::delete('/job-titles/bulk_delete', 'JobTitleController@bulkDelete')->name('job-titles.bulk_delete');
             Route::resource('companies.branches.job-titles', 'JobTitleController');

             //Cities routes
             Route::get('/cities/data', 'CityController@data')->name('cities.data');
             Route::delete('/cities/bulk_delete', 'CityController@bulkDelete')->name('cities.bulk_delete');
             Route::resource('cities', 'CityController');

             //Services routes
             Route::get('/services/data', 'ServiceController@data')->name('services.data');
             Route::delete('/services/bulk_delete', 'ServiceController@bulkDelete')->name('services.bulk_delete');
             Route::resource('services', 'ServiceController');

             //Packages routes
             Route::get('/packages/data', 'PackageController@data')->name('packages.data');
             Route::delete('/packages/bulk_delete', 'PackageController@bulkDelete')->name('packages.bulk_delete');
             Route::resource('packages', 'PackageController');

             //Service orders routes
             Route::get('/service-orders/data', 'ServiceOrderController@data')->name('service-orders.data');
             Route::delete('/service-orders/bulk_delete', 'ServiceOrderController@bulkDelete')->name('service-orders.bulk_delete');
             Route::resource('service-orders', 'ServiceOrderController');

             //order your aqar orders routes
             Route::get('/order-aqar/data', 'OrderController@data')->name('order-aqar.data');
             Route::delete('/order-aqar/bulk_delete', 'OrderController@bulkDelete')->name('order-aqar.bulk_delete');
             Route::resource('order-aqar', 'OrderController');

             //aqars orders routes
             Route::get('/aqar-orders/data', 'AqarOrderController@data')->name('aqar-orders.data');
             Route::delete('/aqar-orders/bulk_delete', 'AqarOrderController@bulkDelete')->name('aqar-orders.bulk_delete');
             Route::resource('aqar-orders', 'AqarOrderController');
             Route::put('aqar-orders/{id}/accept', 'AqarOrderController@acceptOrder')->name('aqar-orders.accept');
             Route::put('aqar-orders/{id}/reject', 'AqarOrderController@rejectOrder')->name('aqar-orders.reject');
             Route::post('/aqar-orders/{id}/change-package', 'AqarOrderController@changePackage')->name('aqar-orders.changePackage');
             Route::post('/aqar-orders/{id}/change-period', 'AqarOrderController@changePeriod')->name('aqar-orders.changePeriod');
             //Article  routes
             Route::get('/articles/data', 'ArticleController@data')->name('articles.data');
             Route::delete('/articles/bulk_delete', 'ArticleController@bulkDelete')->name('articles.bulk_delete');
             Route::resource('articles', 'ArticleController');

             //Tag  routes
             Route::get('/tags/data', 'TagController@data')->name('tags.data');
             Route::delete('/tags/bulk_delete', 'TagController@bulkDelete')->name('tags.bulk_delete');
             Route::resource('tags', 'TagController');

             //reports at questions routes
             Route::get('/report-question/data', 'ReportQuestionController@data')->name('report-question.data');
             Route::delete('/report-question/bulk_delete', 'ReportQuestionController@bulkDelete')->name('report-question.bulk_delete');
             Route::resource('report-question', 'ReportQuestionController')->only(['index', 'destroy']);

             //reports at comments of aqar routes
             Route::get('/report-comment/data', 'ReportCommentController@data')->name('report-comment.data');
             Route::delete('/report-comment/bulk_delete', 'ReportCommentController@bulkDelete')->name('report-comment.bulk_delete');
             Route::resource('report-comment', 'ReportCommentController')->only(['index', 'destroy']);

             //aqar tips routes
             Route::get('/aqar-tips/data', 'AqarTipsController@data')->name('aqar-tips.data');
             Route::delete('/aqar-tips/bulk_delete', 'AqarTipsController@bulkDelete')->name('aqar-tips.bulk_delete');
             Route::resource('aqar-tips', 'AqarTipsController');

             //aqar features routes
             Route::get('/aqar-features/data', 'AqarFeatureController@data')->name('aqar-features.data');
             Route::delete('/aqar-features/bulk_delete', 'AqarFeatureController@bulkDelete')->name('aqar-features.bulk_delete');
             Route::resource('aqar-features', 'AqarFeatureController');

             //Settings routes
             Route::get('/settings/general', 'SettingController@general')->name('settings.general');
             Route::resource('settings', 'SettingController')->only(['store']);
             Route::get('photo/{id}', [PhotoController::class, 'destroy'])->name('photo.destroy');
             //Profile routes
             Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
             Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

             Route::name('profile.')->namespace('Profile')->group(function () {

                 //Password routes
                 Route::get('/password/edit', 'PasswordController@edit')->name('password.edit');
                 Route::put('/password/update', 'PasswordController@update')->name('password.update');
             });
         });
     });
