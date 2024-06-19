@extends('layouts.master')

@section('content')
    <div class="content ">
        <div class="card mb-4" style="width: 100%;" id="searchCategory">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center" data-bs-toggle="collapse" aria-expanded="true"
                    data-bs-target="#keywordsCollapseExample" role="button">
                    <div>Tìm kiếm Mã Đơn hàng</div>
                    <div class="bi bi-chevron-down"></div>
                </div>
                <div class="collapse show mt-4" id="keywordsCollapseExample">
                    <div class="input-group">
                        <form action="" method="get">
                            <input type="text" class="form-control" name="keyword" placeholder="tìm kiếm ......">
                            <button class="btn" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <style>
            form {
                display: flex;
            }

            form .form-control {
                width: 800px;
            }

            .btn {
                margin-left: -58px;
            }

            .card,
            .table-responsive {
                width: 850px;
            }

            .mt-4 {
                align-items: center;
            }
        </style>
            @if (isset($bills))
                <div class="table-responsive" style="width: 100%;">
                    <table class="table table-custom table-lg mb-0">
                        <thead>
                            <tr>

                                <th>STT</th>
                                <th>Mã Đơn hàng</th>
                                <th>Giá tiền</th>
                                <th>partnercode</th>
                                <th class="text-end"></th>
                                <!-- <th ">Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($bills as $item) :
                           
                            ?>
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $item->orderId }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->partnerCode }}</td>
                                <td class="d-flex">
                                    <a href="{{ BASE_URL . 'admin/bill-payment-detail-'. $item->id }}" style="color:#004dda; ">Xem Thêm</a>
                                </td>
                            </tr>
                            <?php
                             $i++;
                             endforeach?>

                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @if (isset($number) && !empty($number))
        <div class="container text-center" id ="pagination">
            @for ($i = 1; $i <= $number; $i++)
                @if (isset($_GET['keyword']) && !empty($_GET['keyword']))
                    <a href = "{{ BASE_URL . $_GET['url'] . '?keyword=' . $_GET['keyword'] . '&page=' . $i }}">
                        <button class="btn btn-primary" id ='page' style="margin: 0px">
                            <p id="number" style="height: 5px; text-align:center ;margin-left: 3px">{{ $i }}
                            </p>
                        </button>
                    </a>
                @else
                    <a href = "{{ BASE_URL . $_GET['url'] . '?page=' . $i }}">
                        <button class="btn btn-primary" id ='page' style="margin: 0px">
                            <p id="number" style="height: 5px; text-align:center ;margin-left: 3px">
                                {{ $i }}
                            </p>
                        </button>
                    </a>
                @endif
            @endfor
        </div>
    @endif
    </div>
    <style>
        .page {
            width: 30px;
            height: 30px;
            margin: 5px;
            color: #ff6e40;
            border: solid 1px #ff6e40;
            background-color: #fff;
            border-radius: 10px;
        }

        .page:hover {
            background-color: #ff6e40;
            color: #fff;
        }

        button {
            background-color: #ff6e40;
            color: #fff;
            border: solid 1px #ff6e40;
            border-radius: 5px;
        }
    </style>
@endsection
