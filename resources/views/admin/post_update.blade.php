@extends('admin.common')
@section('content')
<form action="{{route('post_update')}}" method='POST'>
    @csrf
    <input type="hidden" value="{{$dataPost->id}}" name='id'>
    <div class="row">
        <div class="form-group col-12">
            <label for="">Tiêu đề:</label>
            <input type="text" class="form-control" placeholder="" id="" value="{{$dataPost->title}}" name='title'>
        </div>
        <div class="form-group col-12">
            <label for="">Mô tả ngắn:</label>
            <textarea type="text" class="form-control" placeholder="" id="" name='short_description'>{{$dataPost->short_description}}</textarea>
        </div>
        <div class="form-group col-6">
            <label for="">Danh mục:</label>
            <select class="form-control" id="sel1" name='idCategory'>
                @foreach($dataCategory as $item)
                <option value="{{$item->id}}" {{$item->id === $dataPost->idCategory ? 'selected' : ''}}>{{$item->title}}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-6" >
            <label for="">Trạng thái:</label>
            <select class="form-control" id="sel1" name='status'>
                <option value="publish" {{$dataPost->status === 'publish' ? 'selected' : ''}} >Hiện</option>
                <option value="unpublish" {{$dataPost->status === 'unpublish' ? 'selected' : ''}}>Ẩn</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Cập nhật</button>
</form>
@endsection
