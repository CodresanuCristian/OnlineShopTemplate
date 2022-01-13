<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Online Shop</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/layouts.css">
    </head>
    </head>
    <body>
        {{-- HEADER --}}
        @include('Layouts.header')

        <div class='content d-flex flex-column align-items-center' style = 'margin:20vh 0px'>
            <h1 class='m-5 text-center'  style='width:220px;'>Log in</h1>
            <form action='/login' method="POST" class='d-flex flex-column align-items-center'>
                @csrf
                <input type="email" id='email' name='email' placeholder="Email" class='mb-1' style='width:220px;'>
                <input type="password" id='password' name='password' placeholder="Password" class='mb-1' style='width:220px;'>
                <button type="submit" class='btn btn-primary' style='width:220px;'>Log in</button>
            </form>
            <a href='/signup' class='mt-5'>Sign up</a>
        </div>

        @include('Layouts.footer')
    </body>
</html>