<header>

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="#" class="logo">
                            <img src="{{asset('client/img/logo.png')}}" alt="">
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form>
                            <input class="input" placeholder="Search here" style="border-top-left-radius: 40px; border-bottom-left-radius: 40px;">

                            <button class="search-btn">Search</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->




                <!-- ACCOUNT -->
                @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                    <div class="col-md-1 clearfix">
                        <div class="header-ctn">
                            <!-- Cart -->
                            <div class="dropdown">
                                <a href="{{ route('shopping-cart.index') }}" class="" aria-expanded="true">

                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">{{ session('cart-count')?:0 }}</div>
                                </a>
                            </div>
                            <!-- /Cart -->
                        </div>
                    </div>

                    <a href="{{ route('profile.index') }}"><i class="fa fa-user-o"></i> My Account</a>

                    @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                    @endauth
                </div>
                @endif


            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
</header>