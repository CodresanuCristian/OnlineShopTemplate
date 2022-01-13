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

        <div class='container-fluid mx-5 px-5' style='margin:150px 0px;'>
            <h1 class='mb-5'>{{ $name }}</h1>
            <div class='d-flex justify-content-around my-5 py-5'>
                <img src='/img/{{ $category }}/{{ $name }}.jpg'>  
                <div class='details d-flex flex-column justify-content-center'>
                    <h3 class='mx-5'>Description</h3>
                    <p class='mx-5'>{{ $description }}</p>
                    <h4 class='my-3 mx-5'>Price: {{ $price }} $</h4>
                    <div class='d-flex buttons'>
                        <form action='/addcart' method="get">
                            <input type='text' name='product_name' value={{ $name }} hidden>
                            <input type='text' name='product_price' value={{ $price }} hidden>
                            <button class='btn btn-primary my-5 ml-5 py-3' type='submit' style='width:200px;'>Add to cart</button>
                        </form>
                        <form action='/addfav' method="get">
                            <input type='text' name='product_name' value={{ $name }} hidden>
                            <input type='text' name='product_price' value={{ $price }} hidden>
                            <button class='btn btn-danger my-5 ml-3 py-3' type='submit' style='width:200px;'>Add to favorite</button>
                        </form>
                    </div>
                </div>
            </div>
            <h3 class='mb-4'>Specs</h3>
            <table class="table table-striped mb-5">
                <tbody>
                    <tr>
                        <td>Type</td>
                        <td>{{ $type }}</td>
                    </tr>
                    <tr>
                        <td>Brand</td>
                        <td>{{ $brand }}</td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>{{ $name }}</td>
                    </tr>
                    <tr>
                        <td>Color</td>
                        <td>{{ $color }}</td>
                    </tr>
                </tbody>
            </table>
            <h3 class='pt-5 mb-4'>Reviews</h3>
            @if ($posts->count() > 0)
                @foreach ($posts as $post)
                    <div class='my-5'>
                        <h6 style='text-decoration:underline;'>{{ $post['user']}} - {{$post['created_at']}}</h6>
                        <h5 class='m-2'>{{ $post['message'] }}</h5>
                    </div>
                @endforeach
            @else
                <h5 style='font-style:italic; margin:50px 0px;'>No comments for this product</h5>
            @endif
            <form action='/posts' method="post" id='posts-form'>
                @csrf
                <textarea name='message' placeholder="Leave a comment" style='width:40vw; height:100px;'></textarea><br>
                <input type='text' name='product_name' value={{ $name }} hidden>
                <button type="submit" class='btn btn-primary mt-1' style='width:100px;'>Posts</button>
            </form>
        </div>

        <script>
            $(document).ready(function(){           
                if ($('ul li p').html() != 'Guest')
                    $('#posts-form').css({'display':'inherit'});
                else
                    $('#posts-form').css({'display':'none'});
            });
        </script>
        @include('Layouts.footer')
    </body>
</html>