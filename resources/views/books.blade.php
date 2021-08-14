@extends('layouts.app')
@section('content')

    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <div class="card-title">
            本の登録
        </div>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif        

        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!-- バリデーションエラーの表示に使用-->

        <!-- 本登録フォーム -->
        <form action="{{ url('books') }}"　enctype="multipart/form-data" method="POST" class="form-horizontal">
            @csrf

            <!-- 本のタイトル -->
            <div class="form-group">
            <label class="card-title" for="item_number">冊数</label>    
                <div class="col-sm-6">
                    <input type="text" name="item_name" class="form-control">
                </div>
            </div>

            <!-- ↓課題1.1 p152↓ -->
            <div class="form-group">
                <label class="card-title" for="item_number">冊数</label>               
                <div class="col-sm-6">
                    <input type="text" name="item_number" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="card-title" for="item_amount">金額</label> 
                <div class="col-sm-6">
                    <input type="text" name="item_amount" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="card-title" for="published">本公開日</label> 
                <div class="col-sm-6">
                    <input type="date" name="published" class="form-control">
                </div>
            </div>                             
            <!-- ↑課題1.1 p152↑ -->

            <div class="col-sm-6">
                <label>画像</label>
                <input type="file" name="item_img">
            </div>

            <!-- 本 登録ボタン -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>

           
        </form>
    </div>
    <!-- Book: 既に登録されてる本のリスト -->
     <!-- 現在の本 -->
     @if (count($books) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>本一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <!-- 本タイトル -->
                                <td class="table-text">
                                    <div>{{ $book->item_name }}</div>
                                    <div> <img src="upload/{{$book->item_img}}" width="100"></div>
                                </td>
                                <!-- ↓課題1.1 p152↓ -->
                                <td class="table-text">
                                    <div>{{ $book->item_number }}</div>
                                </td>                                
                                <td class="table-text">
                                    <div>{{ $book->item_amount }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $book->published }}</div>
                                </td>
 
                                <!-- 本: 更新ボタン -->
                                <td>
                                    <form action="{{ url('booksedit/'.$book->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            更新
                                        </button>
                                    </form>
                                </td>                                

                                <!-- ↑課題1.1 p152↑ -->

                                <!-- 本: 削除ボタン -->
                                <td>
                                    <form action="{{ url('book/'.$book->id) }}" method="POST">
                                        @csrf               <!-- CSRFからの保護 -->
                                        @method('DELETE')   <!-- 擬似フォームメソッド　（web:.php Route::deleteと紐付け） -->
                                        
                                        <button type="submit" class="btn btn-danger">
                                            削除
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 offset-md-4">
                {{ $books->links()}}
            </div>
       </div> 

    @endif
@endsection