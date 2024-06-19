@extends('layouts.master')

@section('content')
    <main>

        <div class="container margin_30">

            <div class="row">
                <aside class="col-lg-3" id="sidebar_fixed">
                    <div class="filter_col">
                        {{-- <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div> --}}
                        <div class="filter_type version_2">
                            <h4><a href="#filter_1" data-bs-toggle="collapse" class="opened">Hãng</a></h4>
                            <div class="collapse show" id="filter_1">
                                <ul style="text-direction:none;">
                                    @foreach ($categories as $category)
                                        <li style="">
                                            <a href="{{ BASE_URL . 'category/' . $category->id }}"
                                                style="color:black;font-size:18px;font-weight: 500">{{ $category->category_name }}</a>
                                            <span class="checkmark"></span>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- /filter_type -->
                        </div>

                        <!-- /filter_type -->
                    </div>
                </aside>
                <!-- /col -->
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-2 mt-2"><label for="">Giá : </label></div>
                                <div class="col-md-8">
                                    <select name="price" id="price" class="form-control">
                                        @if (isset($_GET['gia']))
                                            <option value="">--Sắp Xếp--</option>
                                        @else
                                            <option value="" selected>--Sắp Xếp--</option>
                                        @endif

                                        @if (isset($_GET['gia']) && $_GET['gia'] == 'asc')
                                            <option value="?gia=asc" selected>--Tăng Dần--</option>
                                        @else
                                            <option value="?gia=asc">--Tăng Dần--</option>
                                        @endif
                                        @if (isset($_GET['gia']) && $_GET['gia'] == 'desc')
                                            <option value="?gia=desc" selected>--Giảm Dần--</option>
                                        @else
                                            <option value="?gia=desc">--Giảm Dần--</option>
                                        @endif

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row small-gutters mt-3">
                            @php
                                // print_r($products);
                            @endphp


                            {{-- <div class="col-6 col-md-4">
                            <div class="grid_item"> --}}

                            @foreach ($products as $product)
                                <div class="col-6 col-md-4 col-xl-3">
                                    <div class="grid_item">
                                        <figure>
                                            @if ($product->highlight == 1)
                                                <span class="ribbon off">Hot</span>
                                            @endif
                                            <a href="{{ BASE_URL . 'detail/' . $product->id }}">
                                                <img class="img-fluid lazy"
                                                    src="{{ BASE_URL . 'upload/' . $product->product_image }}"
                                                    data-src="{{ BASE_URL . 'upload/' . $product->product_image }}"
                                                    alt="">
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
                                                {{ number_format($product->product_price, 0, ',', '.') . ' đ' }}</h3>
                                            </span>
                                            </span>
                                        </div>
                                        <ul>
                                            <li><a href="{{ BASE_URL . 'detail/' . $product->id }}" class="tooltip-1"
                                                    data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="Thêm vào giỏ hàng"><i class="ti-shopping-cart"></i><span>Thêm vào
                                                        giỏ hàng</span></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /grid_item -->
                                </div>
                            @endforeach

                            <div class="text-start py-4" id="ListPage">
                                {{-- <form action = "{{BASE_URL . 'products'}}" method="GET" onsubmit="return Page()"> --}}
                                @for ($i = 1; $i < $number + 1; $i++)
                                    <a
                                        href = "@php if(!empty($_GET['gia'])){
                                            echo BASE_URL .$_GET['url']. '?gia='.$_GET['gia'].'&page=' . $i;
                                        }
                                        else {
                                            echo BASE_URL . $_GET['url'].'?page=' . $i;
                                        } @endphp 
                                    ">
                                        <button class="btn btn-primary" id ='page'>
                                            <p id="number" style="height: 5px;">{{ $i }}</p>
                                        </button>
                                    </a>
                                @endfor
                                {{-- </form> --}}
                            </div>
                        </div>
                        <!-- /grid_item -->
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /col -->
        </div>
        <!-- /row -->
        <p id="url" hidden>{{ BASE_URL }}</p>
        <p id="url1" hidden>{{ $_GET['url'] }}</p>
        </div>
        <!-- /container -->
        <style>
            /* Chrome, Safari, Edge, Opera */
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            /* Firefox */
            input[type=number] {
                -moz-appearance: textfield;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
            const select = document.getElementById('price');
            var URL = document.getElementById('url').innerText + document.getElementById('url1').innerText;
            console.log(URL);
            // urlCheck = location.search.split("&")
            // console.log(location.search.split("&"));
            // console.log(URL);
            $(document).ready(function() {
                var active = location.search;
                // console.log(active);
                $('#price option[value="' + active + '"]').attr('selected', 'selected');
            });
            $('#price').change(function() {
                const selectedValue = $(this).find(':selected').val();
                let url = URL + selectedValue;
                window.location.replace(url);
                console.log(url); // Hiển thị giá trị được chọn
            });


            // function onchange() {
            //     const selectedValue = this.value;
            //     let url = window.location.href + `?` + selectedValue;
            //     window.location.replace(url);
            //     console.log(selectedValue);
            // }
            // select.addEventListener('change', function() {
            //     const selectedValue = this.value;
            //     let url = window.location.href + `?` + selectedValue;
            //     window.location.replace(url);
            //     console.log(selectedValue);

            // });

            // const btn = document.querySelectorAll('#page');
            // btn.forEach(page => {
            //     function Page() {
            //         let url = window.location.href + `?page=` + number.innerText;

            //         // window.location.replace(url)
            //         // console.log(url);
            //         // return false;
            //     }
            // const number = page.querySelector('#number')
            // number.addEventListener('click', () => {
            //     number.preventDefault();

            // })

            // });
        </script>
        <script>
            // $('#price').change(function() {
            //     var value = $(this).find(':selected').val();
            //     alert(value);
            //     if (value != "") {
            //         // var url = document.getElementById('url').value + `/${value}`;
            //         // alert(url);
            //         var url = value;
            //         // alert(url);
            //         window.location.replace(url)
            //     }
            // })
        </script>
        <script>
            // function filterResults() {
            //     var filterForm = document.getElementById('filterForm');
            //     filterForm.addEventListener('submit', function(event) {
            //         // Chặn việc submit mặc định của form
            //         event.preventDefault();
            //     })
            //     // Lấy thông tin từ các ô checkbox được chọn
            //     var selectedBrands = document.querySelectorAll('input[name="thuong_hieu"]:checked');
            //     // var selectedPrices = document.querySelectorAll('input[name="gia"]:checked');

            //     console.log(selectedBrands);
            //     // console.log(selectedPrices);

            //     // Xử lý thông tin và truyền vào input
            //     var brandInput = document.getElementById('brandInput');
            //     // var priceInput = document.getElementById('priceInput');

            //     // Lấy thông tin thương hiệu
            //     var brandValues = Array.from(selectedBrands).map(function(checkbox) {
            //         return checkbox.value;
            //     });

            //     // Lấy thông tin giá
            //     // var priceValues = Array.from(selectedPrices).map(function(checkbox) {
            //     //     return checkbox.value;
            //     // });

            //     // Truyền thông tin vào input
            //     brandInput.value = brandValues.join(', ');
            //     // priceInput.value = priceValues.join(', ');

            //     // Submit form
            //     if(location.search !="" ){
            //         console.log(location.search, window.location.href);
            //         // window.location.replace(window.location.href+'&category='+ brandInput.value)
            //     }
            //     else{
            //         window.location.replace('&category='+ brandInput.value)
            //     }
            //     filterForm.submit();
            //     return false;
            // }
            function filterResults() {
                // const filterForm  = document.getElementById('')
                var selectedBrands = document.querySelectorAll('input[id="thuong_hieu"]:checked');
                var brandInput = document.getElementById('brandInput');
                var brandValues = Array.from(selectedBrands).map(function(checkbox) {
                    return checkbox.value;
                });
                brandInput.value = brandValues.join(', ');
                var inputBrand = document.getElementById('brandInput').value;
                if (location.search != "") {
                    if (location.search.split("&"))
                        window.location.replace(window.location.href + '&category=' + inputBrand);
                } else {
                    window.location.replace(window.location.href + '?category=' + inputBrand);
                }
                console.log(selectedBrands);
                console.log(brandInput);
                console.log(inputBrand);
                return false;
            }
        </script>
    </main>
    <!-- /main -->
@endsection
