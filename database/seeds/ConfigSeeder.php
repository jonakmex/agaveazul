<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('adminconf')->insert([
            'key' => 'mail.send',
            'value' => '1',
            'created_at' => Carbon::today()
        ]);
    }
}
