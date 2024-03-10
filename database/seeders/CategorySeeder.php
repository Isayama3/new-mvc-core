<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        Category::create([
            'name_ar' => "نقل ثقيل",
            "name_en" =>'Truks',
            'description_ar' => "نقل ثقيل",
            "description_en" =>'Truks',
            'image' => 'storage/blank.png'
        ]);
    }
}
