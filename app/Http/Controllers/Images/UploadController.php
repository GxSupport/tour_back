<?php

namespace App\Http\Controllers\Images;

use App\Http\Controllers\Controller;
use App\Http\Requests\Images\UploadRequest;
use App\Models\Images;
use Illuminate\Support\Str;

/**
 * @group Images
 */
class UploadController extends Controller
{
    /**
     *  Rasm yuklash uchun
     *  @authenticated
     */
    public function upload(UploadRequest $request)
    {
        $extension = $request->file('image')->getClientOriginalExtension();
        $random = Str::random(15);
        $storePath = 'public/images';
        $filename = $random.time(). '.' .$extension;
        $path = $request->file('image')->storeAs($storePath, $filename);
        $image = new Images();
        $image->name = $filename;
        $image->token = $random;
        $image->path = str_replace('public', 'storage', $path);
        $image->save();
        return success(['token'=>$random]);
    }
}
