<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LinksController extends Controller
{
    public function __invoke()
    {
        $urls = Url::all();
        return Inertia::render('Links/Index', [
            'urls' => $urls,
        ]);
    }
}
