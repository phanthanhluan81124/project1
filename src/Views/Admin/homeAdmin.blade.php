@extends('layouts.master')

@section('content')
    {{-- <h1>hello</h1> --}}
    <div class="row row-cols-1 row-cols-md-12 g-4">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="display-7">
                                <i class="bi bi-basket"></i>
                            </div>
                            {{-- <div class="dropdown ms-auto">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-sm" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item">View Detail</a>
                                    <a href="#" class="dropdown-item">Download</a>
                                </div>
                            </div> --}}
                        </div>
                        <h4 class="mb-3">Đơn hàng</h4>
                        <div class="d-flex mb-3">
                            <div class="display-7">{{ count($allOrder) }}</div>
                            <div class="ms-auto" id="total-orders"></div>
                        </div>
                        {{-- <div class="text-success">
                            Over last month 1.4% <i class="small bi bi-arrow-up"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex mb-3">
                            <div class="display-7">
                                <img src="{{ BASE_URL . 'upload/sport-shoe.png' }}" alt="" width="40px">
                            </div>
                            {{-- <div class="dropdown ms-auto">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-sm" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item">View Detail</a>
                                    <a href="#" class="dropdown-item">Download</a>
                                </div>
                            </div> --}}
                        </div>
                        <h4 class="mb-3">Sản phẩm</h4>
                        <div class="d-flex mb-3">
                            <div class="display-7">{{ count($products) }}</div>
                            <div class="ms-auto" id="total-sales"></div>
                        </div>
                        {{-- <div class="text-danger">
                            Over last month 2.4% <i class="small bi bi-arrow-down"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h6 class="card-title">Đánh giá </h6>
                            <div class="dropdown ms-auto">
                                <a href="#">Tất cả</a>
                            </div>
                        </div>
                        <div class="summary-cards">
                            @foreach ($comments as $item)
                                <div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <h5 class="mb-1">
                                                @if ($item->fullname != '')
                                                    {{ $item->fullname }}
                                                @else
                                                    {{ $item->username }}
                                                @endif
                                            </h5>
                                            <ul class="list-inline ms-auto mb-0">
                                                <li class="list-inline-item mb-0">
                                                    @for ($i = 0; $i < $item->number_stars; $i++)
                                                        <i class="bi bi-star-fill text-warning"></i>
                                                    @endfor
                                                    @for ($i = 0; $i < 5 - $item->number_stars; $i++)
                                                        <i class="bi bi-star-fill text-muted"></i>
                                                    @endfor

                                                </li>
                                                {{-- <li class="list-inline-item mb-0">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                </li>
                                                <li class="list-inline-item mb-0">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                </li>
                                                <li class="list-inline-item mb-0">
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                </li>
                                                <li class="list-inline-item mb-0">

                                                </li> --}}
                                                <li class="list-inline-item mb-0">({{ $item->number_stars }})</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div>{{ $item->content }}</div>
                                </div>
                            @endforeach

                            {{-- <div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar me-3">
                                        <span class="avatar-text bg-indigo rounded-circle">J</span>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">Johnath Siddeley</h5>
                                        <ul class="list-inline ms-auto mb-0">
                                            <li class="list-inline-item mb-0">
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </li>
                                            <li class="list-inline-item mb-0">(5)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div>Very nice glasses. I ordered for my friend.</div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar me-3">
                                        <span class="avatar-text bg-yellow rounded-circle">D</span>
                                    </div>
                                    <div>
                                        <h5 class="mb-1">David Berks</h5>
                                        <ul class="list-inline ms-auto mb-0">
                                            <li class="list-inline-item mb-0">
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </li>
                                            <li class="list-inline-item mb-0">(5)</li>
                                        </ul>
                                    </div>
                                </div>
                                <div>I am very satisfied with this product.</div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mt-2" style="height:230px;">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex mb-4">
                            <h6 class="card-title mb-0">Trung bình đánh giá</h6>
                            {{-- <div class="dropdown ms-auto">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-sm" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item">View Detail</a>
                                    <a href="#" class="dropdown-item">Download</a>
                                </div>
                            </div> --}}
                        </div>

                        <div class="text-center">
                            <div class="display-6">
                                @php
                                    $sum = 0;
                                    foreach ($allCommets as $value) {
                                        $sum += $value->number_stars;
                                    }
                                    echo (int) ($sum / count($allCommets));
                                @endphp
                            </div>
                            <div class="d-flex justify-content-center gap-3 my-3">
                                <li class="list-inline-item mb-0">
                                    @for ($i = 0; $i < $item->number_stars; $i++)
                                        <i class="bi bi-star-fill icon-lg text-warning"></i>
                                    @endfor
                                    @for ($i = 0; $i < 5 - $item->number_stars; $i++)
                                        <i class="bi bi-star-fill icon-lg text-muted"></i>
                                    @endfor
                                </li>
                                <span>({{ count($allCommets) }})</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 mt-2">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="d-flex mb-7">
                            <div class="display-3">
                                <h4 class="mb-3">Tổng doanh Thu</h4>
                            </div>
                            {{-- <div class="ms-auto d-flex col-lg-7 col-md-12" >
                               
                                    <select name="month" id="" class="form-control ">
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value = "{{$i}}">{{$i}}<option>
                                        @endfor
                                    </select>
                                    <select name="year" id="" class="form-control ">

                                    </select>
                                
                            </div> --}}
                            {{-- <div class="dropdown ms-auto">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-sm" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="#" class="dropdown-item">View Detail</a>
                                    <a href="#" class="dropdown-item">Download</a>
                                </div>
                            </div> --}}
                        </div>
                        <div class="d-flex mb-3">
                            <div class="display-7">@php
                                $sum = 0;
                                foreach ($orders as $key) {
                                    $sum += $key->total;
                                }
                                echo number_format($sum, 0, ',', '.') . ' đ';
                            @endphp</div>
                            <div class="ms-auto" id="total-orders">
                            </div>
                        </div>
                        {{-- <div class="text-success">
                            Over last month 1.4% <i class="small bi bi-arrow-up"></i>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 mt-3">
                <div class="card widget">
                    <div class="card-header">
                        <h5 class="card-title">Tổng quát hoạt động</h5>
                    </div>
                    <div class="row g-6" >
                        <div class="col-md-2" style="width: 160px;">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <div class="display-5">
                                        <i class="bi bi-truck text-secondary"></i>
                                    </div>
                                    <h5 class="my-3" style="font-size: 15px">Đang vận chuyển</h5>
                                    <div class="text-muted ">
                                        <p class="text-danger">
                                            @if ($ordersShip < 1)
                                                0
                                            @else
                                                {{ $ordersShip }}
                                            @endif
                                        </p>
                                    </div>
                                    {{-- <div class="progress mt-3" style="height: 5px">
                                        <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="width: 160px;">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <div class="display-5">
                                        <img src="{{ BASE_URL . 'upload/icons8-order-cancel-53.png' }}" alt="">
                                    </div>
                                    <h5 class="my-3" style="font-size: 15px">Đơn hàng bị hủy</h5>
                                    <div class="text-muted">
                                        <p class="text-danger">
                                            @if ($ordersCancel < 1)
                                                0
                                            @else
                                                {{ $ordersCancel }}
                                            @endif
                                        </p>
                                    </div>
                                    {{-- <div class="progress mt-3" style="height: 5px">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 67%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="width: 160px;">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <div class="display-5">
                                        <i class="bi bi-bar-chart text-info"></i>
                                    </div>
                                    <h5 class="my-3" style="font-size: 15px">Đơn hàng mới </h5>
                                    <div class="text-muted">
                                        <p class="text-danger">
                                            @if ($ordersNewDay < 1)
                                                0
                                            @else
                                                {{ $ordersNewDay }}
                                            @endif
                                        </p>
                                    </div>
                                    {{-- <div class="progress mt-3" style="height: 5px">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="width: 160px;">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <div class="display-5">
                                        <i class="bi bi-cursor text-success"></i>
                                    </div>
                                    <h5 class="my-3" style="font-size: 15px">Giao thành công</h5>
                                    <div class="text-muted">
                                        <p class="text-danger">
                                            @if ($ordersDelivered < 1)
                                                0
                                            @else
                                                {{ $ordersDelivered }}
                                            @endif
                                        </p>
                                    </div>
                                    {{-- <div class="progress mt-3" style="height: 5px">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 55%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="width: 160px;">
                            <div class="card border-0">
                                <div class="card-body text-center">
                                    <div class="display-5">
                                        <img src="{{ BASE_URL . 'upload/icons8-data-pending-48.png' }}" alt="">
                                    </div>
                                    <h5 class="my-3" style="font-size: 15px">Đang chờ xử lý</h5>
                                    <div class="text-muted">
                                        <p class="text-danger">
                                            @if ($ordersPending < 1)
                                                0
                                            @else
                                                {{ $ordersPending }}
                                            @endif
                                        </p>
                                    </div>
                                    {{-- <div class="progress mt-3" style="height: 5px">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 55%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-7 col-md-12 mt-3">
                <div class="card widget">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Recent Products</h5>
                        <div class="dropdown ms-auto">
                            <a href="#" data-bs-toggle="dropdown" class="btn btn-sm btn-floating"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-three-dots"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Action</a>
                                <a href="#" class="dropdown-item">Another action</a>
                                <a href="#" class="dropdown-item">Something else here</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Products added today. Click <a href="#">here</a> for more
                            details</p>
                        <div class="table-responsive">
                            <table class="table table-custom mb-0" id="recent-products">
                                <thead>
                                    <tr>
                                        <th>
                                            <input class="form-check-input select-all" type="checkbox"
                                                data-select-all-target="#recent-products" id="defaultCheck1">
                                        </th>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox">
                                        </td>
                                        <td>
                                            <a href="#">
                                                <img src="../assets/images/products/10.jpg" class="rounded"
                                                    width="40" alt="...">
                                            </a>
                                        </td>
                                        <td>Cookie</td>
                                        <td>
                                            <span class="text-danger">Out of Stock</span>
                                        </td>
                                        <td>$10,50</td>
                                        <td class="text-end">
                                            <div class="d-flex">
                                                <div class="dropdown ms-auto">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">Action</a>
                                                        <a href="#" class="dropdown-item">Another
                                                            action</a>
                                                        <a href="#" class="dropdown-item">Something else
                                                            here</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox">
                                        </td>
                                        <td>
                                            <a href="#">
                                                <img src="../assets/images/products/7.jpg" class="rounded" width="40"
                                                    alt="...">
                                            </a>
                                        </td>
                                        <td>Glass</td>
                                        <td>
                                            <span class="text-success">In Stock</span>
                                        </td>
                                        <td>$70,20</td>
                                        <td class="text-end">
                                            <div class="d-flex">
                                                <div class="dropdown ms-auto">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">Action</a>
                                                        <a href="#" class="dropdown-item">Another
                                                            action</a>
                                                        <a href="#" class="dropdown-item">Something else
                                                            here</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox">
                                        </td>
                                        <td>
                                            <a href="#">
                                                <img src="../assets/images/products/8.jpg" class="rounded" width="40"
                                                    alt="...">
                                            </a>
                                        </td>
                                        <td>Headphone</td>
                                        <td>
                                            <span class="text-success">In Stock</span>
                                        </td>
                                        <td>$870,50</td>
                                        <td class="text-end">
                                            <div class="d-flex">
                                                <div class="dropdown ms-auto">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">Action</a>
                                                        <a href="#" class="dropdown-item">Another
                                                            action</a>
                                                        <a href="#" class="dropdown-item">Something else
                                                            here</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input class="form-check-input" type="checkbox">
                                        </td>
                                        <td>
                                            <a href="#">
                                                <img src="../assets/images/products/9.jpg" class="rounded" width="40"
                                                    alt="...">
                                            </a>
                                        </td>
                                        <td>Perfume</td>
                                        <td>
                                            <span class="text-success">In Stock</span>
                                        </td>
                                        <td>$170,50</td>
                                        <td class="text-end">
                                            <div class="d-flex">
                                                <div class="dropdown ms-auto">
                                                    <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a href="#" class="dropdown-item">Action</a>
                                                        <a href="#" class="dropdown-item">Another
                                                            action</a>
                                                        <a href="#" class="dropdown-item">Something else
                                                            here</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

    </div>
@endsection
