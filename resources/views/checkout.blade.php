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

        <div class='container d-flex flex-column justify-content-center align-items-center' style='min-height:70vh;'>
            <h1 class='m-5'>Checkout</h1>
            <form action='/orders' method="post" id='orders' class='d-flex flex-column'>
                <input type='text' name='name' placeholder="Full name" class='mt-1'>
                <input type='email' name='email' placeholder="Email" class='mt-1'>
                <input type='tel' name='phone' placeholder="Phone" class='mt-1'>
                <input type='text' name='address' placeholder="Full address" class='mt-1'>
                <button type='submit' class='btn btn-primary mt-3'>Pay ${{ session('cart_total') }}</button>
            </form>
        </div>
        
        @include('Layouts.footer')
    </body>
</html>