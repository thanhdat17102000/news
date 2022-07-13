@extends('admin.common')
@section('content')
<h4>Bài viết</h4>
<form class="form-inline mt-3" action="post_crawl" method="POST">
    @csrf
    <div class="form-group">
        @csrf
        <label for="category">Danh mục :</label>
        <select class="form-control ml-2" id="category" name='idCategory'>
            @foreach ($dataCategory as $item)
            <option value="{{$item->id}}">{{$item->title}} (
                {{ \App\Models\Link::where('idCategory',$item->id)->count() }} link )</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary ml-3">Crawl bài viết</button>
</form>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Danh mục</th>
            <th>Trạng thái</th>
            <th>Thời gian</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            @foreach ($dataPost as $item)
            <td>{{$item->id}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->titleCategory}}</td>
            <td>{{$item->status==='publish'? "Hiện" : "Ẩn"}}</td>
            <td>Thời gian khởi tạo : {{date_format($item->created_at,"d/m/Y H:i:s")}}
                <br>
                Thời gian cập nhật : {{date_format($item->updated_at,"d/m/Y H:i:s")}}
            </td>
            <td>
                <a href="post_detail/{{$item->id}}" class="btn btn-success"><i class="fa-solid fa-play"></i></a>
                <a href="post_form_edit/{{$item->id}}" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                <a href="post_delete/{{$item->id}}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $dataPost->links() }}
@endsection
