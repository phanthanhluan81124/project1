@extends('layouts.master')

@section('content')
    <main class="bg_gray">
{{-- @php
    print_r($_SESSION['code'])
@endphp --}}

        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="index.php">Trang chủ</a></li>
                        <li><a href="index.php?act=cart">Giỏ hàng</a></li>
                        <li>Thanh toán</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-2"></div>
                <div class="col-lg-8 col-md-12">
                    <form action="" method="POST">

                </div>
                </form>
            </div>
            <!-- /page_header -->
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="step first">
                            <h3>1. Thông tin nhận hàng</h3>
                            <div class="tab-content checkout p-0">
                                <div class="tab-pane fade show active" id="tab_1" role="tabpanel"
                                    aria-labelledby="tab_1">
                                    <div class="form-group">
                                        <label for="" class="form-label">Họ và tên</label>
                                        <input type="text" name="fullname" class="form-control"
                                            value="@php
if(isset($data['fullname'])){
                                                    echo $data['fullname'];
                                                }else{
                                                    echo $user[0]->fullname;
                                                } @endphp
                                            "
                                            placeholder="">
                                    </div>
                                    <span>{{ $mess['fullname'] }}</span>
                                    <div class="form-group">
                                        <label for="" class="form-label">Email</label>
                                        <input type="email"
                                            value="@php
if(isset($data['email'])){
                                            echo $data['email'];
                                        }else{
                                            echo $user[0]->email;
                                        } @endphp"
                                            name="email" class="form-control" placeholder="">
                                        <span class="error"><span>{{ $mess['email'] }}</span></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Số điện thoại</label>
                                        <input type="text"
                                            value="@php
if(isset($data['tel'])){
                                            echo $data['tel'];
                                        }else{
                                            echo $user[0]->tel;
                                        } @endphp"
                                            name="tel" class="form-control" placeholder="">
                                        <span class="error"><span>{{ $mess['tel'] }}</span></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="form-label">Địa chỉ nhận hàng</label>
                                        <input type="text" name="address" class="form-control"
                                            value="@php
if(isset($data['address'])){
                                                echo $data['address'];
                                            }else{
                                                echo $user[0]->address;
                                            } @endphp"
                                            placeholder="Địa chỉ cụ thể">
                                    </div>
                                    <span>{{ $mess['address'] }}</span>
                                    <div class="form-group">
                                        <label for="" class="form-label">Lưu ý cho đơn hàng</label>
                                        <input type="text" name="note" value="{{ $data['note'] }}"
                                            class="form-control" placeholder="Lưu ý cho người bán">
                                    </div>
                                </div>
                                <!-- /tab_1 -->
                            </div>
                        </div>
                        <div class="step middle payments">
                            <h3>2. Phương thức thanh toán</h3>
                            <ul>
                                <li>
                                    <label class="container_radio">Thanh toán khi nhận hàng<a href="#0" class="info"
                                            data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                        <input type="radio" name="payment_method" value="cod" id= "cod"checked>
                                        <span class="checkmark">
                                            <p hidden id="checkMark"></p>
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label class="container_radio">Thanh toán qua VN Pay<a href="#0" class="info"
                                            data-bs-toggle="modal" data-bs-target="#payments_method"></a>
                                        <input type="radio" value="banking" name="payment_method" value="banking"
                                            id= "banking">
                                        <span class="checkmark"></span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <!-- /step -->
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="step last">
                            <h3>3. Tổng quan đơn hàng</h3>
                            <div class="box_general summary">
                                <ul>
                                    @foreach ($cart as $item)
                                        <li class="clearfix"><em><?= $item->product_quantity ?> x <?= $item->product_name ?>
                                                - Size <?= $item->product_size ?></em> :
                                            <span><?= number_format($item->total, 0, ',', '.') . ' đ' ?></span>
                                        </li>
                                    @endforeach
                                </ul>
                                {{-- <span>{{ $mess }}</span> --}}
                                <br>
                                <div class="input-group mb-3">
                                    <div class="input-group mb-3">
                                        <input type="text" value="" id="voucherCode" name="code"
                                            class="form-control" placeholder="Mã giảm giá" aria-label="Mã giảm giá"
                                            aria-describedby="applyVoucher">
                                        <button class="btn btn-primary" type="submit" id="applyVoucher">Áp dụng</button>
                                    </div>
                                </div>
                                <span>{{ $mess['code'] }}</span>
                                <ul>
                                    <li class="clearfix"><em><strong>Tổng tiền</strong></em> <span>
                                            @php
                                                $sum = 0;
                                                foreach ($cart as $key) {
                                                    $sum += $key->total;
                                                }

                                                echo number_format($sum, 0, ',', '.') . ' đ';
                                            @endphp</span>
                                    </li>
                                    <li class="clearfix"><em><strong>Giảm giá :-
                                                @if (isset($_SESSION['code'][0]) && $_SESSION['code'][0]->category_code == 0)
                                                    {{ number_format($_SESSION['code'][0]->value, 0, ',', '.') . ' đ' }}
                                                @endif
                                            </strong></em>
                                        {{-- <span id="discounted"></span> --}}
                                        @if (isset($_SESSION['code'][0]) && $_SESSION['code'][0]->category_code == 1)
                                            {{ $_SESSION['code'][0]->value . '%' }}
                                        @endif
                                    </li>
                                    <li class="clearfix"><em><strong>Phí vận chuyển</strong></em> <span>Miễn phí</span>
                                    </li>
                                </ul>
                                <div class="total clearfix" style="color: #004dda;font-size: 25px;font-weight: 600">Thành
                                    tiền : <span id="subtotal">
                                        @php
                                            $sum = 0;
                                            foreach ($cart as $key) {
                                                $sum += $key->total;
                                            }
                                            if (
                                                isset($_SESSION['code'][0]) &&
                                                $_SESSION['code'][0]->category_code == 0
                                            ) {
                                                echo number_format($sum - $_SESSION['code'][0]->value, 0, ',', '.') .
                                                    ' đ';

                                                echo '<h6> <del>' .
                                                    number_format($sum, 0, ',', '.') .
                                                    ' đ' .
                                                    '</del></h6>';
                                            } elseif (
                                                isset($_SESSION['code'][0]) &&
                                                $_SESSION['code'][0]->category_code == 1
                                            ) {
                                                echo number_format(
                                                    $sum - ($sum / 100) * $_SESSION['code'][0]->value,
                                                    0,
                                                    ',',
                                                    '.',
                                                ) . ' đ';
                                                echo '<h6> <del>' .
                                                    number_format($sum, 0, ',', '.') .
                                                    ' đ' .
                                                    '</del></h6>';
                                            } else {
                                                echo number_format($sum, 0, ',', '.') . ' đ';
                                            }
                                        @endphp</span>
                                </div>
                                {{-- <input type="hidden" value="1" name="checkout">
                                <input type="hidden" value="0" name="voucher" id="voucher"> --}}
                                <input type="hidden"
                                    value="@php
$sum = 0;
                                foreach ($cart as $key) {
                                    $sum += $key->total;
                                }
                                if(isset($_SESSION['code'][0]) && ($_SESSION['code'][0]->category_code == 0)){
                                echo $sum - $_SESSION['code'][0]->value;
                                }
                                else if(isset($_SESSION['code'][0]) && ($_SESSION['code'][0]->category_code == 1)){
                                    echo ($sum - (($sum/100)*$_SESSION['code'][0]->value));
                                }
                                else {
                                    echo $sum;
                                } @endphp"
                                    name="total_discount" id="total_discount">
                                <input type="hidden" name="status" value="pending">
                                <input type="hidden" name="created_at" value="">
                                <input type="hidden" name="updated_at" value="">
                                <input type="hidden" name="user_id" value="{{ $_SESSION['user'][0]->id }}">

                                <input type="hidden" name="total" id="total"
                                    value="@php
$sum = 0;
                                        foreach ($cart as $key) {
                                            $sum += $key->total;
                                        }
                                            echo $sum; @endphp">
                                <a href="{{ BASE_URL . 'order/' . $_SESSION['user'][0]->id }}"><button type="submit"
                                        class="btn_1 full-width" id="submit">Đặt hàng</button></a>
                            </div>
                            <!-- /box_general -->
                        </div>
                        <p id="checkQuantity" hidden>{{ $quantity_check }}</p>
                        <!-- /step -->
                    </div>
                </div>
            </form>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
    <script>
        const quantity_check = document.getElementById('checkQuantity').innerText;
        if (quantity_check == 1) {
            alert("Có sản phẩm bạn mua đã hết hàng vui lòng kiểm tra lại giỏ hàng !");
        }

        const payment_method = document.getElementById('banking');
        const payment = document.getElementById('cod');
        const button = document.getElementById('submit')
        payment_method.addEventListener('change', function() {
            if (this.checked) {
                button.setAttribute('name', 'payUrl');
            }
        });
        payment.addEventListener('change', function() {
            if (this.checked) {
                button.setAttribute('name', '');
            }
        });
    </script>
    <!--/main-->
@endsection
