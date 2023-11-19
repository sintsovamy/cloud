<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\File as Temp;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Access;
use App\Actions\UploadAction;
use App\Actions\EditAction;
use App\Actions\DelAction;
use App\Http\Requests\EditRequest;

class FilesController extends Controller
{
    public function upload(
        UploadFileRequest $request,
	UploadAction $action,
    )
    {
	$request->validated();

	$file = $action->handle($request);

        return response()->json([
              'success' => true,
              'code' => 200,
              'name' => $file->name,
              'url' => url("api/files/{$file->file_id}"),
              'file_id' => $file->file_id
        ]);
    }

    public function index()
    {
	    return view('upload');
    }

    public function edit(
	    EditRequest $request, 
	    string $file_id,
            EditAction $action)
    {
        $request->validated();

	$action->handle($request, $file_id);

	return response()->json([
		'success' => true,
		'code' => 200,
		'message' => 'Renamed'
	]);
    }

    public function delete(
	    string $file_id,
            DelAction $action)
    {
        $action->handle($file_id);

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

