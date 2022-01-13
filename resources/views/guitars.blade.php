<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Online Shop</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/css/products-list.css">
        <link rel="stylesheet" href="/css/layouts.css">
    </head>
    </head>
    <body>
        {{-- HEADER --}}
        @include('Layouts.header')

        <div class="row py-5">   
             {{--FILTER===============================================================================================--}}
            <aside class="col-md-2">
                <form method='get' action='/custom_guitars'> 
                    @csrf
                    <h6 class="mb-4 px-3">FILTERS</h6>
                    {{-- Type --}}
                    <div class="d-flex flex-column section-filter mt-3 px-3">
                        <h6>Type</h6>
                        <ul id='guitar-type'></ul>
                    </div>
                    {{-- Brand --}}
                    <div class="d-flex flex-column section-filter mt-3 px-3">
                        <h6>Brand</h6>
                        <ul id='guitar-brands'></ul>
                    </div>
                    {{-- Color --}}
                    <div class="d-flex flex-column section-filter mt-3 px-3">
                        <h6>Color</h6>
                        <ul id='guitar-colors'></ul>
                    </div>
                    {{-- Price --}}
                    <div class="d-flex flex-column section-filter mt-3 px-3">
                        <h6>Price</h6>
                        <ul id='guitar-prices'>
                            <li><input type='range' class='slider' name='price_min' id='min_slider' step='10'><p id='min_slider_p'></p></li>
                            <li><input type='range' class='slider' name='price_max' id='max_slider' step='10'><p id='max_slider_p'></p></li>
                        </ul>
                    </div>
                    {{-- Button --}}
                    <div class='m-5 d-flex justify-content-center filter'>
                        <button type='submit' class='btn btn-primary w-100'>Apply filters</button>
                    </div>
                </form>
            </aside>

            {{-- PRODUCTS ============================================================================================--}}
            <section class="col-md-10">
                {{-- Top Bar --}}
                <div class="row products-top-bar">
                    <h6 class="col-6 text-left" id='results'>{{ $results }} Results</h6>
                    <div class="col-6 d-flex justify-content-end pr-5 align-items-center">
                        {{-- View --}}
                        <h6 class="mr-2">View</h6>
                        <select>
                            <option value="all">All</option>
                            <option value="20">10</option>
                            <option value="40">20</option>
                        </select>
                        {{-- Sort by --}}
                        <h6 class="ml-4 mr-2" >Sort by</h6>
                        <select>
                            <option value="name">Name</option>
                            <option value="price_asc">Price Asc</option>
                            <option value="price_desc">Price Desc</option>
                        </select>
                    </div>
                </div>
                {{-- Products List --}}
                <div class="d-flex flex-wrap mt-4" id='product_list'>
                    @foreach($guitars->sortBy('name') as $guitar)
                        <a href='/product-info/Guitars/{{ $guitar['name'] }}'>
                        <div class='card text-center mr-4 my-3 product-box' id='{{ $guitar['name'] }}'>
                            <div class='card-image'>
                                <img class='card-img-top' src='/img/Guitars/{{ $guitar['name'] }}.jpg'>
                            </div>
                            <div class='card-body'>
                                <h6>{{ $guitar['name'] }}</h6>
                                <h5>{{ $guitar['price'] }} $</h5>
                            </div>
                        </div></a>
                    @endforeach
                </div>
            </section>
        </div>

        @include('Layouts.footer')
        <script>
            $(document).ready(function(){
                var type = [];
                var brands = [];
                var colors = [];
                var min_price = 0;
                var max_price = 0;

                // GET FILTER DATA FROM DATABASE =========================================================
                $.ajax({
                    type:'GET',
                    url:'/get_filters',
                    async: false,
                    data:{category:'guitars'},
                    success: function(guitars){
                        // Get type filters 
                        for (let i=0; i<guitars.type.length; i++)
                            type[i] = guitars.type[i];
                        // Get brand filters
                        for (let i=0; i<guitars.brands.length; i++)
                            brands[i] = guitars.brands[i];
                        // Get color filters
                        for (let i=0; i<guitars.colors.length; i++)
                            colors[i] = guitars.colors[i];
                        // Get price filters
                        min_price = guitars.min_price;
                        max_price = guitars.max_price;

                        brands.sort();
                        colors.sort();
                    }
                });

                // APPEND FILTERS FOR ========================================================
                // Type
                for (let i=0; i<type.length; i++){
                    let li = document.createElement('li');
                    let label = document.createElement('label');
                    let input = document.createElement('input');

                    li.setAttribute("id", 'li-type'+i);
                    label.setAttribute("id", 'label-type'+i);
                    input.setAttribute("type", "checkbox");
                    input.setAttribute("id", type[i]);
                    input.setAttribute("name", 'type[]');
                    input.setAttribute("value", type[i]);

                    document.getElementById('guitar-type').appendChild(li);
                    document.getElementById('li-type'+i).appendChild(label);
                    document.getElementById("label-type"+i).appendChild(input);
                    label.appendChild(document.createTextNode(type[i]));
                }
                // Brand
                for (let i=0; i<brands.length; i++){
                    let li = document.createElement('li');
                    let label = document.createElement('label');
                    let input = document.createElement('input');

                    li.setAttribute("id", 'li-brand'+i);
                    label.setAttribute("id", 'label-brand'+i);
                    input.setAttribute("type", "checkbox");
                    input.setAttribute("id", brands[i]);
                    input.setAttribute("name", 'brands[]');
                    input.setAttribute("value", brands[i]);

                    document.getElementById('guitar-brands').appendChild(li);
                    document.getElementById('li-brand'+i).appendChild(label);
                    document.getElementById("label-brand"+i).appendChild(input);
                    label.appendChild(document.createTextNode(brands[i]));
                }
                // Color
                for (let i=0; i<colors.length; i++){
                    let li = document.createElement('li');
                    let label = document.createElement('label');
                    let input = document.createElement('input');

                    li.setAttribute("id", 'li-color'+i);
                    label.setAttribute("id", 'label-color'+i);
                    input.setAttribute("type", "checkbox");
                    input.setAttribute("id", colors[i]);
                    input.setAttribute("name", 'colors[]');
                    input.setAttribute("value", colors[i]);

                    document.getElementById('guitar-colors').appendChild(li);
                    document.getElementById('li-color'+i).appendChild(label);
                    document.getElementById("label-color"+i).appendChild(input);
                    label.appendChild(document.createTextNode(colors[i]));
                }
                // Min price
                $('#min_slider').prop('min', min_price);
                $('#min_slider').prop('max', max_price);
                $('#min_slider').prop('value', min_price);
                $('#min_slider_p').html(min_price);
                // Max price
                $('#max_slider').prop('min', min_price);
                $('#max_slider').prop('max', max_price);
                $('#max_slider').prop('value', max_price);
                $('#max_slider_p').html(max_price);
                // Functions for price-slider
                $(document).on('input', '#min_slider', function() {
                    $('#min_slider_p').html( $(this).val() );
                });
                $(document).on('input', '#max_slider', function() {
                    $('#max_slider_p').html( $(this).val() );
                });



                // Number of Checkbox checked by category
                $('#guitar-type input').click(function(){
                    let count = $('#guitar-type input:checked');
                    $('#guitar-type input[type=text]').val(count.val());
                });
                $('#guitar-brands input').click(function(){
                    let count = $('#guitar-brands input:checked');
                    $('#guitar-brands input[type=text]').val(count.length);
                });
                $('#guitar-colors input').click(function(){
                    let count = $('#guitar-colors input:checked');
                    $('#guitar-colors input[type=text]').val(count.length);
                });
                
                $('button').click(function(){
                    var type = $('#guitar-type input:checked');
                    var brand = $('#guitar-brands input:checked');
                    var color = $('#guitar-colors input:checked');

                    if (type.length == 0) $('#guitar-type input').prop('checked','true');
                    if (brand.length == 0) $('#guitar-brands input').prop('checked','true');
                    if (color.length == 0) $('#guitar-colors input').prop('checked','true');
                });
            });
        </script>
    </body>
</html>