@extends('admin.common')
@section('content')
<h4>Danh mục</h4>
<a href="category_update" class="btn btn-primary mt-2 mb-3">Cập nhật danh mục</a>
@if(count($dataCategory)===0)
<div class="">Chưa có danh mục nào</div>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataCategory as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->title}}</td>
            <td>{{($item->statusCrawl===0) ? "Chưa lấy dữ liệu" : "Đã lấy dữ liệu"}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

{{ $dataCategory->links() }}

@endsection
