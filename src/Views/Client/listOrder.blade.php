@extends('layouts.master')

@section('content')
    <main>
        <!-- layout-wrapper -->
        <div class="container margin_30">
            <div class="layout-wrapper">
                <!-- content -->
                <div class="content ">

                    <div class="row flex-column-reverse flex-md-row">

                        <div class="col-md-9">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-header mb-3">Đơn hàng của tôi</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($listOrder as $item)
                                <div class="container">
                                    <div class="card mt-2" style="padding: 10px;">
                                        <div class="row">
                                            <div class="col-3">
                                                @if ($item->status == 'pending')
                                                    <h6 class="text-success">Đơn hàng đang được xác nhận</h6>
                                                @elseif ($item->status == 'processing')
                                                    <h6 class="text-success">Đơn hàng đã được xác nhận</h6>
                                                @elseif ($item->status == 'shiped')
                                                    <h6 class="text-success">Đơn hàng đang được vẩn chuyển đến bạn</h6>
                                                @elseif ($item->status == 'delivered')
                                                    <h6 class="text-success">Đơn hàng đã được giao đến bạn</h6>
                                                @elseif ($item->status == 'canceled')
                                                    <h6 class="text-danger">Đơn hàng đã bị hủy</h6>
                                                @endif
                                            </div>
                                            <div class="col-6"></div>
                                            <div class="col-3" style="display: flex;">
                                                <a href="{{ BASE_URL . 'orderdetail/' . $item->order_id }}"><button
                                                        class="btn btn-primary me-2">Chi tiết đơn hàng</button></a>
                                                @if ($item->status == 'pending')
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="user_id"
                                                            value="{{ $_SESSION['user'][0]->id }}">
                                                        <input type="hidden" name="fullname" value="{{ $item->fullname }}">
                                                        <input type="hidden" name="email" value="{{ $item->email }}">
                                                        <input type="hidden" name="tel" value="{{ $item->tel }}">
                                                        <input type="hidden" name="address" value="{{ $item->address }}">
                                                        <input type="hidden" name="total" value="{{ $item->total }}">
                                                        <input type="hidden" name="total_discount"
                                                            value="{{ $item->total_discount }}">
                                                        <input type="hidden" name="payment_method"
                                                            value="{{ $item->payment_method }}">
                                                        <input type="hidden" name="status" value="{{ $item->status }}">
                                                        <input type="hidden" name="order_id"
                                                            value="{{ $item->order_id }}">
                                                        <button class="btn btn-danger" type="submit"
                                                            onclick="return confirm('Bạn có chắc muốn hủy đơn không?')">Hủy
                                                            đơn</button>
                                                    </form>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="container">
                                            <div class="row">
                                                <label for="" class="mt-2">Họ và tên người nhận:
                                                    {{ $item->fullname }}</label>
                                                <br>
                                                <label for="">Email: {{ $item->email }}</label><br>
                                                <label for="">Số điện thoại: {{ $item->tel }}</label> <br>
                                                <label for="">Address: {{ $item->address }}</label><br>
                                                <label for="">Ngày đặt hàng: {{ $item->created_at }}</label>
                                            </div>
                                            <div class="row mt-1">

                                                <div class="total clearfix"
                                                    style="color: #004dda;font-size: 20px;font-weight: 600">Tổng
                                                    tiền : <span id="subtotal">
                                                        @if ($item->total == $item->total_discount)
                                                            {{ number_format($item->total, 0, ',', '.') . ' đ' }}
                                                        @else
                                                            {{ number_format($item->total_discount, 0, ',', '.') . ' đ' }}

                                                            <del style="color:rgb(174, 173, 173);font-size: 15px;">
                                                                {{ number_format($item->total, 0, ',', '.') . ' đ' }}
                                                            </del>
                                                        @endif
                                                    </span>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                    <!-- ./ content -->
                </div>
            </div>
            <div class="text-center py-4" id="ListPage">
                @for ($i = 1; $i < $number + 1; $i++)
                    <a href = "{{ BASE_URL . $_GET['url'] . '?page=' . $i }}">
                        <button class="btn btn-primary" id ='page'>
                            <p id="number" style="height: 5px;">{{ $i }}</p>
                        </button>
                    </a>
                @endfor
                {{-- </form> --}}
            </div>
        </div>
    </main>
@endsection
