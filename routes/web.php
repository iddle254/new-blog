<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\Country;
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
Route::get('/softdelete', function(){
    Post::find(7)->delete();
});
// Route::get('/delete', function(){
//     $post = Post::find(1);
//     $post->delete();
// });
// Route::get('/delete2', function(){
//     Post::destroy(2);
// });
// Route::get('/destroymult', function(){
//     Post::destroy([3,4]);
// });
// Route::get('/deleteconditional', function(){
//     Post::where('id',5)->where('is_admin', 0)->delete();
// });
// Route::get('/update', function(){
//     Post::where('id',2)->where('is_admin', 0)->update(['title'=>'NEW PHP TITLE', 'body'=>'I love this course']);
// });
// Route::get('/create', function(){
// Post::create(['title'=>'the create method', 'body'=>'Helps to add new data']);
// });
Route::get('/basicInsert', function(){
    $post = new Post;
    $post->title = 'How to change your life overnight';
    $post->body = 'find Christ';

    $post->save();
});

Route::get('/readsoftdelete', function(){
    // $post = Post::find(6);
    // return $post;

    // $post = Post::withTrashed()->where('id', 6)->get();
    $post = Post::onlyTrashed()->get();
    return $post;
});

Route::get('/restore', function(){
    Post::withTrashed()->where('is_admin', 0)->restore();
});

Route::get('/forcedelete', function(){
    Post::withTrashed()->where('id', 7)->forceDelete();
});

/*
|--------------------------------------------------------------------------
| Eloquent relationships
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|   one to one relationship
 */
// Route::get('/user/{id}/post', function($id){
//    return User::find($id)->post->title;
// });
/*
|   inverse relationship
 */
// Route::get('/post/{id}/user', function($id){
//     return Post::find($id)->user->name;
// } );
/*
|   one to many relationship
 */
// Route::get('/posts', function(){
//     $user = User::find(2);
//     foreach($user->posts as $post){
//         echo $post->title. "<br>";
//     }
// });
/*
|   many to many relationship
 */
// Route::get('/user/{id}/role', function($id){
//     $user = User::find($id);
//     foreach($user->roles as $role){
//         return $role->name;
//     }
// });
// Route::get('/user/{id}/role', function($id){
//     $user = User::find($id)->roles()->orderBy('id', 'desc')->get();
//     return $user;
// });
/*
|   Accessing the intermediate table
 */
Route::get('/user/pivot', function(){
    $user = User::find(2);
    foreach($user->roles as $role){
        echo $role->pivot->created_at;
    }
});
/*
|   Has many through relation
 */
Route::get('/user/country', function(){
    $country = Country::find(1);
    foreach($country->posts as $post){
        return $post->title;
    }
});
/*
|   Polymorphic relations
 */
Route::get('/user/photos', function(){
    $user = User::find(1);
    foreach($user->photos as $photo){
        return $photo->path;
    }
});
Route::get('/post/{id}/photos', function($id){
    $post = Post::find($id);
    foreach($post->photos as $photo){
        echo $photo->path."<br>";
    }
});
Route::get('photo/{id}/post', function($id){
    $photo = Photo::findOrFail($id);
    return $photo->imageable;
});
/*
|   Polymorphic many-to-many relation
 */
Route::get('/post/tag', function(){
    $post = Post::find(1);
    foreach($post->tags as $tag){
        echo $tag->name;
    }
});

Route::get('/tag/post', function(){
    $tag = Tag::find(2);
    foreach($tag->posts as $post){
        echo $post->title;
    }
});
// Route::get('/basicInsert2', function(){
//     $post = Post::find(1);
//     $post->title = 'PHP wueeeh!';
//     $post->body = 'isshot';
//     $post->save();
// });
// Route::get('/findmore', function(){
//     $posts = Post::where('users_count', '<', 50)->firstOrFail();
//     return $posts;
// });
// Route::get('/findwhere', function(){
//     $posts = Post::where('id', 2)->orderBy('id', 'desc')->take(1)->get();

//     return $posts;
// });
// Route::get('findmore', function(){
//     $posts = Post::findOrFail(2);
//     return $posts;
// });
// Route::get('/read', function(){
//     $posts = Post::all();
//     foreach($posts as $post){
//         return $post->title;
//     }
// });

// Route::get('/find', function(){
//     $post = Post::find(1);
//     return $post->title;
// });

// Route::get('/posts/{id}', '\App\Http\Controllers\PostsController@index');
// Route::resource('posts', '\App\Http\Controllers\PostsController');
// Route::get('contact', '\App\Http\Controllers\PostsController@contact');
// Route::get('post/{id}/{name}/{password}', '\App\Http\Controllers\PostsController@show_post');

// Route::get('/insert', function(){
//     DB::insert('insert into posts(title, body) values(?, ?)', ['Bazu wa mabazu', 'issme']);
// });

// Route::get('/read', function(){
//     $results = DB::select('select * from posts where id=?',[1]);
//     foreach($results as $post){
//         return $post->title;
//     }
// });

// Route::get('/update', function(){
//     $updated = DB::update('update posts set title="updated title" where id=?', [1]);
//     return $updated;
// });

// Route::get('/update', function(){
//     $updated = DB::update('update posts set body="aki wewe" where id=?', [1]);
//     return $updated;
// });
// Route::get('/delete', function(){
//     $deleted = DB::delete('delete from posts where id=?', [1]);
//     return $deleted;
// });

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/about', function () {
//     return "Hi, Im about";
// });

// Route::get('/contact', function () {
//     return "Hi, Im contact";
// });

// Route::get("/posts/{id}", function($id){
//     return "This is post number".$id;

// });

// Route::get('/admin/posts/example', array('as'=>'admin.home', function(){
//     $url = route('admin.home');

//     return "this url is ".$url;
// }));

