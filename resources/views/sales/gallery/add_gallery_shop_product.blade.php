@extends('sales_layout')
@section('sales_content')
<div class="col-lg-12">
    <div class="card">
    <div class="card-header">
            <strong>Thêm thư viện ảnh cho sản phẩm</strong>
        </div>
    <div class="col-md-12">
        <?php
        $message = Session::get('message');
        if ($message) {
            echo "<span class='alert alert-success'>".$message."</span>";
            Session::put('message',null);
        }
        ?>
        <form action="{{URL::to('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-2" align="right">
                    
                </div>
                <div class="col-md-6">
                    <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
                    <span id="error_gallery"></span>
                </div>
                <div class="col-md-3">
                    <input type="submit" name="taianh" value="Tải ảnh" class="btn btn-success">
                </div>
            </div>
        </form>
        <div class="card-body card-block">
            <input type="hidden" name="pro_id" class="pro_id" value="{{$pro_id}}">
            <form>
                @csrf
                <div id="gallery_load">
                    
                            
                        
                </div>
            </form>
        </div>
    </div>
    </div>
</div>




<!-- <div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <strong>Thêm thư viện ảnh cho sản phẩm</strong>
        </div>
        <?php
        $message = Session::get('message');
        if ($message) {
            echo "<span class='alert alert-success'>".$message."</span>";
            Session::put('message',null);
        }
        ?>
        <form action="{{URL::to('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="row">
                <div class="col-md-2" align="right">
                    
                </div>
                <div class="col-md-6">
                    <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
                    <span id="error_gallery"></span>
                </div>
                <div class="col-md-3">
                    <input type="submit" name="taianh" value="Tải ảnh" class="btn btn-success">
                </div>
            </div>
        </form>
        <div class="card-body card-block">
            <input type="hidden" name="pro_id" class="pro_id" value="{{$pro_id}}">
            <form>
                @csrf
                <div id="gallery_load">
                    
                            
                        
                </div>
            </form>
        </div>
</div> -->
@endsection