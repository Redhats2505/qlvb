<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class ExportController extends Controller implements FromCollection, WithHeadings
{
    
    public function collection()
    {
        $getData = DB::table('documents as docs')
	->leftJoin('status as status', 'docs.status', '=', 'status.id')
	->leftJoin('document_country as country', 'docs.document_country', '=', 'country.id')
	->leftJoin('document_group as group', 'docs.document_group', '=', 'group.id')
	->leftJoin('document_owner as owner', 'docs.document_owner', '=', 'owner.id')
	->leftJoin('document_types as types', 'docs.document_types', '=', 'types.id')
	->select('docs.id','docs.title as title','docs.descriptions','regis_date','regis_form_no','effective_date',
	'effective_no','document','expried_date','notif_date','docs.notif_email','status.name as status',
	'country.name as country','owner.name as owner','types.name as types','group.name as group','note')
	->get();
        return (collect($getData));
    }
    //Thêm hàng tiêu đề cho bảng
    public function headings() :array {
    	return ["STT", "Tên hồ sơ", "Diễn giải", "Ngày nộp hồ sơ", "Số đơn", "Ngày cấp văn bằng", "Số văn bằng","File tài liệu","Ngày hết hạn","Ngày cảnh báo","Email cảnh báo",
        "Trạng thái","Nước bảo hộ","Chủ sở hữu","Loại tài liệu","Nhóm văn bản","Ghi chú",];
    }
    public function export(){
        return Excel::download(new ExportController(), 'documents.xlsx');
   }
   
}
