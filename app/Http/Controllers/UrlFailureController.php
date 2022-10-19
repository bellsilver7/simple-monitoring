<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlFailureController extends Controller
{
  public function index(Url $url)
  {
    $data = Url::with('failures')
      ->where('id', $url->id)
      ->first();
    return response()->json(['data' => $data]);
  }
}
