<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;
use Database\Factories\TestimonialFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Testimonial::factory()->count(10)->create();
    }
}
