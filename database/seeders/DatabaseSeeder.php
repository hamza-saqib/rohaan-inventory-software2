<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AcademicYear;
use App\Models\Clas;
use App\Models\Section;
use App\Models\SectionClass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::makeDirectory('public/images');
        Storage::makeDirectory('public/files');

        User::create([
            'name' => 'Hamza Saqib',
            'email' => 'mianhamza7262@gmail.com',
            'phone' => '+92 323 9991999',
            'is_active' => true,
            'role' => 'Developer',
            'password' => Hash::make('hamza7262')
        ]);
        User::create([
            'name' => 'Maria Anwar',
            'email' => 'mariaanwar996@gmail.com',
            'phone' => '+92 323 9991999',
            'is_active' => true,
            'role' => 'Developer',
            'password' => Hash::make('maria123')
        ]);
        // User::create([
        //     'name' => 'Aqib Baig',
        //     'email' => 'aqib@malhoc.com',
        //     'phone' => '+92 323 9991999',
        //     'is_active' => true,
        //     'role' => 'Developer',
        //     'password' => Hash::make('aqib@123')
        // ]);

        $title = 'Batch-' . Carbon::now()->format('Y');
        AcademicYear::create([
            'title' => $title,
            'slug' => Str::slug($title),
            'start_date' => Carbon::now(),
            'end_date' => null,
            'is_open_for_admission' => true,
            'is_active' => true
        ]);

        $this->call([
            SchoolSeeder::class,
            AcademicYearSeeder::class,
            ClasSeeder::class,
            // TeacherSeeder::class,
            SectionSeeder::class,
            ExpenseCategorySeeder::class,
            ExpenseSeeder::class,
            StudentSeeder::class,
            // VoucherSeeder::class,
        ]);

        // \App\Models\Clas::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
