@extends('admin.common')
@section('content')
<form class="form-inline mt-3" action="link_crawl" method="POST">
    @csrf
<div class="form-group">
    <label for="category">Danh mục :</label>
    <select class="form-control ml-2" id="category" name='idCategory'>
      @foreach ($dataCategory as $item)
      <option value="{{$item->id}}">{{$item->title}}</option>
      @endforeach
    </select>
  </div>

  <button type="submit" class="btn btn-primary ml-3">Crawl link</button>
</form>
<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>ID</th>
            <th>Link</th>
            <th>Danh mục</th>
            <th>Trạng thái crawl</th>
        </tr>
    </thead>
    <tbody>

        <tr>
        @foreach ($dataLink as $item)
            <td>{{$item->id}}</td>
            <td>{{$item->link}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->statusCrawl===0 ? "Chưa crawl" : "Đã crawl"}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $dataLink->links() }}
@endsection
