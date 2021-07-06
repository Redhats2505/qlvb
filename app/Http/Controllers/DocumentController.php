<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
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
	->select('docs.id','docs.title as title','docs.description','docs.document','docs.date_expried','docs.notif_date','docs.email_notif','status.title as status')->get();
	
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
        return view('document.create');
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
			'description' => 'required',
		],			
		[
			//Tùy chỉnh hiển thị thông báo
			'title.required' => 'Xin vui lòng điền tiêu đề tài liệu!',
			'description.required' => 'Xin vui lòng điền miêu tả tài liệu!!',
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
    	$description = $allRequest['description'];
    	$date_expried = $allRequest['date_expried'];
        $notif_date = $allRequest['notif_date'];
		$email_notif = $allRequest['email_notif'];
    	//Gán giá trị vào array
    	$dataInsertToDatabase = array(
    		'title'  => $title,
    		'description' => $description,
            'document' => $gettailieu,
            'date_expried' => $date_expried,
            'notif_date' => $notif_date,
			'email_notif' => $email_notif,
			'status'=> '1',
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
    $getData = DB::table('documents')->select('id','title','description','document','date_expried','notif_date','email_notif')->where('id',$id)->get();
    
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
	$getData = DB::table('documents')->select('id','title','description','document','date_expried','notif_date','email_notif')->where('id',$id)->get();
	
	//Gọi đến file edit.blade.php trong thư mục "resources/views/tailieu" với giá trị gửi đi tên gettailieuById = $getData
	return view('document.edit')->with('gettailieuById',$getData);
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
		'description' => $request->description,
        'document' => $request->document,
        'date_expried' => $request->date_expried,
		'email_notif' => $request->email_notif,
        'notif_date' => $request->notif_date,
		'updated_at' => date('Y-m-d H:i:s')
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
