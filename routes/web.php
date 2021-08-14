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
// Route::get('/', function () {
//     $books = Book::orderBy('created_at', 'asc')->get();
//     return view('books', [
//         'books' => $books
//     ]);
//     //return view('books',compact('books')); //も同じ意味
// });
//本ダッシュボード表示
Route::get('/', 'BooksController@index');

Route::get('contact', 'BooksController@contact');

/**
* 本を追加 
*/
// Route::post('/books', function (Request $request) {
//     //dd( $request );　//POSTなどのでリクエストデータがセットされている

//     //バリデーション
//     $validator = Validator::make($request->all(), [
//         'item_name' => 'required|max:255|min:3',
//         'item_number' => 'required|max:3|min:3',
//         'item_amount' => 'required|min:6',    
//         'published' => 'required',           
//     ]);

//     //バリデーション:エラー 
//     if ($validator->fails()) {
//         return redirect('/')
//             ->withInput()
//             ->withErrors($validator);
//     }
    
//     //以下登録処理が後で追加します！      


//      // Eloquentモデル（登録処理）
//      $books = new Book;
//      $books->item_name = $request->item_name;
//      $books->item_number = $request->item_number;
//      $books->item_amount = $request->item_amount;
//      $books->published   = $request->published;
//      $books->save(); 
//      return redirect('/');   
// });
Route::post('/books','BooksController@store');

/**
* 本を削除 
*/
// Route::delete('/book/{book}', function (Book $book) {
//     //
//     // dd( $book );
//     $book->delete();       //追加
//     return redirect('/');  //追加    
// });
Route::delete('/book/{book}','BooksController@destroy');

//更新画面
// Route::post('/booksedit/{books}', function(Book $books) {
//     //{books}id 値を取得 => Book $books id 値の1レコード取得
//     return view('booksedit', ['book' => $books]);
// });
Route::post('/booksedit/{books}','BooksController@edit');


//更新処理
// Route::post('/books/update', function(Request $request){
//     //バリデーション
//         $validator = Validator::make($request->all(), [
//             'id' => 'required',
//             'item_name' => 'required|min:3|max:255',
//             'item_number' => 'required|min:1|max:3',
//             'item_amount' => 'required|max:6',
//             'published' => 'required',
//     ]);
//     //バリデーション:エラー
//         if ($validator->fails()) {
//             return redirect('/')
//                 ->withInput()
//                 ->withErrors($validator);
//     }
    
//     //データ更新
//     $books = Book::find($request->id);
//     $books->item_name   = $request->item_name;
//     $books->item_number = $request->item_number;
//     $books->item_amount = $request->item_amount;
//     $books->published   = $request->published;
//     $books->save();
//     return redirect('/');
// });
Route::post('/books/update','BooksController@update');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'BooksController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


#**************************************************
# * Route::groupを使ったログイン認証
# * 「コンストラクタ」か「Route::group」のどちらかだけの記述にします。
#**************************************************
// Route::group(['middleware' => 'auth'], function () {
//     //welcomeページを表示
//     Route::get("/",function(){
//       return view("welcome");
//     });
 
//  });