<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controlilers\AccessesController;
use App\Models\User;
use App\Models\File;

class Access extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'user_id',
    ];

}
