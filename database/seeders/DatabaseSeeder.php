<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Url;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    // \App\Models\User::factory(10)->create();

    \App\Models\User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
    ]);

    Url::create(['url' => 'https://www.amitavroy.com']);
    $url = Url::create(['url' => 'https://www.amitavroy.com/test']);

    for ($i = 0; $i < 5; $i++) {
      $time = now()->addMinutes(5 * $i);
      $url->failures()->create([
        'updated_at' => $time,
        'created_at' => $time,
      ]);
    }
    Url::create(['url' => 'https://focalworks.in']);
  }
}
