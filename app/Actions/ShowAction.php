<?php

namespace App\Actions;

use App\Models\File;
use App\Models\User;
use App\Models\Access;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ShowAction
{
    public function showAll($request): array
    {
            $user = Auth::user();

            $files = File::whereHas('users', function ($query) use ($user) {
                $query->where('accesses.user_id', $user->id);
            })->get();

            $dataArray = [];

            $files->each(function ($file) use ($user, &$dataArray) {

                $data = [
                        'file_id' => $file->file_id,
                        'name' => $file->name,
			'code' => 200,
			'url' => url("api/files/{$file->file_id}")
		];

		$authors = User::whereHas('files', function ($query) use ($file) {
                       $query->where('accesses.file_id', $file->id);
		})->get();

                    $accesses = []; 

                    $authors->each(function ($author) use ($file, &$accesses) {

                    $status = 'coauthor';

                    if ($file->user_id === $author->id) {
                        $status = 'author';
                    }

		    $accesses = [ 
                               'fullname' => $author->first_name . " " . $author->last_name,
                               'email' => $author->email,
                               'type' => $status,
			   ];


                    });

		    $data['accesses'] = $accesses;

		    $dataArray[] = $data;
	    });

	    return $dataArray;
    }


    public function showShared($request): array
    {
            $user = Auth::user();

            $files = File::whereHas('users', function ($query) use ($user) {
                $query->where('accesses.user_id', $user->id);
            })->where('user_id', '!=', $user->id)->get();

            $dataArray = [];

            $files->each(function ($file) use ($user, &$dataArray) {

                $data = [
                        'file_id' => $file->file_id,
                        'name' => $file->name,
                        'code' => 200,
                        'url' => url("api/files/{$file->file_id}")
		];

		$dataArray[] = $data;
	    }
	    );

	    return $dataArray;
    }

}


