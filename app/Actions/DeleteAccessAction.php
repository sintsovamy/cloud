<?php

namespace App\Actions;

use App\Models\File;
use App\Models\User;
use App\Models\Access;
use Illuminate\Support\Facades\Storage;

class DeleteAccessAction
{
    public function handle($request, $file_id): array
    {   
            $file = File::where('file_id', $file_id)->first();

            $coauthor = User::where('email', $request->email)->first();

            Access::where('user_id', $coauthor->id)->delete();

	    //* это тоже можно всё в отдельный метод *//
	    //
            $authors = User::whereHas('files', function ($query) use ($file) {
                $query->where('accesses.file_id', $file->id);
            })->get();

            $dataArray = []; 

            $authors->each(function ($author) use ($file, &$dataArray) {

                $status = 'coauthor';

                if ($file->user_id === $author->id) {
                        $status = 'author';
                }

                $data = [ 
                        'fullname' => $author->first_name . " " . $author->last_name,
                        'email' => $author->email,
                        'type' => $status,
                        'code' => 200 
                ];

                $dataArray[] = $data;

            });

            return $dataArray;
    }
}

