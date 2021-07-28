@extends('templates.master')

@section('title','Thêm mới tài liệu')

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
            <label for="descriptions">Diễn giải</label>
            <input type="text" class="form-control" id="descriptions"  name="descriptions" placeholder="Diễn giải" required />
        </div>
        <table class="table-form">
            <tr >
                <td class="cell-form">
                    <div class="form-group">
                    <label for="regis_form_no">Số đơn</label>
                    <input type="text" class="form-control" id="regis_form_no"  name="regis_form_no"/>
                    </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="regis_date">Ngày nộp hồ sơ</label>
                    <input type="date" class="form-control" id="regis_date"  name="regis_date"/>
                    </div>
                </td>
                <td class="cell-form">
                <div class="form-group">
                    <label for="status">Trạng thái</label>
                        <select class="form-control" id="status" name="status" >
                        <option value="">-- Trạng thái --</option>
                            @foreach($statuss as $status)
                                <option value="{!! $status->id !!}"{!! ($status->id == 1) ? 'selected="selected"' : null !!}>{!! $status->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
            </tr>    
            <tr>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="effective_no">Số văn bằng</label>
                    <input type="text" class="form-control" id="effective_no"  name="effective_no"/>
                    </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="effective_date">Ngày cấp văn bằng</label>
                    <input type="date" class="form-control" id="effective_date"  name="effective_date"/>
                    </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="country">Nước bảo hộ</label>
                        <select class="form-control" id="country" name="country" required>
                        <option value="">-- Chọn nước bảo hộ --</option>
                            @foreach($countrys as $country)
                                <option value="{!! $country->id !!}" {!! ($country->id == 242) ? 'selected="selected"' : null !!}>{!! $country->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cell-form"> 
                <div class="form-group">
                <label for="group">Lưu ý</label>
                <input type="text" class="form-control" id="group"  name="group" height="10"/>
                </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="owner">Chủ sở hữu</label>
                        <select class="form-control" id="owner" name="owner" required>
                        <option value="">-- Chọn chủ sở hữu --</option>
                            @foreach($owners as $owner)
                                <option value="{!! $owner->id !!}" {!! ($owner->id == 3) ? 'selected="selected"' : null !!}>{!! $owner->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="types">Loại tài liệu</label>
                        <select class="form-control" id="types" name="types" required>
                        <option value="1">-- Chọn loại tài liệu --</option>
                            @foreach($types as $type)
                                <option value="{!! $type->id !!}"{!! ($type->id == 1) ? 'selected="selected"' : null !!}>{!! $type->name !!}</option>
                            @endforeach
                        </select>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="expried_date">Ngày tài liệu hết hạn</label>
                    <input type="date" class="form-control" id="expried_date"  name="expried_date"/>
                    </div>
                </td>
                <td class="cell-form">
                    <div class="form-group">
                    <label for="notif_date">Số ngày cảnh báo trước</label>
                    <input type="number" class="form-control" id="notif_date"  name="notif_date"/>
                    </div>
                </td>
            </tr>
        </table>
        <div class="form-group">
            <label for="notif_email">Email nhận thông báo</label>
            <input type="email" class="form-control" id="notif_email"  name="notif_email" placeholder="Email" required multiple/>
        </div>
        <div class="form-group">
        <label for="document">Upload file</label>
        <input type="file" class="form-control" id="document"  name="document" multiple/>
        </div>
        <div class="form-group">
        <label for="note">Lưu ý</label>
        <input type="text" class="form-control" id="note"  name="note" height="10"/>
        </div>		
        <center><button type="submit" class="btn btn-primary">Thêm</button></center>
    </form>
</div>
@endsection