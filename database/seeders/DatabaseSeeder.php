<?php

namespace Database\Seeders;

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
        // 22-10-2021 thienth tạo dữ liệu đẻ chạy login
        $this->call([
            CampusSeederTable::class
        ]);
        \App\Models\User::factory(10)->create();
    }
}
