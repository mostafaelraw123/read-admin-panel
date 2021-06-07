<?php

namespace Database\Seeders;

use App\Models\Setting;
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
        \App\Models\Admin::create([
            'email' => "admin@admin.com",
            'phone' => "01025130204",
            'password' => bcrypt(123456),
        ]);


        //---------  insert Settings of app  -----------
        Setting::create([
            'title' => [
                'ar'=>"اسم المشروع",
                'en'=>"name of app",
                'de'=>"Name der App",
            ]
        ]);

    }
}
