<html>
    <head>
        <base href="{{asset('')}}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
</html>
<button onclick="history.back()" class="btn btn-primary mb-3 ml-3 mt-3">Quay lại trang quản trị</button>
<div class="container">
    <h2>{{$dataPost->title}}</h3>
    <h5 class="mt-5 mb-5">{{$dataPost->short_description}}</h4>
{!! $dataPost->content !!}
</div>

