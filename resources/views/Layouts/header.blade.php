<!-- NAVBAR -->
<nav class="navbar row">
    <ul class="nav col-sm-6 justify-content-center ul-products">
        <li class="nav-item"><a href="/">Home</a></li>
        <li class="nav-item"><a href="/default_guitars">Guitars</a></li>
        <li class="nav-item"><a href="/test">Cycling</a></li>
        <li class="nav-item"><a href="/test">Snowboarding</a></li>
    </ul>
    <ul class="nav col-sm-6 justify-content-end ul-user-options">
        <li class='nav-item'><p style='color:whitesmoke;'>{{ session('user') }}</p></li>
        <li class="nav-item"><a href="/login">Login / Logout</a></li>
        <li class="nav-item"><a href="/cart" id='cart'>Cart ({{ session('cart_index') }})</a></li>
        <li class="nav-item"><a href="/favourite" id='fav'>Favorites ({{ session('fav_index') }})</a></li>
    </ul>
</nav>