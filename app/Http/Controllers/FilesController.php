<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\File as Temp;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class FilesController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'file' => 'mimes:pdf,doc,docx,zip,jpeg,jpg,png|max:2048',
        ]);

        if ($validator->fails()) {
                return response()->json([
                        'success' => false,
                        'code' => 422,
                        'errors' => $validator->errors()], 422);
	}
        
        $path = $request->file('avatar')->store('avatars');
 
        return $path;
    }
//	return response()->json([
//		'success' => true,
//		'code' => 200,
//		'name' => $file->name,
//		'url' => url("wspace.local/files/{$file->file_id}"),
//		'file_id' => $file->file_id
//	]);
  //  }

}

