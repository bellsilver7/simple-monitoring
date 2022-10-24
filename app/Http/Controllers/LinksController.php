<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinksStoreRequest;
use App\Http\Resources\LinkResource;
use App\Models\Url;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LinksController extends Controller
{
  public function index()
  {
    $urls = Url::all()->sortByDesc('updated_at');
    return Inertia::render('Links/Index', [
      'urls' => LinkResource::collection($urls),
    ]);
  }

  public function create()
  {
    return Inertia::render('Links/Create');
  }

  public function store(LinksStoreRequest $request)
  {
    Url::create($request->validated());

    return Redirect::route('links');
  }

  public function delete(Url $url)
  {
    $url->delete();
    return redirect()->route('links')->with('message', 'Post Delete Successfully');
  }
}
