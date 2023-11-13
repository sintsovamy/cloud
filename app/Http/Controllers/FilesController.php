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


	$file = $request->file('file');
	$fileName = Temp::createName($file->getClientOriginalName());
	Storage::putFileAs('uploads', $file, $fileName);

	$file = Temp::create([
		'name' => $fileName,
		'file_id' => Temp::createFileId()
	]);

      return response()->json([
              'success' => true,
              'code' => 200,
              'name' => $fileName,
              'url' => url("api/files/{$file->file_id}"),
              'file_id' => $file->file_id
      ]);
    }

    public function index()
    {
	    return view('upload');
    }
}

