<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $demo_categories=[
        'Honey',
        'Natural Oil',
        'Nuts',
        'Coconut',
        'Butter'
      ];

      foreach($demo_categories as $values){
        Category::create([
            'title'=>$values,
            'slug'=>Str::slug($values)
        ]);
      }
    }
}
