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

    public function users()
    {
        return $this->belongsToMany(User::class, 'accesses');
    }

}
