@extends('layouts.master')

@section('content')
    <main class="bg_gray">

        <div class="container">
            <div class="row mt-4">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ BASE_URL . 'upload/banner1.jpg' }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ BASE_URL . 'upload/banner2.jpg' }}" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ BASE_URL . 'upload/banner3.png' }}" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- /page_header -->
            </div>
            <div class="row mt-5">
                <h3 class="text-center">Sản Phẩm Bán Chạy

                </h3>
                <div class="row small-gutters">
                    @foreach ($products as $product)
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="grid_item">
                                <figure>
                                    <span class="ribbon off">Hot</span>
                                    <a href="{{ BASE_URL . 'detail/' . $product->id }}">
                                        <img class="img-fluid lazy" src="{{ BASE_URL . 'upload/' . $product->product_image }}"
                                            data-src="{{ BASE_URL . 'upload/' . $product->product_image }}" alt="">
                                    </a>
                                </figure>
                                <div class="rating">
                                    @for ($i = 0; $i < $product->rating; $i++)
                                        <img src="../upload/star-icon.webp" alt="" width="15">
                                    @endfor
                                    @for ($i = 0; $i < 5 - $product->rating; $i++)
                                        <img src="../upload/star.png" alt="" width="15">
                                    @endfor
                                </div>

                                <h5>
                                    {{ $product->product_name }}
                                </h5>
                                </a>
                                <div class="price_box">
                                    <span class="new_price">
                                        {{ $product->product_price }}
                                    </span>
                                    </span>
                                </div>
                                <ul>
                                    <li><a href="{{ BASE_URL . 'detail/' . $product->id }}" class="tooltip-1"
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Thêm vào giỏ hàng"><i
                                                class="ti-shopping-cart"></i><span>Thêm vào giỏ hàng</span></a></li>
                                </ul>
                            </div>
                            <!-- /grid_item -->
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row mt-5">
                <h3 class="text-center">Sản Phẩm New</h3>
                <div class="row small-gutters">
                    @foreach ($productsNew as $product)
                        <div class="col-6 col-md-4 col-xl-3">
                            <div class="grid_item">
                                <figure>
                                    <span class="ribbon off bg-primary">NEW</span>
                                    <a href="{{ BASE_URL . 'detail/' . $product->id }}">
                                        <img class="img-fluid lazy"
                                            src="{{ BASE_URL . 'upload/' . $product->product_image }}"
                                            data-src="{{ BASE_URL . 'upload/' . $product->product_image }}" alt="">
                                        <img class="img-fluid lazy" src="upload/" data-src="upload/" alt="">
                                    </a>
                                </figure>
                                <div class="rating">
                                    @for ($i = 0; $i <$product->rating ; $i++)
                                    <img src="../upload/star-icon.webp" alt="" width="15">
                                @endfor
                                @for ($i = 0; $i < (5-$product->rating); $i++)
                                    <img src="../upload/star.png" alt="" width="15">
                                @endfor
                                </div>
                                <h5>
                                    {{ $product->product_name }}
                                </h5>
                                </a>
                                <div class="price_box">
                                    <span class="new_price">
                                        {{ $product->product_price }}
                                    </span>
                                    </span>
                                </div>
                                <ul>
                                    <li><a href="{{ BASE_URL . 'detail/' . $product->id }}" class="tooltip-1"
                                            data-bs-toggle="tooltip" data-bs-placement="left" title="Thêm vào giỏ hàng"><i
                                                class="ti-shopping-cart"></i><span>Thêm vào giỏ hàng</span></a></li>
                                </ul>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
            <hr>
        </div>
        <!-- /container -->
    </main>
    <script>
        const carousel = new bootstrap.Carousel('#carouselExampleIndicators')
    </script>
@endsection
