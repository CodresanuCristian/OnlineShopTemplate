<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Online Shop</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/layouts.css">
        <link rel="stylesheet" href="/css/admin-products.css">
    </head>
    <body>
        <!-- Header ============================================= -->
        @include('Layouts.header')

        <div class='container mt-5 d-flex align-items-center flex-column'> 
            {{-- NAV --}}
            <div id='nav' class='container d-flex justify-content-around mb-5'>
                <h4 id='op-guitars' class='active'>Guitars</h4>
                <h4 id='op-cycling'>Cycling</h4>
                <h4 id='op-snowboarding'>Snowboarding</h4>
            </div>

            {{-- GUITARS --}}
            <div class='add-guitars flex-column align-items-center'>
                <h2 class='mt-5'>Add Guitar</h2>
                <form action='/add-products' method='get' class='my-5'>
                    @csrf
                    <input type='text' name='nav_option' value='op1' hidden><br>
                    <h5>Type</h5>
                    <label class='mr-3'><input type='radio' class='radio' name='guitar_type' value='Acoustic'>ACOUSTIC</label>
                    <label><input type='radio' class='radio' name='guitar_type' value='Electric'>ELECTRIC</label><br>
                    <input type='text' name='guitar_name' placeholder="Name"><br>
                    <input type='text' name='guitar_brand' placeholder="Brand"><br>
                    <input type='text' name='guitar_color' placeholder="Color"><br>
                    <input type='text' name='guitar_price' placeholder="Price"><br>
                    <button class='btn btn-primary mt-4' type='submit'>Add</button>
                </form>
            </div>

            {{-- CYCLING --}}
            <div class='add-cycling flex-column align-items-center'>
                <h2 class='mt-5'>Add Bike</h2>
                <form action='/add-products' method='get' class='my-5'>
                    @csrf
                    {{-- type --}}
                    <input type='text' name='nav_option' value='op2' hidden><br>
                    <h5>Type</h5>
                    <label class='mr-3'><input type='radio' class='radio' name='bike_type' value='mtb'>MTB</label>
                    <label class='mr-3'><input type='radio' class='radio' name='bike_type' value='racer bike'>RACER BIKE</label>
                    <label class='mr-3'><input type='radio' class='radio' name='bike_type' value='foldin bike'>FOLDIN BIKE</label><br>
                    {{-- size --}}
                    <h5>Size</h5>
                    <label class='mr-3'><input type='radio' class='radio' name='size' value='xs'>XS</label>
                    <label class='mr-3'><input type='radio' class='radio' name='size' value='s'>S</label>
                    <label class='mr-3'><input type='radio' class='radio' name='size' value='m'>M</label>
                    <label class='mr-3'><input type='radio' class='radio' name='size' value='l'>L</label>
                    <label class='mr-3'><input type='radio' class='radio' name='size' value='xl'>XL</label><br>
                    {{-- speed --}}
                    <h5>Speed</h5>
                    <label class='mr-3'><input type='radio' class='radio' name='speed' value='7'>7</label>
                    <label class='mr-3'><input type='radio' class='radio' name='speed' value='8'>8</label>
                    <label class='mr-3'><input type='radio' class='radio' name='speed' value='9'>9</label>
                    <label class='mr-3'><input type='radio' class='radio' name='speed' value='10'>10</label>
                    <label class='mr-3'><input type='radio' class='radio' name='speed' value='11'>11</label><br>
                    {{-- text --}}
                    <input type='text' name='name' placeholder="Name"><br>
                    <input type='text' name='brand' placeholder="Brand"><br>
                    <input type='text' name='price' placeholder="Price"><br>
                    <button class='btn btn-primary mt-4' type='submit'>Add</button>
                </form>
            </div>

            {{-- SNOWBOARDING --}}
            <div class='add-snowboarding flex-column align-items-center'>
                <h2 class='mt-5'>Add Snowboard</h2>
                <form action='/add-products' method='get' class='my-5'>
                    @csrf
                    {{-- gender --}}
                    <input type='text' name='nav_option' value='op3' hidden><br>
                    <h5>Gender</h5>
                    <label class='mr-3'><input type='radio' class='radio' name='gender' value='male'>MALE</label>
                    <label class='mr-3'><input type='radio' class='radio' name='gender' value='female'>FEMALE</label><br>
                    {{-- type --}}
                    <h5>Type</h5>
                    <label class='mr-3'><input type='radio' class='radio' name='type' value='all mountain'>ALL MOUNTAIN</label>
                    <label class='mr-3'><input type='radio' class='radio' name='type' value='freestyle'>FREESTYLE</label>
                    <label class='mr-3'><input type='radio' class='radio' name='type' value='freeride'>FREERIDE</label><br>
                    {{-- size --}}
                    <h5>Size</h5>
                    <label class='mr-3'><input type='radio' class='radio' name='size' value='151'>151</label>
                    <label class='mr-3'><input type='radio' class='radio' name='size' value='153'>153</label>
                    <label class='mr-3'><input type='radio' class='radio' name='size' value='155'>155</label><br>
                    {{-- level --}}
                    <h5>Level</h5>
                    <label class='mr-3'><input type='radio' class='radio' name='level' value='beginer'>BEGINER</label>
                    <label class='mr-3'><input type='radio' class='radio' name='level' value='intermediar'>INTERMEDIAR</label>
                    <label class='mr-3'><input type='radio' class='radio' name='level' value='advanced'>ADVANCED</label><br>
                    {{-- text --}}
                    <input type='text' name='name' placeholder="Name"><br>
                    <input type='text' name='brand' placeholder="Brand"><br>
                    <input type='text' name='price' placeholder="Price"><br>
                    <button class='btn btn-primary mt-4' type='submit'>Add</button>
                </form>
            </div>
        </div>


        <!-- Footer ============================================== -->
        @include('Layouts.footer')

        <script>
            $('#nav h4').click(function(){
                let nav_op = $(this).attr('id');
                
                $('#nav h4').removeClass('active');
                $('#'+nav_op).addClass('active');
                
                $('.add-guitars').css({'display':'none'});
                $('.add-cycling').css({'display':'none'});
                $('.add-snowboarding').css({'display':'none'});
                if (nav_op == 'op-guitars') $('.add-guitars').css({'display':'flex'});
                if (nav_op == 'op-cycling') $('.add-cycling').css({'display':'flex'});
                if (nav_op == 'op-snowboarding') $('.add-snowboarding').css({'display':'flex'});
            });
        </script>
    </body>
</html>
