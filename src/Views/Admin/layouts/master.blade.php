<!doctype html>
<html lang="en">

<!-- Mirrored from vetra.laborasyon.com/demos/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Nov 2023 15:04:23 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Allaia</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/img/favicon.ico" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&amp;display=swap"
        rel="stylesheet">

    <!-- Bootstrap icons -->
    <link rel="stylesheet" href="../assets/dist/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css" type="text/css">
    <!-- Bootstrap Docs -->
    <link rel="stylesheet" href="../assets/dist/css/bootstrap-docs.css" type="text/css">

    <!-- Slick -->
    <link rel="stylesheet" href="../assets/libs/slick/slick.css" type="text/css">

    <!-- Main style file -->
    <link rel="stylesheet" href="../assets/dist/css/app.min.css" type="text/css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <!-- preloader -->
    <!-- <div class="preloader">
    <img src="https://vetra.laborasyon.com/assets/images/logo.svg" alt="logo">
    <div class="preloader-icon"></div>
    </div> -->
    <!-- ../ preloader -->

    <!-- sidebars -->
    @include('layouts.slidebar')
    <!-- search sidebar -->

    <!-- ../ header -->

    <!-- content -->
    <div class="layout-wrapper">

        <!-- header -->
        <div class="row">
            <div class="header col-12">
                <div class="menu-toggle-btn">
                    <!-- Menu close button for mobile devices -->
                    <a href="#">
                        <i class="bi bi-list"></i>
                    </a>
                </div>
                <!-- Logo -->
                <a href="index-2.html" class="logo">
                    {{-- <img width="100" src="https://vetra.laborasyon.com/assets/images/logo.svg" alt="logo"> --}}
                </a>
                <!-- ../ Logo -->
                <div class="page-title">
                    <a href="{{ BASE_URL }}">Home</a>
                </div>
                <!-- <form class="search-form">
            <div class="input-group">
            <button class="btn btn-outline-light" type="button" id="button-addon1">
                <i class="bi bi-search"></i>
            </button>
            <input type="text" class="form-control" placeholder="Search..."
                   aria-label="Example text with button addon" aria-describedby="button-addon1">
            <a href="#" class="btn btn-outline-light close-header-search-bar">
                <i class="bi bi-x"></i>
            </a>
            </div>
            </form> -->
            </div>
        </div>

        <!-- Header mobile buttons -->
        {{-- <div class="header-mobile-buttons">
            <a href="#" class="search-bar-btn">
                <i class="bi bi-search"></i>
            </a>
            <a href="#" class="actions-btn">
                <i class="bi bi-three-dots"></i>
            </a>
        </div> --}}
        <div class="content ">
            @yield('content')
        </div>
    </div>

    <!-- ../ content -->

    <!-- content-footer -->

    <!-- ../ content-footer -->
    <!-- ../ layout-wrapper -->

    <!-- Bundle scripts -->
    <script src="../assets/libs/bundle.js"></script>

    <!-- Apex chart -->
    <script src="../assets/libs/charts/apex/apexcharts.min.js"></script>

    <!-- Slick -->
    <script src="../assets/libs/slick/slick.min.js"></script>

    <!-- Examples -->
    <script src="../assets/dist/js/examples/dashboard.js"></script>

    <!-- Main Javascript file -->
    <script src="../assets/dist/js/app.min.js"></script>
</body>

<!-- Mirrored from vetra.laborasyon.com/demos/default/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Nov 2023 15:04:23 GMT -->

</html>
