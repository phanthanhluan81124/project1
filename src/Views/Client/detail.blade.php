@extends('layouts.master')

@section('content')
    <div class="container margin_30 ">
        <div class="row">
            <div class="col-md-6">
                <div id="carouselExampleFade" class="carousel slide carousel-fade">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ BASE_URL . 'upload/' . $product->product_image }}"
                                class="d-block w-100 h-100"alt="...">
                        </div>
                        @foreach ($images as $item)
                            <div class="carousel-item ">
                                <img src="{{ BASE_URL . 'upload/' . $item->image_name }}" class="d-block w-100 h-100"
                                    alt="...">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="{{ BASE_URL }}">Trang chủ</a></li>
                        <li><a href="{{ BASE_URL . 'category/' . $product->category_id }}">

                                {{ $category[0]->category_name }}
                            </a></li>
                        <li>
                            {{ $product->product_name }}
                        </li>
                    </ul>
                </div>
                <!-- /page_header -->
                <div class="prod_info">
                    <form action="" method="post" name="addCart" onsubmit="return checkAddCart()">
                        <h1>
                            {{ $product->product_name }}
                        </h1>
                        <span class="rating">
                            <em>
                                @php
                                    $i = 0;
                                    foreach ($comment as $value) {
                                        $i++;
                                    }
                                    echo $i;
                                @endphp
                                đánh giá
                            </em>
                        </span>
                        <p><small id="sku">

                            </small><br></p>
                        <div class="prod_options">
                            <div class="row" ng-app="myApp">
                                <label class="col-xl-5 col-lg-5  col-md-6 col-6 pt-0"><strong>Size</strong></label>
                                <div class="col-xl-5 col-lg-8 col-md-6 col-6 colors">
                                    <div class="row">
                                        @foreach ($productSize as $size)
                                            <div class="col-lg-3 me-1" id="product_size">
                                                <div class="input-group">
                                                    <div class="input-group-text bg-light mt-2">
                                                        <input class="form-check-input mt-0 me-1" type="radio"
                                                            id="product_detail_id" name="product_detail_id"
                                                            value="{{ $size->product_detail_id }}"
                                                            data-idpd ="{{ $size->product_detail_id }}"
                                                            aria-label="Radio button for following text input">
                                                        <div class="product_quantity_size" hidden>
                                                            {{ $size->product_quantity }}
                                                        </div>
                                                        {{ $size->product_size }}
                                                    </div>

                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="col-xl-5 col-lg-5  col-md-6 col-6"><strong>Số lượng</strong></label>
                                <div class="col-xl-4 col-lg-5 col-md-6 col-6">

                                    <div class="input-group mb-3">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="button-addon1">-</button>
                                        {{-- <p id="product_quantity">2</p> --}}
                                        <input type="text" class="form-control text-center" name="product_quantity"
                                            aria-label="Recipient's username" aria-describedby="button-addon2"
                                            min="1" value="1" id="product_quantity">
                                        <button class="btn btn-outline-secondary" type="button"
                                            id="button-addon2">+</button>
                                    </div>
                                    {{-- <div class="col-3"> <button class="btn btn-primary" id="btn-dow">-</button></div>
                                            <div class="col-6"><input type="text" name="product_quantity"
                                                    class="form-control" value="1" min="1" max="" style="border:solid 1px #FFF ">
                                               
                                            </div>
                                            <div class="col-3"><button class="btn" id="btn-add">+</button></div> --}}

                                    <div class="mt-1"id="quantity" style="color: #004dda"></div>
                                    <div class="mt-1"id="quantity_check" hidden></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-5 col-md-6">
                                <div class="price_main">
                                    <span class="new_price ">
                                        <h3 style="color:#004dda ;">
                                            @if ($product->discounted_price != null && $product->discounted_price != 0)
                                                {{ number_format($product->discounted_price, 0, ',', '.') . ' đ' }} <br>
                                                <span class="old_price text-drak">
                                                    {{ number_format($product->product_price, 0, ',', '.') . ' đ' }}</span>
                                            @else
                                                {{ number_format($product->product_price, 0, ',', '.') . ' đ' }}
                                            @endif
                                        </h3>
                                    </span>


                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <input type="hidden" name="total" value="{{ $product->product_price }}">
                                {{-- <input type="hidden" name="user_id" value="{{ $_SESSION['user'][0]->id }}"> --}}
                                <input type="hidden" name="cart_id" value="{{ $_SESSION['cart'][0]->cart_id }}">
                                {{-- <input type="hidden" value=" $sizeAndQuantity[0]['sku'] ?>" name="sku"
                                    id="sku_1"> --}}
                                <style>
                                    #submitForm {
                                        width: 200px;
                                        height: 50px;
                                        background-color: #004dda;
                                        color: #FFF;
                                        font-size: 18px;
                                        font-weight: 400;
                                    }

                                    #submitForm:hover {
                                        background: #ffc107;
                                        font-size: 18px;
                                        font-weight: 400;
                                        color: black;
                                    }
                                </style>
                                <button type="submit" id="submitForm" class="btn btn">Thêm vào giỏ hàng</button>

                            </div>
                        </div>
                    </form>
                    <input type="hidden" name="check" id="check" value="{{ $check }}">
                    <input type="hidden" name="quantity" id="quantity"
                        value="{{ $checkQuantitySize[0]->product_quantity }}">
                </div>
            </div>
        </div>
        <script>
            const product_size = document.querySelectorAll('#product_size');
            const quantity_check = document.querySelector('#quantity')
            const _quantity_check = document.querySelector('#quantity_check')
            // console.log(_product_quantity);
            product_size.forEach(product => {
                // const btnAdd = product.querySelector('#btn-up');
                const quantity = product.querySelector('.product_quantity_size')
                const product_detail = product.querySelector('#product_detail_id')
                const id = product_detail.dataset.idpd
                const _quantity = Number(quantity.innerText)

                product_detail.addEventListener('click', () => {

                    quantity_check.innerHTML = `<em> Số lượng sản phẩm : ${_quantity}</em>`;
                    _quantity_check.innerHTML = _quantity;
                })


            });
            const btnAdd = document.querySelector('#button-addon2')
            const btnDow = document.querySelector('#button-addon1')
            // console.log(btnAdd);
            btnAdd.addEventListener('click', () => {
                const product_quantity = document.getElementById('product_quantity');
                const _product_quantity = Number(product_quantity.value)
                // console.log(Number(_quantity_check.innerText));
                console.log(_product_quantity);
                if ((Number(_quantity_check.innerText)) != 0 && (Number(_quantity_check.innerText)) >
                    _product_quantity) {
                    product_quantity.value = _product_quantity + 1;
                }
                if ((Number(_quantity_check.innerText)) == 0) {
                    // alert("Vui lòng chọn size!")
                    return false
                }
            })
            btnDow.addEventListener('click', () => {
                const product_quantity = document.getElementById('product_quantity');
                const _product_quantity = Number(product_quantity.value)
                console.log(Number(_quantity_check.innerText));
                console.log(_product_quantity);
                if ((Number(_quantity_check.innerText)) != 0 && (Number(_quantity_check.innerText)) >=
                    _product_quantity && _product_quantity > 1) {
                    product_quantity.value = _product_quantity - 1;
                }
                if ((Number(_quantity_check.innerText)) == 0) {
                    // alert("Vui lòng chọn size!")
                    return false
                }
            })
        </script>
        <!-- /row -->
        <!-- /container -->
        <div class="tabs_product mt-3">
            <div class="row">
                <h3>Mô tả </h3>
                <div style="padding: 10px;">
                    <p> {{ $product->product_describe }}</p>
                </div>
            </div>
            <div class="row">
                <h3>Đánh giá</h3>
                <form action="" method="POST" name="comment" onsubmit="return checkComment()">
                    <style>
                        .rating-stars ul {
                            list-style-type: none;
                            padding: 0;

                            -moz-user-select: none;
                            -webkit-user-select: none;
                        }

                        .rating-stars ul>li.star {
                            display: inline-block;

                        }

                        /* Idle State of the stars */
                        .rating-stars ul>li.star>i.fa {
                            font-size: 2.5em;
                            /* Change the size of the stars */
                            color: #ccc;
                            /* Color on idle state */
                        }

                        /* Hover state of the stars */
                        .rating-stars ul>li.star.hover>i.fa {
                            color: #FFCC36;
                        }

                        /* Selected state of the stars */
                        .rating-stars ul>li.star.selected>i.fa {
                            color: #FF912C;
                        }
                    </style>
                    <div class="card" style="padding: 10px;">
                        <div class='rating-stars text-center'>
                            <ul id='stars'>
                                <li class='star' title='Poor' data-value='1' value="1" name="star">
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Fair' data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Good' data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='Excellent' data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star' title='WOW!!!' data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                            <input type="hidden" name="number_stars" class='text-message'>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id" value="{{ $_SESSION['user'][0]->id }}">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="content"
                                    placeholder="Đánh giá của bạn về sản phẩm" aria-label="Đánh giá của bạn về sản phẩm"
                                    aria-describedby="button-addon2">
                                <button class="btn btn-outline-primary" type="sumbit" id="button-addon2">Gửi</button>
                            </div>
                            {{-- <button type="submit">Gửi</button> --}}
                        </div>
                    </div>
                </form>
                <div class="container">
                    <div class='review_content mt-2'>
                        @foreach ($comment as $item)
                            <span>
                                @for ($i = 0; $i < $item->number_stars; $i++)
                                    <img src="../upload/star-icon.webp" alt="" width="15">
                                @endfor
                                @for ($i = 0; $i < 5 - $item->number_stars; $i++)
                                    <img src="../upload/star.png" alt="" width="15">
                                @endfor
                            </span>
                            <h6>
                                Khách hàng : {{ $item->username }}
                            </h6>


                            <p>
                                Nội dung : {{ $item->content }}
                            </p>
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

        <!-- /tab_content_wrapper -->
    </div>

    <div class="container margin_60_35">
        <div class="main_title">
            <h2>Sản phẩm liên quan</h2>
            <span>Products</span>
            <p>Những sản phẩm bạn cũng có thể thích</p>
        </div>
        {{-- <div class="owl-carousel owl-theme products_carousel"> --}}
        {{-- @php
                print_r($products[0]->product_name)
            @endphp --}}
        <div class="row small-gutters">
            @foreach ($products as $product)
                <div class="col-6 col-md-4 col-xl-3">
                    <div class="grid_item">
                        <figure>

                            <a href="{{ BASE_URL . 'detail/' . $product->id }}">
                                <img class="img-fluid lazy" src="{{ BASE_URL . 'upload/' . $product->product_image }}"
                                    data-src="{{ BASE_URL . 'upload/' . $product->product_image }}" alt="">
                            </a>
                        </figure>
                        <div class="rating">

                            {{-- @if ($product->rating != null) --}}
                            @for ($i = 0; $i < $product->rating; $i++)
                                <img src="../upload/star-icon.webp" alt="" width="15">
                            @endfor
                            @for ($i = 0; $i < 5 - $product->rating; $i++)
                                <img src="../upload/star.png" alt="" width="15">
                            @endfor
                            {{-- @endif --}}
                            {{-- <i class='icon-star'></i><i class='icon-star'></i><i class='icon-star'></i><i
                                class='icon-star'></i> --}}
                        </div>

                        <h5>
                            {{ $product->product_name }}
                        </h5>
                        </a>
                        <div class="price_box">
                            <span class="new_price">
                                {{ number_format($product->product_price, 0, ',', '.') . ' đ' }}</h3>
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
    <!-- /products_carousel -->
    </div>
    <!-- /container -->

    <div class="feat">
        <div class="container">
            <ul>
                <li>
                    <div class="box">
                        <i class="ti-gift"></i>
                        <div class="justify-content-center">
                            <h3>Miễn phí vận chuyển</h3>
                            <p>Cho đơn hàng trên 3 triệu</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-wallet"></i>
                        <div class="justify-content-center">
                            <h3>Thanh toán bảo mật</h3>
                            <p>100% bảo mật thanh toán</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="box">
                        <i class="ti-headphone-alt"></i>
                        <div class="justify-content-center">
                            <h3>Hỗ trợ 24/7</h3>
                            <p>Hỗ trợ nhiệt tình, nhanh chóng</p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <script>
        // const carousel = new bootstrap.Carousel('#myCarousel')
        // var isLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function() {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function(e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function() {
                $(this).parent().children('li.star').each(function(e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function() {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                $(document).ready(function() {
                    $("input[name='number_stars']").val(function() {
                        return ratingValue;
                    });
                });
                var msg = "";
                if (ratingValue > 1) {
                    msg = "Thanks! You rated this " + ratingValue + " stars.";

                } else {
                    msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
                }
                responseMessage(msg);

            });


        });


        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }
        $.ajax({

        })
    </script>
    <script>
        const check = document.getElementById("check").value;
        var product_detail_id = document.getElementById("product_detail_id").value;
        const quantity = document.getElementById("quantity").innerText;
        const quantity_value = document.getElementById("product_quantity").value;
        console.log(quantity, quantity_value);
        if (product_detail_id == "") {
            alert("vui lòng chọn size");
        } else if (check == 2) {
            alert("số lượng sản phẩm vừa thêm và số lượng sản phẩm trong giỏ hàng đã lớn hơn số lượng sản phẩm trong kho");
        } else if (check == 3) {
            alert("Bạn cần mua sản phẩm mới cớ thể bình luận! Thank you");
        }

        function checkAddCart() {
            var product_detail_id = document.addCart.product_detail_id.value;
            var cart_id = document.addCart.cart_id.value;
            const quantity = document.getElementById("quantity").innerText;
            const quantity_value = document.getElementById("product_quantity").value;
            // if (quantity < quantity_value) {
            //     alert("Số lượng sản phẩm không đủ");
            //     return false;
            // }
            if (cart_id == "") {
                alert("Vui lòng đăng nhập");
                return false;
            } else if (product_detail_id == "") {
                alert("vui lòng chọn size");
                return false;
            }
        }

        function checkComment() {
            var number_stars = document.comment.number_stars.value;
            var content = document.comment.content.value;
            var user = document.comment.user_id.value;
            if (user == "") {
                alert("vui lòng đăng nhập");
                return false;
            } else if (number_stars == "") {
                alert("vui lòng chọn số sao đánh giá");
                return false;
            } else if (content == "") {
                alert("vui lòng nhập nội dung đánh giá");
                return false;
            }
            return true;
        }
    </script>
    </main>
@endsection
