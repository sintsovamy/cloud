<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\File as Temp;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Access;

class FilesController extends Controller
{
    public function upload(Request $request)
    {
        $user =  auth('sanctum')->user();  
        $validator = Validator::make($request->all(), [
                'file' => 'required|mimes:pdf,doc,docx,zip,jpeg,jpg,png|max:2048',
	]);



        if ($validator->fails()) {
                return response()->json([
                        'success' => false,
                        'code' => 422,
                        'errors' => $validator->errors()], 422);
	}


	$file = $request->file('file');
	$fileName = Temp::createName($file->getClientOriginalName());
	$file->storeAs('./', $fileName, 'local');

	$file = Temp::create([
		'name' => $fileName,
		'file_id' => Temp::createFileId(),
		'user_id' => $user->id,
	]);

	$access = Access::create([
		'file_id' => $file->id,
	        'user_id' => $user->id,
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

    public function edit(Request $request, $file_id)
    {
        $validator = Validator::make($request->all(), [
                'name' => 'require|unique',
	]);
	$file = Temp::where('file_id', $file_id)->first();
	$oldName = $file->name;
	
	$newName = $request->name . "." . pathinfo($oldName, PATHINFO_EXTENSION);

	Storage::move("uploads/{$oldName}", "uploads/{$newName}");
	Temp::where('name', $oldName)->update(['name' => $newName]);

	return response()->json([
		'success' => true,
		'code' => 200,
		'message' => 'Renamed'
	]);
    }

    public function delete(string $file_id)
    {
	$file = Temp::where('file_id', $file_id)->first();
	Storage::delete("uploads/", $file->name);

	$file->delete();

	return response()->json([
		'success' => true,
	        'code' => 200,
		'message' => 'File deleted'
	]);
    }

    public function download(string $file_id)
    {
        $file = Temp::where('file_id', $file_id)->first();
	return Storage::download($file->name);

    }

}

