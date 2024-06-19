@extends('layouts.master')

@section('content')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="index.php">Trang chủ</a></li>
                        <li><a href="index.php?act=cart">Giỏ hàng</a></li>
                    </ul>
                </div>
                <h1>Giỏ hàng</h1>

            </div>
            <!-- /page_header -->
            @if (!empty($cart))
                <table class="table table-striped cart-list">
                    <thead>
                        <tr>

                            <th>
                                Tên sản phẩm
                            </th>
                            <th>

                            </th>
                            <th>
                                Size
                            </th>
                            <th>
                                Giá
                            </th>
                            <th>
                                Số lượng
                            </th>
                            <th>
                                Tổng tiền
                            </th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <tbody class="products-list">
                        @foreach ($cart as $item)
                            <tr class="products">
                                <td>{{ $item->product_name }} <br> @if ($item->statusCart == 0)
                                    <h6 class="text-danger">Hết hàng</h6>
                                @endif</td>
                                <td id="quantityProductDetail" hidden>{{ $item->quantityProductDetail }}</td>
                                <td class="product_detai_id" hidden>{{ $item->product_detail_id }}</td>
                                <td><a href="{{ BASE_URL . 'detail/' . $item->product_id }}"><img
                                            src="{{ BASE_URL . 'upload/' . $item->product_image }}" alt=""
                                            width="100"></a>
                                </td>
                                <td class="product_size">{{ $item->product_size }}</td>
                                <td class="user_id" hidden>{{ $_SESSION['user'][0]->id }}</td>
                                <td class="cart_id" hidden>{{ $_SESSION['cart'][0]->cart_id }} </td>
                                <td>{{ number_format($item->product_price, 0, ',', '.') . ' đ' }}</td>
                                <td class="col-2">
                                    <div class="row mt-3 ">
                                        {{-- <p hidden class="cart_detail_id" data-iddetail="{{ $item->cart_detail_id }}"> --}}
                                        {{-- {{ $item->cart_detail_id }}</p> --}}
                                        <div class="col-12 text-center mt-2" style="margin-left:10px ; display: flex"
                                            id="quantity">
                                            <input type="hidden" value="{{ $item->product_quantity }}">
                                            <button class="btn" style="width: 35px; border: solid 1px black"
                                                id="btn-dow">-</button>
                                            <p class="quantity" style="margin: 10px ; width: 20px;">
                                                {{ $item->product_quantity }}</p>
                                            <p class="quantityProductDetail" style="margin: 10px ; width: 20px;" hidden>
                                                {{ $item->quantityProductDetail }}</p>
                                            <input type="hidden" name="product_quantity"
                                                value="{{ $item->product_quantity }}" min="1">
                                            <input type="hidden" name="product_price" value="{{ $item->product_price }}">
                                            <div class="price_product" hidden>{{ $item->product_price }}</div>
                                            <button data-idPro="{{ $item->cart_detail_id }}" id="btn-up" class="btn"
                                                style="width: 35px; border: solid 1px black"
                                                {{-- onclick="up(this,{{ $item->product_detail_id }})" --}}>+</button>
                                        </div>
                                    </div>

                                </td>
                                <td class="col-3">
                                    <input type="text" id="price" value="{{ $item->total }}" hidden>
                                    <h6 class="text-danger" id="price_check">

                                        {{ number_format($item->total, 0, ',', '.') . ' đ' }}
                                    </h6>
                                </td>

                                <td>
                                    <a href="{{ BASE_URL . 'cart/delete/' . $item->cart_detail_id }}"
                                        class="text-danger"><button class="btn btn-danger"
                                            onclick="return confirm('có chắc muốn xóa không')">X</button></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
        <!-- /container -->
        <div class="box_cart">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-4 col-lg-6 col-md-12">
                        <div class="row">
                            <p class="updateTotalOrder" hidden></p>
                            <h4 id="total" class="col-xl-12 col-lg-6 col-md-12" style="color: #004dda;">
                                @php
                                    $sum = 0;
                                    foreach ($sumCart as $key) {
                                        $sum += $key->total;
                                    }

                                    echo 'Tổng tiền : ' . number_format($sum, 0, ',', '.') . ' đ';
                                @endphp
                            </h4>
                        </div>
                        {{-- <form action="{{BASE_URL .'order/'. $_SESSION['user'][0]->id}}" id="orderForm" method="post"> --}}
                        <a href="{{ BASE_URL . 'order/' . $_SESSION['user'][0]->id }}"><button
                                class="btn_1 full-width cart">Thanh toán</button></a>
                        {{-- <input type="submit" name="btn-cart" class="btn_1 full-width cart" id="orderButton"
                                    value="Thanh toán"></input> --}}
                        {{-- </form> --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- /box_cart -->
    @else
        <div style="height: 200px;" class="d-flex justify-content-center align-items-center text-center">
            <p>Không có sản phẩm trong giỏ hàng</p>
        </div>
        @endif
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        const productsList = document.querySelectorAll('.products')
        const elementTotal = document.querySelector('#total')
        const elementTotalOrder = document.querySelector('.updateTotalOrder')
        // console.log(elementTotal.innerText);

        let total = 0

        function totalPrice(price) {
            // priceTotal = Intl.NumberFormat('vi').format(total += price)
            total = total += price
            priceTotal = Intl.NumberFormat('vi').format(total)
            elementTotalOrder.innerText = total;
            elementTotal.innerHTML = `Tổng tiền : ${priceTotal}đ`
        }

        function edit_data(cart_detail_id, product_detai_id, cart_id, updateQuantity, product_size, updateTotal, user_id) {
            $.ajax({
                // url: "http://project-1.test/cart/5",
                url: `http://project-1.test/cart/${user_id}`,
                method: "POST",
                data: {
                    cart_detail_id: cart_detail_id,
                    product_detail_id: product_detai_id,
                    cart_id: cart_id,
                    product_quantity: updateQuantity,
                    product_size: product_size,
                    total: updateTotal

                },
                dataType: "json",
                success: function(data) {
                    alert("cap nhat thanh cong");
                }
            })
        }

        function autoReload(interval) {
            setTimeout(function() {
                location.reload();
            }, interval);
        }
        // autoReload(30000);
        productsList.forEach((product) => {
            const btnAdd = product.querySelector('#btn-up')
            const btnDow = product.querySelector('#btn-dow')
            const quantity = product.querySelector('.quantity')
            const price_product = product.querySelector('.price_product')
            const price_total = product.querySelector('#price_check')
            const price_total_post = product.querySelector('#price')
            const product_detai_id = product.querySelector('.product_detai_id').innerText
            const quantityProductDetail = Number(product.querySelector('#quantityProductDetail').innerText)

            const product_size = product.querySelector('.product_size').innerText
            const cart_id = product.querySelector('.cart_id').innerText
            const user = product.querySelector('.user_id').innerText
            const price = Number(price_total_post.value)
            const price_quantity = Number(price_product.innerText)
            total += price;

            let _quantity = Number(quantity.innerText)

            var cart_detail_id = btnAdd.dataset.idpro;
            var updateTotalOrder = elementTotalOrder.innerText;
            var updateProduct_detail_id = product_detai_id;
            var updateProduct_size = product_size;
            var updateCart_id = cart_id;
            var user_id = user;

            // if (quantityProductDetail < quantity.innerText) {
            //     quantity.innerText = quantityProductDetail
            //     console.log(price_quantity);
            //     // price_total_post.value = ( quantityProductDetail * price_quantity);
            //     var updateQuantity = quantityProductDetail;
            //     totalPrice(price_quantity)
            //     var updateTotal = quantityProductDetail * price_quantity;
            //     edit_data(cart_detail_id, updateProduct_detail_id, updateCart_id, updateQuantity,
            //         updateProduct_size, updateTotal, user_id);
            // }
            // else {
            // //     let _quantity = Number(quantity.innerText)
            // //     console.log(_quantity);

            // // }
            const id = btnAdd.dataset.idpro
            btnAdd.addEventListener('click', () => {
                if (Number(quantity.innerText) < quantityProductDetail) {
                    _quantity += 1
                    quantity.innerText = _quantity
                    price_total.innerText =
                        `${Intl.NumberFormat('vi').format(_quantity * price_quantity)}đ `
                    price_total_post.value = _quantity * price_quantity
                    totalPrice(price_quantity)
                    var updateQuantity = quantity.innerText;
                    var updateTotal = price_total_post.value;
                    edit_data(cart_detail_id, updateProduct_detail_id, updateCart_id, updateQuantity,
                        updateProduct_size, updateTotal, user_id)
                }




            })
            btnDow.addEventListener('click', () => {
                if (Number(quantity.innerText) > 1) {
                    _quantity -= 1
                    quantity.innerText = _quantity
                    price_total.innerText =
                        `${Intl.NumberFormat('vi').format(_quantity * price_quantity)}đ `
                    price_total_post.value = _quantity * price_quantity
                    totalPrice((-price_quantity))
                }
                var cart_detail_id = btnAdd.dataset.idpro;
                var updateQuantity = quantity.innerText;
                var updateTotal = price_total_post.value;
                var updateTotalOrder = elementTotalOrder.innerText;
                var updateProduct_detail_id = product_detai_id;
                var updateProduct_size = product_size;
                var updateCart_id = cart_id;
                var user_id = user;
                edit_data(cart_detail_id, updateProduct_detail_id, updateCart_id, updateQuantity,
                    updateProduct_size, updateTotal, user_id)
            })

        })






        // const btnUps = document.querySelectorAll('#btn-up')

        // btnUps.forEach((btn) => {
        //     console.log(btn.dataset);
        //     // const id = btn.
        //     // btn.addEventListener('click', )
        // })

        // function format2(n, currency) {
        //     return n.toFixed(1).replace(/(\d)(?=(\d{3})+\.)/g, '$1.') + currency;
        // }


        // function up(x, i) {
        //     console.log(x, i);
        //     var td = x.parentElement;
        //     // alert(td.childNodes[13].innerHTML);
        //     var quantity = parseInt(td.childNodes[2].innerHTML);
        //     var quantity1 = parseInt(td.childNodes[4].value);
        //     // var price = parseInt(td.childNodes[6].value);
        //     var price_product = parseInt(td.childNodes[8].innerHTML);
        //     // var price_product1 = parseInt(td.childNodes[11].innerHTML);
        //     // alert(price_product1);
        //     var newQuantity = quantity + 1;
        //     var newPrice = price_product * newQuantity;
        //     td.childNodes[2].innerHTML = newQuantity;
        //     td.childNodes[4].value = newQuantity;
        //     td.childNodes[6].value = newPrice;
        //     document.getElementById("price").value = newPrice;
        //     document.getElementById("price_check").innerHTML = format2(newPrice, 'đ ');
        // }

        // function dow(x, i) {
        //     var td = x.parentElement;
        //     var quantity = parseInt(td.childNodes[2].innerHTML);
        //     var quantity1 = parseInt(td.childNodes[4].value);
        //     var price = parseInt(td.childNodes[6].value);
        //     var price_product = parseInt(td.childNodes[8].innerHTML);
        //     if (quantity > 1) {
        //         var newPrice = price - price_product;
        //         var newQuantity = quantity - 1;
        //         td.childNodes[2].innerHTML = newQuantity;
        //         td.childNodes[4].value = newQuantity;
        //         td.childNodes[6].value = newPrice;
        //         document.getElementById("price").value = newPrice;
        //         document.getElementById("price_check").innerHTML = format2(newPrice, 'đ ');

        //     }

        // }
    </script>
    <!--/main-->
@endsection
