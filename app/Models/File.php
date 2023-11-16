<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Model\Access;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
	'file_id',
'user_id'
    ];

    public function accesses(): HasMany
    {
        return $this->hasMany(Access::class);
    }



    public static function createName(string $originalName)
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

    public static function createFileId()
    {
        return Str::random(10);
    }

}
