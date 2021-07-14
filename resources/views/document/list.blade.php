@extends('templates.master')

@section('title','Quản lý tài liệu')

@section('content')

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

<?php //Hiển thị danh sách tài liệu?>
<style>
#myImg { border-radius: 5px; cursor: pointer; transition: 0.3s; }
#myImg:hover {opacity: 0.7;}
/* The Modal (background) */
.modal { display: none; position: fixed; z-index: 9999; padding-top: 50px; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.9);}
/* Modal Content (image) */
.modal-content { margin: auto; display: block; width: 50%; max-width: 400px; }
/* Caption of Modal Image */
#caption { margin: auto; display: block; width: 80%; max-width: 700px; text-align: center; color: #ccc; padding: 10px 0; height: 50px; }
/* Add Animation */
.modal-content, #caption { -webkit-animation-name: zoom; -webkit-animation-duration: 0.6s; animation-name: zoom; animation-duration: 0.6s; }
@-webkit-keyframes zoom { from {-webkit-transform:scale(0)} to {-webkit-transform:scale(1)} }
@keyframes zoom { from {transform:scale(0)} to {transform:scale(1)} }
/* The Close Button */
.close { position: absolute; top: 15px; right: 35px; color: #f1f1f1; font-size: 40px; font-weight: bold; transition: 0.3s; }
.close:hover, .close:focus { color: #bbb; text-decoration: none; cursor: pointer; }
/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="table-responsive">
            <p><a class="btn btn-primary" href="{{ url('/tailieu/create') }}">Thêm mới</a></p>
            <table id="DataList" class="table table-bordered table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Diễn giải</th>
                        <th>Ngày nộp đơn</th>
                        <th>Số đơn</th>
                        <th>Ngày cấp văn bằng</th>
                        <th>Số văn bằng</th>
                        <th>Nhóm văn bằng</th>
                        <th>Chủ sở hữu</th>
                        <th>Nước bảo hộ</th>
                        <th>Loại tài liệu</th>
                        <th>Hết hạn</th>
                        <th>Cảnh báo</th>
                        <th>Tài liệu</th>
                        <th>Trạng thái</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                <?php //Khởi tạo vòng lập foreach lấy giá vào bảng?>
                @foreach($listtailieu as $key => $tailieu)
                    <tr>
                        <?php //Điền số thứ tự?>
                        <td>{{ $key+1 }}</td>
                        <?php //Lấy tên tài liệu?>
                        <td><a href="/tailieu/{{ $tailieu->id }}">{{ $tailieu->title }}</td>
                        <?php //Lấy số điện thoại?>
                        <td><a href="/tailieu/{{ $tailieu->id }}">{{ $tailieu->descriptions }}</td>
                        <td>{{ $tailieu->regis_date }}</td>
                        <td>{{ $tailieu->regis_form_no }}</td>
                        <td>{{ $tailieu->effective_date }}</td>
                        <td>{{ $tailieu->effective_no }}</td>
                        <td>{{ $tailieu->group }}</td>
                        <td>{{ $tailieu->owner }}</td>
                        <td>{{ $tailieu->country }}</td>
                        <td>{{ $tailieu->types }}</td>
                        <td>{{ $tailieu->expried_date }}</td>
                        <td>{{ $tailieu->notif_date }} ngày</td>
                        <td style="text-align: center; vertical-align: middle; width: 10%;">
							@if($tailieu->document != '')
								<a class="btn btn-primary" href="/upload/Document/{{ $tailieu->document }}">Download về máy</a>
							@else
								<img onclick="MymodalImage(this);" src="/upload/Document/nofile.png" alt="Chưa up tài liệu" style="cursor: zoom-in;" width="60"/>
							@endif
						</td>
                        <td>{{ $tailieu->status }}</td>
                        <?php //Tạo nút sửa tài liệu?>
                        <td><a href="/tailieu/{{ $tailieu->id }}/edit">Sửa</a></td>
                        <?php //Tạo nút xóa tài liệu?>
                        @if( Auth::user()->level == 1)
                        <td><a href="/tailieu/{{ $tailieu->id }}/delete">Xóa</a></td>
                        @elseif( Auth::user()->level == 2)
                        <td><a href="/tailieu/{{ $tailieu->id }}/delete">Xóa</a></td>
                        @elseif( Auth::user()->level == 3)
                        <td><a >Xóa</a></td>
                        @endif
                        
                    </tr>
                <?php //Kết thúc vòng lập foreach?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="myModal" class="modal">
	<span class="close">&times;</span>
	<img class="modal-content" id="img01">
	<div id="caption"></div>
</div>
<script>
function MymodalImage(e)
{
	// Get the modal
	var modal = document.getElementById('myModal');
	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");
	modal.style.display = "block";
	modalImg.src = e.src;
	captionText.innerHTML = e.alt;
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() { 
		modal.style.display = "none";
	}
}
</script>
@endsection