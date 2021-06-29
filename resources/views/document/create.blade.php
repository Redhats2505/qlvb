@extends('templates.master')

@section('title','Thêm mới tài liệu')

@section('content')

<div class="page-header"><h4>Quản lý tài liệu</h4></div>

<?php //Hiển thị thông báo thành công?>
@if ( Session::has('success') )
    <div class="alert alert-success alert-dismissible" role="alert">
        <strong>{{ Session::get('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
@endif
@if ($errors->any())
    	<div class="alert alert-danger alert-dismissible" role="alert">
    		<ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    			<span aria-hidden="true">&times;</span>
    			<span class="sr-only">Close</span>
    		</button>
    	</div>
    @endif
<?php //Hiển thị thông báo lỗi?>
@if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <strong>{{ Session::get('error') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
    </div>
@endif

<?php //Form thêm mới tài liệu?>
<p><a class="btn btn-primary" href="{{ url('/tailieu') }}">Về danh sách</a></p>
<div class="col-xs-4 col-xs-offset-4">
    <center><h4>Thêm tài liệu</h4></center>
    <form action="{{ url('/tailieu/create') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}"/>
        <div class="form-group">
            <label for="title">Tên tài liệu</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Tên tài liệu" maxlength="255" required />
        </div>
        <div class="form-group">
            <label for="description">Diễn giải</label>
            <input type="text" class="form-control" id="description"  name="description" placeholder="Diễn giải" required />
        </div>
        <div class="form-group">
        <label for="document">Upload file</label>
        <input type="file" class="form-control" id="document"  name="document"/>
        </div>
        <div class="form-group">
    	<label for="date_expried">Ngày tài liệu hết hạn</label>
    	<input type="date" class="form-control" id="date_expried"  name="date_expried"/>
        </div>
        <div class="form-group">
        <label for="notif_date">Số ngày cảnh báo trước</label>
        <input type="number" class="form-control" id="notif_date"  name="notif_date"/>
        </div>		
        <center><button type="submit" class="btn btn-primary">Thêm</button></center>
    </form>
</div>

@endsection