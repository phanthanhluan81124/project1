@extends('layouts.master')

@section('content')
    <div class="container">
        <h4 class="text-center mt-1">Thông tin đơn hàng</h4>
        <div class="row ">
            <div class="col-12 mt-2 mb-2" style="background-color: #004dda ;padding: 10px;"><img src="./../upload/logo.svg"
                    alt="" width="100" height="35">
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label for="" class="mt-2">Họ và tên người nhận:
                    {{ $inforOrder[0]->fullname }}</label>
                <br>
                <label for="">Email: {{ $inforOrder[0]->email }}</label><br>
                <label for="">Số điện thoại: {{ $inforOrder[0]->tel }}</label> <br>
                <label for="">Address: {{ $inforOrder[0]->address }}</label><br>
                <label for="">Ngày đặt hàng: {{ $inforOrder[0]->created_at }}</label><br>
                <label for="">Note: {{ $inforOrder[0]->note }}</label><br>
                <label for="">
                    @if ($inforOrder[0]->status == 'pending')
                        <h6 class="text-success">Trạng thái : Đơn hàng đang được xác nhận</h6>
                    @elseif ($inforOrder[0]->status == 'processing')
                        <h6 class="text-success">Trạng thái : Đơn hàng đã được xác nhận</h6>
                    @elseif ($inforOrder[0]->status == 'shiped')
                        <h6 class="text-success">Trạng thái : Đơn hàng đang được vẩn chuyển đến Khách hàng</h6>
                    @elseif ($inforOrder[0]->status == 'delivered')
                        <h6 class="text-success">Trạng thái : Đơn hàng đã được giao đến Khách hàng</h6>
                    @elseif ($inforOrder[0]->status == 'canceled')
                        <h6 class="text-danger">Trạng thái : Đơn hàng đã bị hủy</h6>
                    @endif
                </label>
            </div>
            <div class="col-md-4 text-end">
                @if ($inforOrder[0]->status == 'pending')
                    <form action="" method="POST">
                        {{-- <input type="hidden" name="user_id" value="{{  $inforOrder[0]->user_id }}">
                        <input type="hidden" name="fullname" value="{{ $inforOrder[0]->fullname }}">
                        <input type="hidden" name="email" value="{{ $inforOrder[0]->email }}">
                        <input type="hidden" name="tel" value="{{ $inforOrder[0]->tel }}">
                        <input type="hidden" name="address" value="{{ $inforOrder[0]->address }}">
                        <input type="hidden" name="total" value="{{ $inforOrder[0]->total }}">
                        <input type="hidden" name="total_discount" value="{{ $inforOrder[0]->total_discount }}">
                        <input type="hidden" name="payment_method" value="{{ $inforOrder[0]->payment_method }}">
                        <input type="hidden" name="status" value="{{ $inforOrder[0]->status }}">
                        <input type="hidden" name="order_id" value="{{ $inforOrder[0]->order_id }}"> --}}
                        <button class="btn btn-success" type="submit" name="update">Xác Nhận</button>
                        <button class="btn btn-danger" type="submit" name="cancel"
                            onclick="return confirm('Bạn có chắc muốn hủy đơn không?')">Hủy
                            đơn</button>
                    </form>
                @elseif($inforOrder[0]->status == 'delivered' || $inforOrder[0]->status == 'shiped' || $inforOrder[0]->status == 'canceled' )
                @else
                    <form action="" method="POST">
                        <button class="btn btn-success" type="submit" name="update">Cập nhật trạng thái</button>
                    </form>
                @endif
            </div>

        </div>
        @foreach ($orderDetail as $orderDetail)
            <div class="row">
                <div class="col-2">
                    <img src="{{ BASE_URL . 'upload/' . $orderDetail->product_image }}" alt="" width="150">
                </div>
                <div class="col-9 mt-2">
                    <h5>{{ $orderDetail->product_name }}</h5>
                    <h6>{{ number_format($orderDetail->price, 0, ',', '.') . ' đ' }}</h6>
                    <label>Size: {{ $orderDetail->product_size }}</label>
                    <p>Số lượng : {{ $orderDetail->quantity }}</p>
                    <h6 style="color: #004dda;">Thành Tiền :
                        {{ number_format($orderDetail->price * $orderDetail->quantity, 0, ',', '.') . ' đ' }}</h6>
                </div>
            </div>
            <hr>
        @endforeach
        <div class="row">
            <h3 style="color: #004dda;">Tổng Tiền :
                @php
                    if ($inforOrder[0]->total != $inforOrder[0]->total_discount) {
                        echo number_format($inforOrder[0]->total_discount, 0, ',', '.') . ' đ';
                        echo '<del style="font-size:15px; color:rgb(93, 92, 92); margin-left:5px;">' .
                            number_format($inforOrder[0]->total, 0, ',', '.') .
                            ' đ' .
                            '</del>';
                    } else {
                        echo number_format($inforOrder[0]->total, 0, ',', '.') . ' đ';
                    }
                @endphp
            </h3>
        </div>
    </div>
@endsection
