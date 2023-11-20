<?php 

namespace App\Actions;

use App\Models\File as Temp;
use Illuminate\Support\Facades\Storage;

class DelAction
{
	
    public function handle(string $file_id)
        {
            $file = Temp::where('file_id', $file_id)->first();
            Storage::delete("uploads/", $file->name);

            $file->delete();

        }
}

