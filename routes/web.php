<?php

use App\Post;
use App\Tag;
use App\Video;
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

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Eloquent Polymorphic Many to Many
|--------------------------------------------------------------------------
*/

// Create
Route::get('/create', function () {
    $post = Post::create(['title' => 'First Post']);
    $tag1 = Tag::find(1);
    $post->tags()->save($tag1);

    $video = Video::create(['name' => 'video.mp4']);
    $tag2 = Tag::find(2);
    $video->tags()->save($tag2);
});

// Read
Route::get('/read', function () {
    $post = Post::findOrFail(1);
    foreach ($post->tags as $tag) {
        echo $tag;
    }
});

//Update
Route::get('/update', function () {
    // $post = Post::findOrFail(1);
    // foreach ($post->tags as $tag) {
    //     return $tag->whereName('PHP')->update(['name' => 'CSS']);
    // }
    //or
    // $post = Post::findOrFail(1);
    // $tag = Tag::find(3);
    // return $post->tags()->save($tag);
    //or
    // $post = Post::findOrFail(1);
    // $tag = Tag::find(4);
    // $post->tags()->attach($tag);
    // $post
    // and another else
    $post = Post::findOrFail(1);
    $tag = Tag::find(4);
    $post->tags()->sync([1, 2, 3]);
});

// Delete
Route::get('/delete', function () {
    $post = Post::findOrFail(1);
    foreach ($post->tags as $tag) {
        $tag->whereId(4)->delete();
    }
});
