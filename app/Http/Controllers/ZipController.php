<?php

namespace App\Http\Controllers;
use DB;
use File;
use ZipArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ZipController extends Controller
{
    public function index() 
    {
        $user_id = Auth::id();
        $url= DB::table('users')->where('id', $user_id)->value('guest_url');
    	$zip = new ZipArchive;
        $date = now()->format("YmdHis");
        $fileName = $date.$user_id.'.zip';
   
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
        	// Folder files to zip and download
        	// files folder must be existing to your public folder
            $files = File::files(public_path('uploads/'.$url));
   			
   			// loop the files result
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
             
            $zip->close();
        }
    	
    	// Download the generated zip
        return response()->download(public_path($fileName));
    }
}
