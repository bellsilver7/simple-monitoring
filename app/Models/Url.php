<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
  use HasFactory;

  protected $fillable = ['url'];

  protected $casts = [
    'active' => 'boolean',
    'failing' => 'boolean',
  ];

  public function scopeActive($query)
  {
    $query->where('active', 1);
  }

  public function failures()
  {
    return $this->hasMany(UrlFailure::class);
  }
}
