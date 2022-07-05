@extends('admin.common')
@section('content')
<form class="form-inline mt-3" action="post_crawl" method="POST">
    @csrf
    <div class="form-group">
    @csrf
        <label for="category">Danh mục :</label>
        <select class="form-control ml-2" id="category" name='idCategory'>
            @foreach ($dataCategory as $item)
            <option value="{{$item->id}}">{{$item->title}} ( {{ \App\Models\Link::where('idCategory',$item->id)->count() }} bài )</option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary ml-3">Crawl bài viết</button>
</form>
@endsection