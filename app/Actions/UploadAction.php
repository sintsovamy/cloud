<?php

namespace App\Actions;

use App\Models\User;
use App\Models\File as Temp;
use App\Models\Access;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UploadAction
{
    public function __construct(Temp $file, Access $access, User $user)
    {
	    $this->file = $file;
	    $this->access = $access;
	    $this->user = $user;
    }

    public function handle($request): Temp
    {
        $user = auth('sanctum')->user();
	$file = $request->file('file');

	$fileName = $this->createName($file->getClientOriginalName());

        $file->storeAs('./', $fileName, 'local');

        $file = Temp::create([
                'name' => $fileName,
                'file_id' => $this->createFileId(),
                'user_id' => $user->id,
        ]);

        $access = Access::create([
                'file_id' => $file->id,
                'user_id' => $user->id,
	]);

	return $file;

    }

    private function createName(string $originalName): string
    {
        $name = pathinfo($originalName, PATHINFO_FILENAME);
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);

        $fileName = $name . '.' . $extension;
        $i = 1;

        while (Storage::exists($fileName)) {
            $fileName = $name . '(' . $i . ")." . $extension;
            $i++;
        }

	return $fileName;
    }

    private function createFileId(): string
    {
        return Str::random(10);
    }
}

