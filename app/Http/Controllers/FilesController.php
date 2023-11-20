<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UploadFileRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\File as Temp;
use Laravel\Sanctum\PersonalAccessToken;
use App\Models\Access;
use App\Models\User;
use App\Actions\UploadAction;
use App\Actions\EditAction;
use App\Actions\DelAction;
use App\Actions\GiveAccessAction;
use App\Http\Requests\EditRequest;
use App\Actions\DeleteAccessAction;
use App\Actions\ShowAction;
use Illuminate\Support\Facades\Response;

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
	$file = Temp::where('file_id', $file_id)->first();

	if ($request->user()->cannot('edit', $file)) {
		abort(403);
	}

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
	$file = Temp::where('file_id', $file_id)->first();

        if ($request->user()->cannot('edit', $file)) {
                abort(403);
        }

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

	if (Auth::user()->cannot('update', $file)) {
                 abort(403);
	}

	return Storage::download($file->name);

    }

    public function giveAccess(
	    Request $request, 
	    string $file_id,
            GiveAccessAction $action
    )
    {
	$file = Temp::where('file_id', $file_id)->first();

        if (Auth::user()->cannot('update', $file)) {
               abort(403);
	}

	$response = $action->handle($request, $file_id);

	return response()->json($response, 200);

    }
   
    public function deleteAccess(
	    Request $request,
	    string $file_id,
	    DeleteAccessAction $action
    )
    {
	//* Можно всё это и в абстрактный экшн запихнуть *//
	$file = Temp::where('file_id', $file_id)->first();

	if (Auth::user()->cannot('update', $file)) {
               abort(403);
	}
	//* Оставить только респонс, но тут всего 2 метода, заморачиваться не буду *//
	
	$response = $action->handle($request, $file_id);

	return response()->json($response, 200);
    }

    public function showAll(
	    Request $request,
            ShowAction $action
    )
    {
        $response = $action->showAll($request);

	return response()->json($response, 200);
    }

    public function showShared(
	    Request $request,
	    ShowAction $action
    )
    {
	    $response = $action->showShared($request);

	    return response()->json($response, 200);
    }


}

