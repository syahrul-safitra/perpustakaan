<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $book->judul }}</title>


    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
</head>

<body>

    <div class="container mt-5" style="background-color: yellow">
        <h2 class="text-center">
            {{ $book->judul }}
        </h2>
        <br>

        <div class="mx-auto">
            <embed src="{{ asset('files/' . $book->berkas . '#toolbar=0') }}" width="100%" height="800">
        </div>
    </div>

</body>

</html>
