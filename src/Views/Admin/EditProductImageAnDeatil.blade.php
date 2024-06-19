@extends('layouts.master')

@section('content')
    @if (isset($productImage))
        <form action="" method="post" enctype="multipart/form-data">
            <?php 
            $i=0;
            foreach ($productImage as $item):
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-1 mt-5">
                        <input type="checkbox" name="image_id.{{ $i }}" id="image_id" value="{{ $item->image_id }}">
                    </div>
                    <div class="col-11">
                        <img src="{{ BASE_URL . 'upload/' . $item->image_name }}" alt="" width="200px">
                        <input type="file" name='image.{{ $i }}' class="form-control"
                            value="{{ $item->image_name }}"><br>
                        <input type="hidden" name='id.{{ $i }}' class="form-control"
                            value="{{ $item->image_id }}"><br>
                    </div>
                </div>
            </div>
            <?php
            $i++; 
            endforeach;
        ?>
            <input type="hidden" name="QuantityPost" value="{{ $i }}">
            <button class="btn btn-success" type="submit" name="edit">Lưu Thay Đổi</button>
            <button class="btn btn-danger" type="submit" name="delete"
                onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa Ảnh</button>
            <a href="{{ BASE_URL . $_GET['url'] . '?idImage=' . $_GET['idImage'] . '&addNewImage=' . $_GET['idImage'] }}"><button
                    type="button" class="btn btn-primary" id="add-variant">Thêm Ảnh</button></a>
            <a href="{{ BASE_URL . $_GET['url'] }}"><button type="button" class="btn btn-dark">Chi Tiết Sản
                    Phẩm</button></a> <br><br><br>
        </form>
    @endif
    @if (isset($_GET['addNewImage']) && !empty($_GET['addNewImage']))
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="exampleFormControlInput1" class="form-label">Ảnh Sản Phẩm</label>
            <input class="form-control" type="file" id="formFileMultiple" name="product_images[]" multiple
                accept="image/*">
            <button type="submit" class="btn btn-success mt-3">Thêm Ảnh</button>
            <a href="{{ BASE_URL . $_GET['url'] . '?idImage=' . $_GET['idImage'] }}"><button type="button"
                    class="btn btn-primary mt-3">Danh Sách Ảnh</button></a>
        </form>
    @endif
    @if (isset($productDetail))
        <form action="" method="post">
            <?php
        $i=0;
        foreach($productDetail as $item):
        ?>
            <div id="variants-container1">
                <div class="row">
                    <div class="col-1 mt-5">
                        <input type="checkbox" name="product_detail_id.{{ $i }}" id="product_detail_id"
                            value="{{ $item->product_detail_id }}">
                    </div>
                    <div class="col-11">
                        <div class="variant1">
                            <label for="size">
                                <h5>Kích Thước</h5>
                            </label>
                            <input class="form-control mb-3" type="text" aria-label="default input example"
                                name="size.{{ $i }}" value = "{{ $item->product_size }}">
                            <input type="hidden" name="idDetail.{{ $i }}"
                                value="{{ $item->product_detail_id }}">
                            <label for="variantQuantity">
                                <h5>Số Lượng</h5>
                            </label>
                            <input class="form-control" type="text" aria-label="default input example"
                                name="variantQuantity.{{ $i }}" value = "{{ $item->product_quantity }}"> <br>
                            <input type="hidden" name="idDetail.{{ $i }}"
                                value="{{ $item->product_detail_id }}">
                        </div>
                    </div>
                </div>
            </div>

            <?php $i++;endforeach?>
            <input type="hidden" name="QuantityPost" value="{{ $i }}">
            <button class="btn btn-success" type="submit" name="edit">Lưu Thay Đổi</button>
            <button class="btn btn-danger" type="submit" name="delete"
                onclick="return confirm('Bạn có chắc muốn xóa không?')">Xóa Biến Thể</button>
            <a href="{{ BASE_URL . $_GET['url'] . '?detail=' . $_GET['detail'] . '&addNewDetail=' . $_GET['detail'] }}"><button
                    type="button" class="btn btn-primary" id="add-variant">Thêm biến thể</button></a>
            <a href="{{ BASE_URL . $_GET['url'] }}"><button type="button" class="btn btn-dark">Chi Tiết Sản
                    Phẩm</button></a>
        </form>
    @endif
    @if (isset($_GET['addNewDetail']) && !empty($_GET['addNewDetail']))
        <div class="mb-3">
            <form action="" method="POST">
                <div id="variants-container">
                    <div class="variant">
                        <label for="size">
                            <h5>Kích Thước</h5>
                        </label>
                        <input class="form-control mb-3" type="text" aria-label="default input example"
                            placeholder="size" name="size[]" required>
                        <!-- <input type="text" name="size[]" required><br><br> -->

                        <label for="variantQuantity">
                            <h5>Số Lượng</h5>
                        </label>
                        <input class="form-control" type="text" aria-label="default input example"
                            placeholder="quantity" name="variantQuantity[]" required> <br>
                        <!-- <input type="number" name="variantQuantity[]" required><br><br> -->
                    </div>
                </div>
                <button class="btn btn-success" type="submit">Lưu Biến Thể Mới</button>
                <button type="button" class="btn btn-primary" id="add-variant">Thêm biến thể</button>
                <a href="{{ BASE_URL . $_GET['url'] . '?detail=' . $_GET['detail'] }}"><button type="button"
                        class="btn btn-primary ">Danh Sách Biến Thể</button></a>
            </form>
        </div>
        <script>
            document.getElementById("add-variant").addEventListener("click", function() {
                var variantsContainer = document.getElementById("variants-container");
                var newVariant = document.querySelector(".variant").cloneNode(true);
                variantsContainer.appendChild(newVariant);
            })
        </script>
    @endif
@endsection
