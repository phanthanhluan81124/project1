@extends('layouts.master')

@section('content')
    <div class="container">
        <h1 class="">Sửa Sản Phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Ảnh Đại Diện Sản Phẩm</label> <br>
                        <img src="{{ BASE_URL . 'upload/' . $infoProduct[0]->product_image }}" alt=""
                            width="420px">
                        <input type="file" class="form-control" id="exampleFormControlInput1" name="product_image" style="margin-top: 10px;">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="product_name"
                            value="{{ $infoProduct[0]->product_name }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Giá Sản PhẩmGiá Gốc</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="product_price"
                            value="{{ $infoProduct[0]->product_price }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Giá Sản PhẩmGiá Khuyến Mãi</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" name="discounted_price"
                            value="{{ $infoProduct[0]->discounted_price }}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Danh Mục Sản Phẩm</label>
                        <select name="category_id" id="" class="form-control">
                            @foreach ($category as $item)
                                @if ($infoProduct[0]->category_id == $item->id)
                                    <option value="{{ $item->id }}" selected>{{ $item->category_name }}</option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Mô Tả Sản Phẩm</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="product_describe">{{ $infoProduct[0]->product_describe }}</textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Ảnh Sản Phẩm</label> <br>
                        @foreach ($productImage as $item)
                            <img src="{{ BASE_URL . 'upload/' . $item->image_name }}" alt="" width="200px">
                        @endforeach <br>
                        <a href="{{ BASE_URL . $_GET['url'] . '?idImage=' . $infoProduct[0]->id }}"><button
                                class="btn btn-primary" type="button">Sửa</button></a>
                        {{-- <input type="file" class="form-control" id="image" name="image" multiple>
                        <input type="text" class="form-control" id="images" name="product_images"  hidden> --}}
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        @foreach ($productDetail as $item)
                            <div id="variants-container">
                                <div class="variant">
                                    <label for="size">
                                        <h5>Kích Thước</h5>
                                    </label>
                                    <input class="form-control mb-3" type="text" aria-label="default input example"
                                        value = "{{ $item->product_size }}" disabled>
                                    <!-- <input type="text" name="size[]" required><br><br> -->

                                    <label for="variantQuantity">
                                        <h5>Số Lượng</h5>
                                    </label>
                                    <input class="form-control" type="text" aria-label="default input example"
                                        value = "{{ $item->product_quantity }}" disabled> <br>
                                    <!-- <input type="number" name="variantQuantity[]" required><br><br> -->
                                </div>
                            </div>
                        @endforeach

                        <a href="{{ BASE_URL . $_GET['url'] . '?detail=' . $infoProduct[0]->id }}"><button type="button"
                                class="btn btn-primary" id="add-variant">Sửa biến thể</button></a>
                        <br><br><br>
                    </div>
                </div>

            </div>
    <div class="row">
        <div class="col-md3">
            <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
            <a href="{{ BASE_URL . 'admin/products' }}"><button type="button" class="btn btn-primary">Danh
                    Sách</button></a>
        </div>
    </div>
    </form>
    </div>
@endsection
