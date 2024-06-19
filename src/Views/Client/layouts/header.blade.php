<header class="version_1">
    <div class="layer"></div><!-- Mobile menu overlay mask -->
    <div class="main_header">
        <div class="container">
            <div class="row small-gutters">
                <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                    <div id="logo">
                        <a href="{{ BASE_URL }}"><img src="../assets/img/logo.svg" alt="" width="100"
                                height="35"></a>
                    </div>
                </div>
                <nav class="col-xl-6 col-lg-7">
                    <a class="open_close" href="javascript:void(0);">
                        <div class="hamburger hamburger--spin">
                            <div class="hamburger-box">
                                <div class="hamburger-inner"></div>
                            </div>
                        </div>
                    </a>
                    <!-- Mobile menu button -->
                    <div class="main-menu">
                        <div id="header_menu">
                            <a href="index.html"><img src="img/logo_black.svg" alt="" width="100"
                                    height="35"></a>
                            <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                        </div>
                        <ul>
                            <li class="">
                                <a href="{{ BASE_URL }}" class="">Home</a>
                            </li>
                            <li class="megamenu submenu">
                                <a href="{{ BASE_URL . 'products' }}" class="show-submenu-mega">PRODUCTS</a>
                                <div class="menu-wrapper">
                                    <div class="row small-gutters">
                                        <div class="col-lg-5">
                                            <ul>
                                                @foreach ($categories as $category)
                                                    <li><a
                                                            href="{{ BASE_URL . 'category/' . $category->id }}">{{ $category->category_name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        {{-- <div class="col-lg-3 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                                            <div class="banner_menu">
                                                <a href="#0">
                                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                                        data-src="img/banner_menu.jpg" width="400" height="550"
                                                        alt="" class="img-fluid lazy">
                                                </a>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <!-- /row -->
                                </div>
                                <!-- /menu-wrapper -->
                            </li>
                            <li class="megamenu submenu">
                                <a href="javascript:void(0);" class="show-submenu-mega">ACCOUNT</a>
                                <div class="menu-wrapper">
                                    <div class="row small-gutters">
                                        <div class="col-lg-5">
                                            <ul>
                                                @if (isset($_SESSION['user']))
                                                    @if ($_SESSION['user'][0]->role == 'admin' ||  $_SESSION['user'][0]->role == 'manager')
                                                        <li><a class="dropdown-item" href="{{BASE_URL .'admin'}}">Admin</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ BASE_URL . 'infor/' . $_SESSION['user'][0]->id }}">Thông
                                                                tin tài khoản</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ BASE_URL . 'listOrder/' . $_SESSION['user'][0]->id }}">Đơn
                                                                hàng</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ BASE_URL . 'cart/' . $_SESSION['user'][0]->id }}">Giỏ
                                                                hàng</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ BASE_URL . 'logout' }}">Đăng
                                                                Xuất</a></li>
                                                    @endif
                                                @endif
                                                @if (isset($_SESSION['user']))
                                                    @if ($_SESSION['user'][0]->role == 'customer')
                                                        <li><a class="dropdown-item"
                                                                href="{{ BASE_URL . 'infor/' . $_SESSION['user'][0]->id }}">Thông
                                                                tin tài khoản</a>
                                                        </li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ BASE_URL . 'listOrder/' . $_SESSION['user'][0]->id }}">Đơn
                                                                hàng</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ BASE_URL . 'cart/' . $_SESSION['user'][0]->id }}">Giỏ
                                                                hàng</a></li>
                                                        <li><a class="dropdown-item"
                                                                href="{{ BASE_URL . 'logout' }}">Đăng
                                                                Xuất</a></li>
                                                    @endif
                                                @endif
                                                @if (!isset($_SESSION['user']))
                                                    <li><a class="dropdown-item" href="{{ BASE_URL . 'login' }}">Đăng
                                                            Nhập</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="col-lg-3 d-xl-block d-lg-block d-md-none d-sm-none d-none">
                                            <div class="banner_menu">
                                                <a href="#0">
                                                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="
                                                        data-src="img/banner_menu.jpg" width="100" height="200"
                                                        alt="" class="img-fluid lazy">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /row -->
                                </div>
                                <!-- /menu-wrapper -->
                            </li>
                        </ul>
                    </div>
                    <!--/main-menu -->
                </nav>
                <div class="col-xl-3 col-lg-2 d-lg-flex align-items-center justify-content-end text-end">
                    <a class="phone_top" href="tel://9438843343"><strong><span>Need Help?</span>+94
                            423-23-221</strong></a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <!-- /main_header -->

    <div class="main_nav inner Sticky">
        <div class="container">
            <div class="row small-gutters" style="height: 60px">
                <div class="col-xl-3 col-lg-3 col-md-3">
                    <nav class="categories">
                        <ul class="clearfix">
                            <li><span>
                                    <a href="#">
                                        <span class="hamburger hamburger--spin">
                                            <span class="hamburger-box">
                                                <span class="hamburger-inner"></span>
                                            </span>
                                        </span>
                                        Categories
                                    </a>
                                </span>
                                <div id="menu">
                                    <ul>
                                        <li><span><a href="#0">Collections</a></span>
                                            <ul>
                                                <li><a href="listing-grid-1-full.html">Trending</a></li>
                                                <li><a href="listing-grid-2-full.html">Life style</a></li>
                                                <li><a href="listing-grid-3.html">Running</a></li>
                                                <li><a href="listing-grid-4-sidebar-left.html">Training</a></li>
                                                <li><a href="listing-grid-5-sidebar-right.html">View all
                                                        Collections</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><span><a href="#">Men</a></span>
                                            <ul>
                                                <li><a href="listing-grid-6-sidebar-left.html">Offers</a></li>
                                                <li><a href="listing-grid-7-sidebar-right.html">Shoes</a></li>
                                                <li><a href="listing-row-1-sidebar-left.html">Clothing</a></li>
                                                <li><a href="listing-row-3-sidebar-left.html">Accessories</a></li>
                                                <li><a href="listing-row-4-sidebar-extended.html">Equipment</a></li>
                                            </ul>
                                        </li>
                                        <li><span><a href="#">Women</a></span>
                                            <ul>
                                                <li><a href="listing-grid-1-full.html">Best Sellers</a></li>
                                                <li><a href="listing-grid-2-full.html">Clothing</a></li>
                                                <li><a href="listing-grid-3.html">Accessories</a></li>
                                                <li><a href="listing-grid-4-sidebar-left.html">Shoes</a></li>
                                            </ul>
                                        </li>
                                        <li><span><a href="#">Boys</a></span>
                                            <ul>
                                                <li><a href="listing-grid-6-sidebar-left.html">Easy On Shoes</a></li>
                                                <li><a href="listing-grid-7-sidebar-right.html">Clothing</a></li>
                                                <li><a href="listing-row-3-sidebar-left.html">Must Have</a></li>
                                                <li><a href="listing-row-4-sidebar-extended.html">All Boys</a></li>
                                            </ul>
                                        </li>
                                        <li><span><a href="#">Girls</a></span>
                                            <ul>
                                                <li><a href="listing-grid-1-full.html">New Releases</a></li>
                                                <li><a href="listing-grid-2-full.html">Clothing</a></li>
                                                <li><a href="listing-grid-3.html">Sale</a></li>
                                                <li><a href="listing-grid-4-sidebar-left.html">Best Sellers</a></li>
                                            </ul>
                                        </li>
                                        <li><span><a href="#">Customize</a></span>
                                            <ul>
                                                <li><a href="listing-row-1-sidebar-left.html">For Men</a></li>
                                                <li><a href="listing-row-2-sidebar-right.html">For Women</a></li>
                                                <li><a href="listing-row-4-sidebar-extended.html">For Boys</a></li>
                                                <li><a href="listing-grid-1-full.html">For Girls</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                    <form action="{{ BASE_URL . 'search' }}" method="get" onsubmit="return searchProduct()">
                        <div class="custom-search-input">
                            <input type="text" placeholder="Search over 10.000 products" name="keyword"
                                id="productSearch">
                            <button type="submit"><i class="header-icon_search_custom"></i></button>
                        </div>
                    </form>

                </div>
                @if (isset($_SESSION['user']))
                    <div class="col-md-2 text-end mt-4">
                        <a href="{{ BASE_URL . 'cart/' . $_SESSION['user'][0]->id }}" class="position-relative">
                            <i class="fa-solid fa-cart-shopping fa-2xl"></i>
                            <span
                                class="position-absolute top-0 start-80 translate-middle badge rounded-pill bg-danger">
                                @php
                                    $count = (new Luan\Project1\Models\CartModel())->getCart($_SESSION['user'][0]->id);
                                    echo count($count);
                                @endphp
                                <span class="visually-hidden"></span>
                            </span>
                        </a>
                    </div>
                @endif

                {{-- <p id = "" hidden>{{BASE_URL . 'search'}}</p> --}}
                <div class="col-xl-3 col-lg-2 col-md-3">
                    <ul class="top_tools">

                        {{-- <li>
                            <a href="#0" class="wishlist"><span>Wishlist</span></a>
                        </li> --}}
                        <li>
                            <div class="dropdown dropdown-access">
                                <div class="dropdown-center">

                                    {{-- <span aria-expanded="false" data-bs-toggle="dropdown"><button
                                            class="btn btn-primary mt-3">ACCOUNT</button></span>
                                    <ul class="dropdown-menu">
                                        @if (isset($_SESSION['user']))
                                            @if ($_SESSION['user'][0]->role == 'admin')
                                                <li><a class="dropdown-item" href="#">Admin</a></li>
                                                <li><a class="dropdown-item"
                                                        href="{{ BASE_URL . 'infor/' . $_SESSION['user'][0]->user_id }}">Thông
                                                        tin tài khoản</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#">Đơn hàng</a></li>
                                                <li><a class="dropdown-item" href="{{ BASE_URL . 'logout' }}">Đăng
                                                        Xuất</a></li>
                                            @endif
                                        @endif
                                        @if (isset($_SESSION['user']))
                                            @if ($_SESSION['user'][0]->role != 'admin')
                                                <li><a class="dropdown-item"
                                                        href="{{ BASE_URL . 'infor/' . $_SESSION['user'][0]->user_id }}">Thông
                                                        tin tài khoản</a>
                                                </li>
                                                <li><a class="dropdown-item" href="#">Đơn hàng</a></li>
                                                <li><a class="dropdown-item" href="{{ BASE_URL . 'logout' }}">Đăng
                                                        Xuất</a></li>
                                            @endif
                                        @endif
                                        @if (!isset($_SESSION['user']))
                                            <li><a class="dropdown-item" href="{{ BASE_URL . 'login' }}">Đăng
                                                    Nhập</a>
                                            </li>
                                        @endif
                                    </ul> --}}
                                </div>
                                <div class="dropdown-menu">
                                    <a href="account.html" class="btn_1">Sign In or Sign Up</a>
                                    <ul>
                                        <li>
                                            <a href="track-order.html"><i class="ti-truck"></i>Track your Order</a>
                                        </li>
                                        <li>
                                            <a href="account.html"><i class="ti-package"></i>My Orders</a>
                                        </li>
                                        <li>
                                            <a href="account.html"><i class="ti-user"></i>My Profile</a>
                                        </li>
                                        <li>
                                            <a href="help.html"><i class="ti-help-alt"></i>Help and Faq</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /dropdown-access-->
                        </li>
                        {{-- <li>
                            <a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
                        </li> --}}

                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        {{-- <form action="" method="POST" onsubmit="return searchProduct()">
        <div class="search_mob_wp">
            <input type="text" class="form-control" placeholder="Search over 10.000 products" name="productSearch">
            <input type="submit" class="btn_1 full-width" value="Search">
        </div>
        </form> --}}
        <!-- /search_mobile -->
    </div>
    <p id="url"hidden>{{ BASE_URL }}</p>
    <!-- /main_nav -->
</header>
<script>
    const carousel = new bootstrap.Carousel('#myCarousel');
</script>
<script>
    function searchProduct() {
        const keyword = document.getElementById('productSearch').value;
        const baseUrl = document.getElementById('url').innerText;
        const url = baseUrl + `search?keyword=` + keyword;
        window.location.replace(url)
        return false;
    }
</script>
