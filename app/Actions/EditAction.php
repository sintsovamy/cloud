<?php

namespace App\Actions;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class EditAction
{
    public function handle($request, $file_id)
    {
	$file = File::where('file_id', $file_id)->first();

        $oldName = $file->name;
        $newName = $request->name . "." . pathinfo($oldName, PATHINFO_EXTENSION);

	Storage::move("uploads/{$oldName}", "uploads/{$newName}");
	File::where('name', $oldName)->update(['name' => $newName]);
    }
}

