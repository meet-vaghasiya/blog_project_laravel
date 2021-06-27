<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>laravel - @yield('title')</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>
</head>

<body>

    <div class="d-flex flex-column flex-md-row bg-white shadow-sm  p-3 px-md-4n align-items-center mb-3">
        <h5 class="my-0 mr-md-auto font-weight-normal">Laravel app</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="text-dark" href="{{ route('home.index') }}">Home</a>
            <a class="text-dark" href="{{ route('home.contact') }}">Contact</a>
            <a class="text-dark" href="{{ route('posts.index') }}">Blog post</a>
            <a class="text-dark" href="{{ route('posts.create') }}">Add blog post</a>
        </nav>
    </div>

    <div class="container">

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')

    </div>


</body>

</html>
