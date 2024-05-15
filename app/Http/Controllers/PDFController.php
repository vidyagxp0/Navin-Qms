<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function show($name)
    {
        return view('frontend.rcms.layout.documentpdf', compact('name'));
    }

    public function stream($name)
    {
        return response()->file(
            public_path('user/pdf/'. $name .'.pdf')
        );
    }
}
