<?php

// app/Http/Controllers/PostcodeController.php

namespace App\Http\Controllers;

use App\Services\PostcodeService;
use Illuminate\Http\Request;

class PostcodeController extends Controller
{
    protected $postcodeService;

    public function __construct(PostcodeService $postcodeService)
    {
        $this->postcodeService = $postcodeService;
    }

    public function showLookupForm()
    {
        return view('postcode.postcode');
    }

    public function lookup(Request $request)
    {
        $validatedData = $request->validate([
            'postcode' => 'required|string|max:10',
            'house_number' => 'required|string|max:10',
        ]);

        $postcode = $validatedData['postcode'];
        $houseNumber = $validatedData['house_number'];

        $result = $this->postcodeService->lookup($postcode, $houseNumber);

        return view('postcode.postcode', compact('result'));
    }
}
