<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\AccessesController;

class Access extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id',
        'user_id',
    ];


}
