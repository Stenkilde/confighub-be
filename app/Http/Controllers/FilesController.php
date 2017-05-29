<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\File;
use App\Rating;
use App\Category;
use App\User;

class FilesController extends Controller
{
    public function index()
    {
        $files = File::paginate(15);
        
        return $files;
    }

    public function single($id)
    {
        $file = File::where('id', $id)->first();
        $rating = Rating::where('fileId', $id)->get();
        $user = User::where('id', $file->userId)->first();
        $category = Category::where('id', $file->id)->first();

        $amount = 0;
        $arrayCount = count($rating);
        
        foreach($rating as $r)
        {
            $amount = $amount + $r->amount;
        }

        if ($amount === 0) {
            $file->rating = 0;
        } else {
            $average = ceil( $amount / $arrayCount );

            $file->rating = $average;
        }

        $file->user = $user;
        $file->category = $category;

        return $file;
    }

    public function create(Request $request)
    {
        $file = new File;

        $file->name = $request->input('name');
        $file->body = $request->input('body');
        $file->categoryId = $request->input('category');

        $file->save();

        return $file;
    }
}
