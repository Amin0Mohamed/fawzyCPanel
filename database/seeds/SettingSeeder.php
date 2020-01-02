<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $abstract_webs = \App\Setting::create([
            'display_name' => 'Abstract Webs',
            'var' => 'abstract_webs',
            'value' => 'abstract webs',
            'type' => 1
        ]);

        $committee_feeds = \App\Setting::create([
            'display_name' => 'Commit Feeds',
            'var' => 'committee_feeds',
            'value' => '',
            'type' => 3
        ]);

        $exhibitions = \App\Setting::create([
            'display_name' => 'Exhibitions PDF',
            'var' => 'exhibitions',
            'value' => '',
            'type' => 2
        ]);

        $homes = \App\Setting::create([
            'display_name' => 'Homes PDF',
            'var' => 'homes',
            'value' => '',
            'type' => 2
        ]);

        $maintopics = \App\Setting::create([
            'display_name' => 'Main Topics',
            'var' => 'maintopics',
            'value' => '',
            'type' => 3
        ]);

        $new_feeds = \App\Setting::create([
            'display_name' => 'New Feeds',
            'var' => 'new_feeds',
            'value' => '',
            'type' => 3
        ]);


    }
}
