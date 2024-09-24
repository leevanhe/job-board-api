<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\User;
use App\Models\Work;
use App\Models\WorkApplication;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Lee Van Hecke',
            'email' => 'test@test.com',
        ]);

        User::factory(300)->create();

        $users = User::all()->shuffle();

        for ($i = 0; $i < 20; $i++) {
            Employer::factory()->create([
                'user_id' => $users->pop()->id,
            ]);
        }

        $employers = Employer::all();

        for ($i = 0; $i < 100; $i++) {
            Work::factory()->create([
                'employer_id' => $employers->random()->id,
            ]);
        }

        foreach ($users as $user) {
            $jobs = Work::inRandomOrder()->take(rand(0, 4))->get();

            foreach ($jobs as $job) {
                WorkApplication::factory()->create([
                    'work_id' => $job->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
