<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SocialShareButtonsController;
use App\Http\Controllers\Admin\PostController;
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

Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// Route::get('MorePosts/{slug}/{id}', [App\Http\Controllers\HomeController::class, 'index'])->name('MorePosts');

Route::get('/admin', function () {
    return redirect()->route('login');
});
Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'dashboardindex'])->name('dashboard');

Route::prefix('/admin')->namespace('Admin')->name('admin.')->middleware(['web', 'auth'])->group(function () {
    //Users
    Route::get('/users/', 'UsersController@index')->name('users.index');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users/store', 'UsersController@store')->name('users.store');
    Route::get('/users/edit/{id}', 'UsersController@edit')->name('users.edit');
    Route::post('/users/update', 'UsersController@update')->name('users.update');
    Route::get('/users/delete/{id}', 'UsersController@destroy')->name('users.destroy');
    Route::get('/users/deleted', 'UsersController@viewDeleted')->name('users.viewDeleted');
    Route::get('/users/restore/{id}', 'UsersController@restore')->name('users.restore');
    Route::get('/users/deletePermanent/{id}', 'UsersController@permanentDestroy')->name('users.permanentDestroy');

    //Roles
    Route::get('/roles/', 'RolesController@index')->name('roles.index');
    Route::get('/roles/create', 'RolesController@create')->name('roles.create');
    Route::post('/roles/store', 'RolesController@store')->name('roles.store');
    Route::get('/roles/edit/{id}', 'RolesController@edit')->name('roles.edit');
    Route::post('/roles/update', 'RolesController@update')->name('roles.update');
    Route::get('/roles/delete/{id}', 'RolesController@destroy')->name('roles.destroy');

    //Permissions
    Route::get('/permissions/', 'PermissionsController@index')->name('permissions.index');
    Route::get('/permissions/create', 'PermissionsController@create')->name('permissions.create');
    Route::post('/permissions/store', 'PermissionsController@store')->name('permissions.store');
    Route::get('/permissions/edit/{id}', 'PermissionsController@edit')->name('permissions.edit');
    Route::post('/permissions/update', 'PermissionsController@update')->name('permissions.update');
    Route::get('/permissions/delete/{id}', 'PermissionsController@destroy')->name('permissions.destroy');

    //History
    Route::get('/application-history/', 'HistoriesController@application_index')->name('application-history');
    Route::get('/system-history/', 'HistoriesController@system_index')->name('system-history');

    //Posts
    Route::get('/posts/index', 'PostController@index')->name('posts.index');
    Route::get('/posts/create', 'PostController@create')->name('posts.create');
    Route::post('/posts/store', 'PostController@store')->name('posts.store');
    Route::get('/posts/edit/{id}', 'PostController@edit')->name('posts.edit');
    Route::post('/posts/update', 'PostController@update')->name('posts.update');
    Route::get('/posts/delete/{id}', 'PostController@destroy')->name('posts.destroy');
    Route::post('/posts/upload-image', [PostController::class, 'uploadImage'])->name('posts.upload-image');

    //Categories
    Route::get('/categories/index', 'CategoryController@index')->name('categories.index');
    Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
    Route::post('/categories/store', 'CategoryController@store')->name('categories.store');
    Route::get('/categories/edit/{id}', 'CategoryController@edit')->name('categories.edit');
    Route::post('/categories/update', 'CategoryController@update')->name('categories.update');
    Route::get('/categories/delete/{id}', 'CategoryController@destroy')->name('categories.destroy');

    //Sections
    Route::get('/sections/index', 'SectionController@index')->name('sections.index');
    Route::get('/sections/create', 'SectionController@create')->name('sections.create');
    Route::post('/sections/store', 'SectionController@store')->name('sections.store');
    Route::get('/sections/edit/{id}', 'SectionController@edit')->name('sections.edit');
    Route::post('/sections/update', 'SectionController@update')->name('sections.update');
    Route::get('/sections/delete/{id}', 'SectionController@destroy')->name('sections.destroy');

    //Videos
    Route::get('/videos/index', 'VideoController@index')->name('videos.index');
    Route::get('/videos/create', 'VideoController@create')->name('videos.create');
    Route::post('/videos/store', 'VideoController@store')->name('videos.store');
    Route::get('/videos/edit/{id}', 'VideoController@edit')->name('videos.edit');
    Route::post('/videos/update', 'VideoController@update')->name('videos.update');
    Route::get('/videos/delete/{id}', 'VideoController@destroy')->name('videos.destroy');

    //Ads
    Route::get('/ads/index', 'AdController@index')->name('ads.index');
    Route::get('/ads/create', 'AdController@create')->name('ads.create');
    Route::post('/ads/store', 'AdController@store')->name('ads.store');
    Route::get('/ads/edit/{id}', 'AdController@edit')->name('ads.edit');
    Route::post('/ads/update', 'AdController@update')->name('ads.update');
    Route::get('/ads/delete/{id}', 'AdController@destroy')->name('ads.destroy');

    //Displays
    Route::get('/displays/index', 'DisplayController@index')->name('displays.index');
    Route::get('/displays/create', 'DisplayController@create')->name('displays.create');
    Route::post('/displays/store', 'DisplayController@store')->name('displays.store');
    Route::get('/displays/edit/{id}', 'DisplayController@edit')->name('displays.edit');
    Route::post('/displays/update', 'DisplayController@update')->name('displays.update');
    Route::get('/displays/delete/{id}', 'DisplayController@destroy')->name('displays.destroy');

    Route::get('/sitesettings/index', 'SiteSettingController@index')->name('sitesettings.index');

    Route::post('/sitesettings/update', 'SiteSettingController@update')->name('sitesettings.update');
    Route::get('/sitesettings/edit/{id}', 'SiteSettingController@edit')->name('sitesettings.edit');

    // Route::get('//create','@create')->name('.create');
    // Route::post('//store','@store')->name('.store');
    // Route::get('//edit/{id}','@edit')->name('.edit');
    // Route::post('//update','@update')->name('.update');
    // Route::get('//delete/{id}','@destroy')->name('.destroy');

    // Favicon
    Route::get('/favicons/index', [App\Http\Controllers\FaviconController::class, 'index'])->name('favicons.index');
    Route::get('/favicons/create', [App\Http\Controllers\FaviconController::class, 'create'])->name('favicons.create');
    Route::post('/favicons/store', [App\Http\Controllers\FaviconController::class, 'store'])->name('favicons.store');
    Route::get('/favicons/edit/{id}', [App\Http\Controllers\FaviconController::class, 'edit'])->name('favicons.edit');
    Route::post('/favicons/update', [App\Http\Controllers\FaviconController::class, 'update'])->name('favicons.update');
    Route::get('/favicons/delete/{id}', [App\Http\Controllers\FaviconController::class, 'destroy'])->name('favicons.destroy');

    // Route::get('/galleries/index', 'GalleryController@index')->name('galleries.index');
    // Route::get('/galleries/create', 'GalleryController@create')->name('galleries.create');
    // Route::get('/galleries/edit/{id}', 'GalleryController@edit')->name('galleries.edit');
    // Route::post('/galleries/update', 'GalleryController@update')->name('galleries.update');
    // Route::get('/galleries/destroy/{id}', 'GalleryController@destroy')->name('galleries.destroy');
    // Route::post('/galleries/store', 'GalleryController@store')->name('galleries.store');
    Route::get('/galleries/index', [App\Http\Controllers\GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/galleries/create', [App\Http\Controllers\GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/galleries/store', [App\Http\Controllers\GalleryController::class, 'store'])->name('galleries.store');
    Route::get('/galleries/edit/{id}', [App\Http\Controllers\GalleryController::class, 'edit'])->name('galleries.edit');
    Route::post('/galleries/update', [App\Http\Controllers\GalleryController::class, 'update'])->name('galleries.update');
    Route::get('/galleries/destroy/{id}', [App\Http\Controllers\GalleryController::class, 'destroy'])->name('galleries.destroy');

    //Comments
    Route::get('/comments/index', 'CommentController@index')->name('comments.index');
    Route::get('/comments/create', 'CommentController@create')->name('comments.create');
    Route::post('/comments/store', 'CommentController@store')->name('comments.store');
    Route::get('/comments/edit/{id}', 'CommentController@edit')->name('comments.edit');
    Route::post('/comments/update', 'CommentController@update')->name('comments.update');
    Route::get('/comments/delete/{id}', 'CommentController@destroy')->name('comments.destroy');

    //
    // Route::get('//index','@index')->name('.index');
    // Route::get('//create','@create')->name('.create');
    // Route::post('//store','@store')->name('.store');
    // Route::get('//edit/{id}','@edit')->name('.edit');
    // Route::post('//update','@update')->name('.update');
    // Route::get('//delete/{id}','@destroy')->name('.destroy');
});


Route::prefix('/profile')->name('profile.')->middleware(['web', 'auth'])->group(function () {
    Route::get('/', 'ProfilesController@index')->name('index');
    Route::post('/update/info', 'ProfilesController@updateInfo')->name('update.info');
    Route::post('/update/password', 'ProfilesController@updatePassword')->name('update.password');
});

Route::prefix('/')->group(function () {
    Route::get('category/{slug}/{id}', 'RenderController@renderCategory')->name('category.render');
    Route::get('post/{slug}/{id}', 'RenderController@renderPost')->name('post.render');
    Route::get('/post/load-more', 'RenderController@loadMore')->name('post.loadMore');

    Route::get('tags', 'RenderController@renderTags')->name('post.tags');
    Route::get('search', 'RenderController@renderSearch')->name('post.search');
    Route::get('news', 'RenderController@renderNews')->name('post.news');
    Route::get('sports', 'RenderController@renderSports')->name('post.sports');
    Route::get('bichar', 'RenderController@renderBichar')->name('post.bichar');
    Route::get('world_news', 'RenderController@renderWorld')->name('post.world_news');
    Route::get('romanchakNews', 'RenderController@renderRomanchakNews')->name('post.romanchakNews');
    Route::get('artha', 'RenderController@renderArtha')->name('post.artha');
    Route::get('itnews', 'RenderController@renderInformationTechnology')->name('post.itnews');

    Route::get('photofeature/{id}', 'RenderController@photofeature')->name('photofeature');

    // For share
    // Route::post('post/{id}/track-share', 'RenderController@trackShare')->name('post.trackShare');
    Route::get('post/increment/share/{id}', 'RenderController@incrementShare')->name('post.incrementShare');

// SINGLE BLADE
    // Route::get('posts/singleBlade/', 'RenderController@renderSingleBlade')->name('post.singleBlade');
});

Route::get('/social-media-share', [SocialShareButtonsController::class,'ShareWidget']);



