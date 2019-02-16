<?php

use Illuminate\Database\Seeder;
use App\Models\Bug;
use App\Models\BugImportant;
use App\Models\BugType;
use App\Models\Bug;
use App\Models\BugComment;

class BugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $important = BugImportant::create(['title' => 'Low']);
        BugImportant::create(['title' => 'Medium']);
        BugImportant::create(['title' => 'High']);
        BugImportant::create(['title' => 'Critical']);

        $type = BugType::create(['title' => 'Bug']);
        BugType::create(['title' => 'Improvements']);

        $bug = Bug::create([
            'title' => 'Bug 1',
            'body' => 'Main body',
            'important' => $important->id,
            'type' => $type->id,
            'progress' => 0,
            'user_id' => 1,
        ]);

        BugComment::create([
            'body' => 'qwerty123456',
            'user_id' => 1,
            'bug_id' => $bug->id,
        ]);
      }
}
