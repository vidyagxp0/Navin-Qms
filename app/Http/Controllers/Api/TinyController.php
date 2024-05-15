<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TinyController extends Controller
{
    public function image_upload(Request $request)
    {
        $res = [
            'location' => 'https://google.com', //test value
        ];

        try {
            if ($request->hasFile('file')) {

                $file = $request->file('file');
                $name = time(). '-' . rand(100, 1000000) . '.' . $file->getClientOriginalExtension();
                $file->move('upload/', $name);
                $res['location'] = asset('upload/'. $name);
            }

        } catch (\Exception $e) {
        }


        return response()->json($res);
    }
}
