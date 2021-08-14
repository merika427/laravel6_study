<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//使うClassを宣言:自分で追加
use App\Book;   //Bookモデルを使えるようにする
use Validator;  //バリデーションを使えるようにする
use Auth;       //認証モデルを使用する

class BooksController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $books = Book::orderBy('created_at', 'asc')->get();
        $books = Book::orderBy('created_at', 'asc')->paginate(3);
        return view('books', [
            'books' => $books
        ]);
    }

    // ...
    public function contact()  // 追加
    {
        return "contact";  // (a) view 関数を使わず、テキストを返してみる
    }

     //更新
    public function update(Request $request) {

        //バリデーション
        $validator = Validator::make($request->all(), [
                'id' => 'required',
                'item_name' => 'required|min:3|max:255',
                'item_number' => 'required|min:1|max:3',
                'item_amount' => 'required|max:6',
                'published' => 'required',
        ]);
        //バリデーション:エラー
            if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
        }
        
        //データ更新
        $books = Book::find($request->id);
        $books->item_name   = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published   = $request->published;
        $books->save();
        return redirect('/');       
    }

    //本の登録
    public function store(Request $request) {
        // dd( $request );
        //バリデーション
        $validator = Validator::make($request->all(), [
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required',        
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
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published   = $request->published;
        $books->save(); 
        return redirect('/');          

    }    

    //本の削除
    public function destroy(Book $book) {
        // dd( $book );
        $book->delete();       //追加
        return redirect('/');  //追加            
    }

    //本の削除
    public function edit(Book $books) {
        //{books}id 値を取得 => Book $books id 値の1レコード取得
        return view('booksedit', ['book' => $books]);           
    }    
}
