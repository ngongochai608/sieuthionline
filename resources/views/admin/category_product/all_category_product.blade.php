@extends('admin_layout')
@section('admin_content')
<div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-5">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Loại sản phẩm</h1>
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
                    <div class="col-sm-7">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Dashboard</a></li>
                                    <li><a href="#">Danh mục sản phẩm</a></li>
                                    <li class="active">Liệt kê danh mục</li>
                                </ol>
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
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
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
                                                <a href="{{URL::to('/delete-category-product-admin/'.$cate_product->category_id)}}" class="btn btn-danger" onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')">Xóa</a></td>
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