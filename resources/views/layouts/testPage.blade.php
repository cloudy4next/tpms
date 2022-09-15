<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

{{$date}}
<br><br><br>

<form action="{{route('update.test.data')}}" method="POST">
    @csrf
    <input type="datetime-local" name="date">
    <input type="submit" name="submit">
</form>

{{-- <form action="{{route('update.test.data')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csv_file">
    <button type="submit">submit</button>
</form> --}}
</body>
</html>
