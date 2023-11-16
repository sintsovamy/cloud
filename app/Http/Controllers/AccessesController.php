<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Policies\FilePolicy;
use App\Models\File as Temp;
use App\Models\Access;
use App\Models\User;

class AccessesController extends Controller
{
    public function add(Request $request, $file_id)
    {
	    $file = Temp::where('file_id', $file_id)->first();
	    if ($request->user()->cannot('createAccess', $file)) {
		abort(403);
	}

	$coauthor = User::where('email', $request->email)->first();

	$access = Access::create([
		'file_id' => $file->id,
		'user_id' => $coauthor->id
	]);

	return response()->json([
		'fullname' => $coauthor->fisrt_name . $coauthor->last_name,
		'email' => $coauthor->email,
		'type' => 'co-author',
		'code' => 200,
	]);
    }

    public function delete(Request $request, $file_id)
    {
        $file = Temp::where('file_id', $file_id)->first();
        if ($request->user()->cannot('deleteAccess', $file)) {
		abort(403);
	}

	$coauthor = User::where('email', $request->email)->first();
	$access = Access::where('file_id', $file->id)->where('user_id', $coauthor->id)->first();
	$access->delete();

	return response()->json([
		'fullname' => $coauthor->fisrt_name . $coauthor->last_name,
		'email' => $coauthor->email,
		'type' => 'co-author',
		'code' => 200,
	]);
    }
}
