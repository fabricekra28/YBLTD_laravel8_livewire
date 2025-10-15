<?php

use App\Http\Controllers\UserController;
use App\Http\Livewire\Utilisateurs;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Models\TypeArticle;
use Illuminate\Support\Facades\Auth;

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





//[] /habilitation/utilisateurs
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    "middleware" => ["auth", "auth.admin"],
    "as" => "admin.",
], function(){

    Route::group([
        "prefix" => "habilitations",
        'as' => 'habilitations.'
    ], function(){

        Route::get('/utilisateurs',App\Http\Livewire\Utilisateurs::class)->name("users.index");

    });


    Route::group([
        "prefix" => "gestarticles",
        'as' => 'gestarticles.'
    ], function(){

        Route::get('/typearticles',App\Http\Livewire\TypeArticleComp::class)->name("typearticles");
        Route::get('/articles',App\Http\Livewire\ArticleComp::class)->name("articles");
        Route::get('/articles/{articleId}/tarifs',App\Http\Livewire\TarifComp::class)->name("articles.tarifs");
    });
});

Route::group([
    "middleware" => ["auth", "auth.employe"],
    'as' => 'employe.'
], function(){
    Route::get("/clients", App\Http\Livewire\ClientComp::class)->name("clients.index");
    Route::get("/locations", App\Http\Livewire\LocationComp::class)->name("locations.index");
   // Route::get("/clients", App\Http\Livewire\clientComp::class)->name("clients.index");
});
//Route::get('/habilitation/utilisateurs', [App\Http\Controllers\UserController::class, 'index'])->middleware("auth.admin");
