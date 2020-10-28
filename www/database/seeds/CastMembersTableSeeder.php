<?php

use Illuminate\Database\Seeder;
use App\Models\CastMember;

class CastMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CastMember::class, 100)->create();
    }
}
