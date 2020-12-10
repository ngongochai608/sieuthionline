@extends('admin_layout')
@section('admin_content')
<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-12">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Danh mục sản phẩm</h1>
                                <?php
                                $message = Session::get('message');
                                if ($message) {
                                    echo "<span class='alert alert-success'>".$message."</span>";
                                    Session::put('message',null);
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Liệt kê danh mục sản phẩm</strong>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên danh mục</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($category_product as $key => $cate_product)
                                        <tr>
                                            <td><img src="{{asset('public/uploads/category_product/'.$cate_product->category_image)}}" width="70" height="70" class="img-thumbnail"></td>
                                            <td>{{ $cate_product->category_name }}</td>
                                            <td>
                                                <a href="{{URL::to('/edit-category-product-admin&'.$cate_product->category_id)}}" class="btn btn-success">Sửa</a> | 
                                                <a href="{{URL::to('/delete-category-product-admin/'.$cate_product->category_id)}}" class="btn btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không?')">Xóa</a></td>
                                        </tr>
                                        @endforeach    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


        <div class="clearfix"></div>
@endsection