<?php

namespace App\Http\Controllers;

use App\Http\Resources\LinkResource;
use App\Models\Url;
use Inertia\Inertia;

class LinksController extends Controller
{
  public function __invoke()
  {
    $urls = Url::all();
    return Inertia::render('Links/Index', [
      'urls' => LinkResource::collection($urls),
    ]);
  }
}
