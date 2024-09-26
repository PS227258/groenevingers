<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class DomPdfController extends Controller
{
    public function getPdf(Request $request)
    {
        $data = [
            "title" => "Groene Vingers",
            "logo" => public_path("assets/images/logo.png"),
            "date" => date("m/d/Y"),
        ];

        $pdf = PDF::loadview("magecompPDF", $data);
        return $pdf->download("factuur.pdf");

        // return $pdf->stream('magecomp.pdf');
    }
}
