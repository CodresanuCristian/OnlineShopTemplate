<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Online Shop</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/layouts.css">
    </head>
    <body>
        {{-- HEADER --}}
        @include('Layouts.header')
        
        <!-- Content -->
        <div class='container text-center d-flex flex-column justify-content-center' style='height: 80vh;'>
            <h1 class='m-5 p-5'>WELCOME TO OUR SHOP</h1>
        </div> 

        <!-- Footer -->
        @include('Layouts.footer')
    </body>
</html>