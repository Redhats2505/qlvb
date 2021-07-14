@extends('templates.master')

@section('title','Quản lý tài liệu')

@section('content')

<!--<div class="page-header"><h4>Quản lý tài liệu</h4></div>-->

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
<?php //Hiển thị form sửa tài liệu?>
<p><a class="btn btn-primary" href="{{ url('/tailieu') }}">Về danh sách</a></p>
<div class="col-xs-4 col-xs-offset-4">
    <center><h4>Xem Tài liệu </h4></center>
    <form >
        <input type="hidden" id="_token" name="_token" value="{!! csrf_token() !!}" />
        <input type="hidden" id="id" name="id" value="{!! $gettailieuById2[0]->id !!}" />
        <div class="form-group">
            <label for="title">Tên tài liệu</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Tên tài liệu" maxlength="255" value="{{ $gettailieuById2[0]->title }}" readonly />
        </div>
        <div class="form-group">
            <label for="description">Diễn giải</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Diễn giải" value="{{ $gettailieuById2[0]->descriptions }}" readonly />
        </div>
        
        <table class="table-form">
            <tr >
                <td class="cell-form">
                    <div class="form-group">
                    <label for="regis_form_no">Số đơn</label>
                    <input type="text" class="form-control" id="regis_form_no"  name="regis_form_no" value="{{ $gettailieuById2[0]->regis_form_no }}" readonly/>
                    </div>    
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="regis_date">Ngày nộp hồ sơ</label>
                    <input type="date" class="form-control" id="regis_date"  name="regis_date" value="{{ $gettailieuById2[0]->regis_date }}" readonly/>
                    </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="status">Trạng thái</label>
                    <input type="text" class="form-control" id="status"  name="status" value="{{ $gettailieuById2[0]->status }}" readonly/>
                    </div>
                </td>
            </tr>
            <tr> 
                <td class="cell-form">
                    <div class="form-group">
                    <label for="effective_no">Số văn bằng</label>
                    <input type="text" class="form-control" id="effective_no"  name="effective_no" value="{{ $gettailieuById2[0]->effective_no }}" readonly/>
                    </div>    
                </td>
                <td class="cell-form">
                    <div class="form-group">  
                    <label for="effective_date">Ngày cấp văn bằng</label>
                    <input type="date" class="form-control" id="effective_date"  name="effective_date" value="{{ $gettailieuById2[0]->effective_date }}" readonly/>
                    </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="country">Nước bảo hộ</label>
                    <input type="text" class="form-control" id="owner"  name="owner" value="{{ $gettailieuById2[0]->owner }}" readonly/>
                    </div>
                </td>
            </tr>
            <tr> 
                <td class="cell-form">
                    <div class="form-group">
                    <label for="group">Nhóm văn bằng</label>
                    <input type="text" class="form-control" id="group"  name="group" value="{{ $gettailieuById2[0]->group }}" readonly/>
                    </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="owner">Chủ sở hữu</label>
                    <input type="text" class="form-control" id="country"  name="country" value="{{ $gettailieuById2[0]->country }}" readonly/>
                    </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="types">Loại tài liệu</label>
                    <input type="text" class="form-control" id="types"  name="types" value="{{ $gettailieuById2[0]->types }}" readonly/>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="expried_date">Ngày tài liệu hết hạn</label>
                    <input type="date" class="form-control" id="date_expried"  name="expried_date" value="{{ $gettailieuById2[0]->expried_date }}" readonly/>
                    </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="notif_date">Số ngày cảnh báo trước</label>
                    <input type="number" class="form-control" id="notif_date"  name="notif_date" value="{{ $gettailieuById2[0]->notif_date }}" readonly/>
                    </div>
                </td>
            </tr>
        </table>
        <div class="form-group">
            <label for="notif_email">Email nhận thông báo</label>
            <input type="email" class="form-control" id="notif_email"  name="notif_email" value="{{ $gettailieuById2[0]->notif_email }}" readonly/>
        </div>
        <div class="form-group">
            <label for="document">Upload file</label>
            <input type="file" class="form-control" id="document"  name="document" value="{{ $gettailieuById2[0]->document }}" readonly/>
        </div>
        <div class="form-group">
            <label for="note">Lưu ý</label>
            <input type="text" class="form-control" id="note"  name="note" value="{{ $gettailieuById2[0]->note }}" readonly/>
        </div>
       
    </form>
   
</div>

@endsection