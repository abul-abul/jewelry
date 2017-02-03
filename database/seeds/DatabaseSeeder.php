<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\User::truncate();
        \App\Category::truncate();
        \App\Gallery::truncate();
        // \App\Order::truncate();


       // \App\Category::create([
       //  		'id' => 1,
       //          'category' => 'Rings',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //  	]);
       // \App\Category::create([
       //  		'id' => 2,
       //          'category' => 'Pins',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //  	]);
       // \App\Category::create([
       //  		'id' => 3,
       //          'category' => 'Bracllete',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //  	]);
       // 	\App\Category::create([
       //  		'id' => 4,
       //          'category' => 'Lockets',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //  	]);


       // \App\Metal::create([
       //  		'id' => 1,
       //          'name' => 'Gold',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //  	]);
       // \App\Metal::create([
       //  		'id' => 2,
       //          'name' => 'White Gold',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //  	]);
       // \App\Metal::create([
       //  		'id' => 3,
       //          'name' => 'Silver',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //  	]);
       // 	\App\Metal::create([
       //  		'id' => 4,
       //          'name' => 'Bronze',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //  	]);

       //  \App\Gemstone::create([
       //          'id' => 1,
       //          'name' => 'Ruby',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //      ]);
       // \App\Gemstone::create([
       //          'id' => 2,
       //          'name' => 'Diamond',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //      ]);
       // \App\Gemstone::create([
       //          'id' => 3,
       //          'name' => 'Agate',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //      ]);
       //  \App\Gemstone::create([
       //          'id' => 4,
       //          'name' => 'Garnet',
       //          'created_at' => date('Y-m-d H:i:s'),
       //          'updated_at' => date('Y-m-d H:i:s')
       //      ]);
        \App\User::create([
            'first_name' => str_random(10),
            'last_name' => str_random(10),
            'email' => 'admin.@gmail.com',
            'password' => bcrypt('secret'),
            'role' => 'admin',
            'address' => 'Abovyan 22',
            'city' => 'Yeravan',
            'country' => 'Armenia',
            'postal_code' => '7436',
            'phone_number' => '37499999999'
        ]);

          \App\User::create([
            'first_name' => 'user',
            'last_name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'user',
            'address' => 'Abovyan 22',
            'city' => 'Yeravan',
            'country' => 'Armenia',
            'postal_code' => '0010',
            'phone_number' => '374 99 99 99 99',
            'is_active' => '1',
        ]);

        \App\Category::create([
                'category' => 'Rings',
         ]);
                
        \App\Category::create([
                'category' => 'Earrings',
         ]);

        \App\Category::create([
                'category' => 'Bracelets',
         ]);

        \App\Category::create([
                'category' => 'Chains',
         ]);

        \App\Category::create([
                'category' => 'Necklaces',
         ]);

        \App\Category::create([
                'category' => 'Crosses & Rosaries',
         ]);

        \App\Gallery::create([
            'status' => 'Collections'
        ]);

        \App\Gallery::create([
            'status' => 'Event'
        ]);

        \App\Gallery::create([
            'status' => 'New Arrivals'
        ]);

        \App\Gallery::create([
            'status' => 'Newsletter'
        ]);

        \App\Gallery::create([
            'status' => 'Featured Items'
        ]);

        \App\ShippingAddress::create([
            'user_id' => '2',
            'address' => 'Abovyan 22',
            'city' => 'Yeravan',
            'country' => 'Armenia',
            'postal_code' => '0010',
        ]);

        // \App\Order::create([
        //     'user_id' => '2',
        //     'address' => 'Abovyan 22',
        //     'city' => 'Yeravan',
        //     'country' => 'Armenia',
        //     'postal_code' => '0010',
        //     'quantity' => '3',
        //     'status' => 'Pending',
        //     'item_id' => '57',
        //     'size' => '6'
        // ]);

    }
}
