<?php

use Illuminate\Database\Seeder;
use App\Widget;

class WidgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Widget::create([
            'name' => 'Brayden McNabb',
            'description' => 'Defenseman',
            'code' => '3',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Deryk Engelland',
            'description' => 'Defenseman',
            'code' => '5',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Colin Miller',
            'description' => 'Defenseman',
            'code' => '6',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Jon Merrill',
            'description' => 'Defenseman',
            'code' => '15',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Reilly Smith',
            'description' => 'Right Winger',
            'code' => '19',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Cody Eakin',
            'description' => 'Center',
            'code' => '21',
            'status' => 'inactive',
        ]);

        Widget::create([
            'name' => 'Nick Holden',
            'description' => 'Defenseman',
            'code' => '22',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Oscar Lindberg',
            'description' => 'Left Winger',
            'code' => '24',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Paul Stastny',
            'description' => 'Center',
            'code' => '26',
            'status' => 'inactive',
        ]);

        Widget::create([
            'name' => 'Shea Theodore',
            'description' => 'Defenseman',
            'code' => '27',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'William Carrier',
            'description' => 'Left Winger',
            'code' => '28',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Marc-Andre Fleury',
            'description' => 'Goalie',
            'code' => '29',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Malcolm Subban',
            'description' => 'Goalie',
            'code' => '30',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Tomas Hyka',
            'description' => 'Right Winger',
            'code' => '38',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Ryan Carpenter',
            'description' => 'Center',
            'code' => '40',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Pierre-Edouard Bellemare',
            'description' => 'Center',
            'code' => '41',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Erik Haula',
            'description' => 'Center',
            'code' => '56',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Max Pacioretty',
            'description' => 'Left Winger',
            'code' => '67',
            'status' => 'inactive',
        ]);

        Widget::create([
            'name' => 'William karlsson',
            'description' => 'Center',
            'code' => '71',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Ryan Reaves',
            'description' => 'Elite Sniper',
            'code' => '75',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Brad Hunt',
            'description' => 'Defenseman',
            'code' => '77',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Jonathan Marchessault',
            'description' => 'Center',
            'code' => '81',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Nate Schmidt',
            'description' => 'Defenseman',
            'code' => '88',
            'status' => 'inactive',
        ]);

        Widget::create([
            'name' => 'Alex Tuch',
            'description' => 'Right Winger',
            'code' => '89',
            'status' => 'active',
        ]);

        Widget::create([
            'name' => 'Tomas Nosek',
            'description' => 'Left Winger',
            'code' => '92',
            'status' => 'active',
        ]);
    }
}
