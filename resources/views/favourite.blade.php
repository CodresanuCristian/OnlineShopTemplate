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

        <div style='margin:100px auto; min-height:60vh;' class='d-flex flex-column align-items-center justify-content-center'>
            <h1 class='mb-5'>Your Favourite</h1>
            @if (session('fav_index') == 0)
                <h5 style='color:#666;'>You don't have favourite products yet</h5>
            @else
                @foreach(session('fav_item') as $index => $item)
                    <div class='items d-flex align-items-center justify-content-between container my-1 p-4' style='border:1px solid black;'>
                        <div class='container d-flex align-items-center'>
                            <img src='/img/Guitars/{{$item}}.jpg' style='width:100px; height:100px;'>
                            <div class='d-flex flex-column'>
                                <h5 class='mx-5'>{{$item}}</h5>
                                <h5 class='mx-5'>{{session('fav_price')[$index]}} $</h5>
                            </div>
                        </div>
                        <div class='d-flex flex-column'>
                            <form action='/addcart' method="get">
                                <input type='text' name='product_name' value={{ $item }} hidden>
                                <input type='text' name='product_price' value={{session('fav_price')[$index]}} hidden>
                                <button class='btn btn-primary my-1 py-2' style='width:150px;'>Add to cart</button>
                            </form>
                            <form action='/delfav' method="get">
                                <input type='text' name='product_name' value={{ $item }} hidden>
                                <button class='btn btn-danger my-1  py-2' style='width:150px;'>Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif

            @if (session('fav_index') != 0)
                <div class='d-flex container justify-content-between align-items-center p-4 mt-5' style='border:1px solid black;'>
                    <h4>Total: {{ session('fav_total') }} $</h4>
                </div>
            @endif
        </div>

        @include('Layouts.footer')
    </body>
</html>