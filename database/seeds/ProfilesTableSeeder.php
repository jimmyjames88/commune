<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Generating ' . $GLOBALS['userCount'] . ' Profiles');
        factory(App\Profile::class, $GLOBALS['userCount'])->create();
        $this->command->info('Profiles created');
    }
}
