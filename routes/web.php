<?php

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

use App\Book;
use Illuminate\Http\Request;

/**
* 本の一覧表示(books.blade.php)
*/
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    $books = Book::orderBy('created_at', 'asc')->get();
    return view('books', [
        'books' => $books
    ]);
    //return view('books',compact('books')); //も同じ意味
});
Route::get('contact', 'BooksController@contact');

/**
* 本を追加 
*/
Route::post('/books', function (Request $request) {
    //dd( $request );　//POSTなどのでリクエストデータがセットされている

    //バリデーション
    $validator = Validator::make($request->all(), [
        'item_name' => 'required|max:255',
    ]);

    //バリデーション:エラー 
    if ($validator->fails()) {
        return redirect('/')
            ->withInput()
            ->withErrors($validator);
    }
    
    //以下登録処理が後で追加します！      


     // Eloquentモデル（登録処理）
     $books = new Book;
     $books->item_name = $request->item_name;
     $books->item_number = '1';
     $books->item_amount = '1000';
     $books->published = '2017-03-07 00:00:00';
     $books->save(); 
     return redirect('/');   
});

/**
* 本を削除 
*/
Route::delete('/book/{book}', function (Book $book) {
    //
    // dd( $book );
    $book->delete();       //追加
    return redirect('/');  //追加    
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
