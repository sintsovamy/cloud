<?php

namespace App\Actions;

use App\Models\User;

class UploadAction
{
    public function __construct(File $file, Access $access)
    {
	    $this->file = $file;
	    $this->access = $access;
    }

    public function handle(array $attributes): File
    {
	$file = $attributes->file('file');

	$fileName = createName($file->getClientOriginalName());

        $file->storeAs('./', $fileName, 'local');

        $file->create([
                'name' => $fileName,
                'file_id' => Temp::createFileId(),
                'user_id' => $user->id,
        ]);

        $access->create([
                'file_id' => $file->id,
                'user_id' => $user->id,
        ]);

    }

    private function createName(string $name)
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

    private static function createFileId()
    {
        return Str::random(10);
    }
}

