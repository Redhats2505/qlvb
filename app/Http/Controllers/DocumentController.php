<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documents;
use Illuminate\Support\Facades\DB;
use Session;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        	//Lấy danh sách tài liệu từ database
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
	
	//Gọi đến file list.blade.php trong thư mục "resources/views/tailieu" với giá trị gửi đi tên listtailieu = $getData
	return view('document.list')->with('listtailieu',$getData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$owners = DB::table('document_owner')->select('id','name')->get();
		$types = DB::table('document_types')->select('id','name')->get();
		$countrys = DB::table('document_country')->select('id','name')->get();
		$groups = DB::table('document_group')->select('id','name')->get();
		$statuss = DB::table('status')->select('id','name')->get();
        return view('document.create')->with('owners',$owners)
										->with('types',$types)
										->with('countrys',$countrys)
										->with('groups',$groups)
										->with('statuss',$statuss);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	//Them moi tai lieu

	//Kiểm tra giá trị tenhocsinh, sodienthoai, khoi
	$this->validate($request, 
		[
			//Kiểm tra giá trị rỗng
			'title' => 'required',
			'descriptions' => 'required',
		],			
		[
			//Tùy chỉnh hiển thị thông báo
			'title.required' => 'Xin vui lòng điền tiêu đề tài liệu!',
			'descriptions.required' => 'Xin vui lòng điền miêu tả tài liệu!!',
		]
	);
	
	//Lưu file lý lịch khi có file
	$gettailieu = '';
	if($request->hasFile('document')){
		$this->validate($request, 
			[
				//Kiểm tra đúng file đuôi .doc hay .docx và dung lượng không quá 5M
				'document' => 'mimes:pdf,doc,docx|max:30720',
			],			
			[
				//Tùy chỉnh hiển thị thông báo không thõa điều kiện
				'document.mimes' => 'Chỉ chấp nhận lý lịch với đuôi .pdf,.doc .docx',
				'document.max' => 'Lý lịch giới hạn dung lượng không quá 30M',
			]
		);
		
		//Lưu file vào thư mục public/upload/document
		$document = $request->file('document');
		$gettailieu = time().'_'.$document->getClientOriginalName();
		$destinationPath = public_path('/upload/Document');
		$document->move($destinationPath, $gettailieu); 
	}

    	//Set timezone
    	date_default_timezone_set("Asia/Ho_Chi_Minh");
    	
    	//Lấy giá trị tài liệu  đã nhập
    	$allRequest  = $request->all();
    	$title  = $allRequest['title'];
    	$descriptions = $allRequest['descriptions'];
		$regis_date = $allRequest['regis_date'];
		$regis_form_no = $allRequest['regis_form_no'];
		$effective_date = $allRequest['effective_date'];
		$effective_no = $allRequest['effective_no'];
    	$owner = $allRequest['owner'];
		$group = $allRequest['group'];
		$country = $allRequest['country'];
		$types = $allRequest['types'];
		$status = $allRequest['status'];
		$expried_date = $allRequest['expried_date'];
        $notif_date = $allRequest['notif_date'];
		$notif_email = $allRequest['notif_email'];
		$note = $allRequest['note'];
		
		
    	//Gán giá trị vào array
    	$dataInsertToDatabase = array(
    		'title'  => $title,
    		'descriptions' => $descriptions,
            'document' => $gettailieu,
			'regis_date' => $regis_date,
			'regis_form_no' => $regis_form_no,
			'effective_date' => $effective_date,
			'effective_no' => $effective_no,
            'expried_date' => $expried_date,
            'notif_date' => $notif_date,
			'notif_email' => $notif_email,
			'document_group'=>$group,
			'document_owner'=>$owner,
			'document_country'=>$country,
			'document_types'=>$types,
			'status'=> $status,
			'note'=> $note,
    		'created_at' => date('Y-m-d H:i:s'),
    		'updated_at' => date('Y-m-d H:i:s'),
    	);
    	
    	//Insert vào bảng tbl_hocsinh
    	$insertData = DB::table('documents')->insert($dataInsertToDatabase);
    	
    	//Kiểm tra Insert để trả về một thông báo
    	if ($insertData) {
    		Session::flash('success', 'Thêm mới tài liệu thành công!');
    	}else {                        
    		Session::flash('error', 'Thêm thất bại!');
    	}
    	
    	//Thực hiện chuyển trang
    	return redirect('tailieu');
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
		->where('docs.id',$id)->get();
    
    return view('document.show')->with('gettailieuById2',$getData);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        	//Lấy dữ liệu từ Database với các trường được lấy và với điều kiện id = $id
	$getData = DB::table('documents')
	
		->select('id','title','descriptions','regis_date','regis_form_no','effective_date',
		'effective_no','document','expried_date','notif_date','notif_email','status',
		'document_country as country','document_owner as owner','document_types as types','document_group as group','note')
		->where('id',$id)->get();
		$owners = DB::table('document_owner')->select('id','name')->get();
		$types = DB::table('document_types')->select('id','name')->get();
		$countrys = DB::table('document_country')->select('id','name')->get();
		$groups = DB::table('document_group')->select('id','name')->get();
		$statuss = DB::table('status')->select('id','name')->get();
	//Gọi đến file edit.blade.php trong thư mục "resources/views/tailieu" với giá trị gửi đi tên gettailieuById = $getData
	return view('document.edit')->with('gettailieuById',$getData)
								->with('owners',$owners)
								->with('types',$types)
								->with('countrys',$countrys)
								->with('statuss',$statuss)
								->with('groups',$groups);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        	//Cap nhat sua tài liệu
	//Set timezone
	date_default_timezone_set("Asia/Ho_Chi_Minh");	
 
	//Thực hiện câu lệnh update với các giá trị $request trả về
	$updateData = DB::table('documents')->where('id', $request->id)->update([
		'title' => $request->title,
		'descriptions' => $request->descriptions,
        'document' => $request->document,
		'updated_at' => date('Y-m-d H:i:s'),
		'regis_date' => $request->regis_date,
		'regis_form_no' => $request->regis_form_no,
		'effective_date' => $request->effective_date,
		'effective_no' => $request->effective_no,
		'expried_date' => $request->expried_date,
		'notif_date' => $request->notif_date,
		'notif_email' => $request->notif_email,
		'document_group'=>$request->group,
		'document_owner'=>$request->owner,
		'document_country'=>$request->country,
		'document_types'=>$request->types,
		'status'=> $request->status,
		'note'=> $request->note
	]);
	
	//Kiểm tra lệnh update để trả về một thông báo
	if ($updateData) {
		Session::flash('success', 'Sửa tài liệu thành công!');
	}else {                        
		Session::flash('error', 'Sửa thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('tailieu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	//Xoa hoc sinh
	//Thực hiện câu lệnh xóa với giá trị id = $id trả về
	$deleteData = DB::table('documents')->where('id', '=', $id)->delete();
	
	//Kiểm tra lệnh delete để trả về một thông báo
	if ($deleteData) {
		Session::flash('success', 'Xóa tài liệu thành công!');
	}else {                        
		Session::flash('error', 'Xóa thất bại!');
	}
	
	//Thực hiện chuyển trang
	return redirect('tailieu');
    }
}
