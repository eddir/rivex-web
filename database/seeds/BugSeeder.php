<?php

use Illuminate\Database\Seeder;
use App\Models\Bug;
use App\Models\BugImportant;
use App\Models\BugType;

class BugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BugImportant::create(['title' => 'Low']);
        BugImportant::create(['title' => 'Medium']);
        BugImportant::create(['title' => 'High']);
        BugImportant::create(['title' => 'Critical']);

        BugType::create(['title' => 'Bug']);
        BugType::create(['title' => 'Improvements']);
      }
}
