<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use ZipArchive;
use Illuminate\Support\Facades\DB;
class DownloadController extends Controller
{
    public function download($id)
    {
        
        	// Define Dir Folder
        	$public_dir=public_path('/upload/Document');
            $getData = DB::table('documents')->select('document as document')->where('id',$id)-> get();
            //dd($getData);
            $files = ($getData[0]->document);
            $files = explode(', ',$files);
            
        	// Zip File Name
            $zipFileName = 'AllDocuments.zip';
            unlink($public_dir. '/' . $zipFileName);
            // Create ZipArchive Obj
            $zip = new ZipArchive;
            if ($zip->open($public_dir. '/' . $zipFileName , ZipArchive::CREATE) === TRUE) {    
                // Add Multiple file
                foreach($files as $file) {
                $zip->addFile($public_dir. '/' .$file,$file);                  
                }      
                $zip->close();
            }
            // Set Header
            $headers = array(
            'Content-Type' => 'application/octet-stream',
            );
            $filetopath=$public_dir.'/'.$zipFileName;
            // Create Download Response
            if(file_exists($filetopath)){
                return response()->download($filetopath,$zipFileName,$headers);            
            }
    }
}
