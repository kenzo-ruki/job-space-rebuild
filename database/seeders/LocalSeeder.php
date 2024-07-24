<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Page;
use Illuminate\Database\Seeder;
use App\Enum\UserRole;
use App\Models\Menuitem;
use App\Models\Menu;

class LocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Testimonial::factory(11)->create();
        \App\Models\TeamMember::factory(11)->create();
        \App\Models\Post::factory(30)->create();
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@test.com',
                'role' => UserRole::ADMIN,
            ],
            [
                'name' => 'user',
                'email' => 'user@test.com',
                'role' => UserRole::USER,
            ],
            [
                'name' => 'recruiter',
                'email' => 'recruiter@test.com',
                'role' => UserRole::RECRUITER,
            ],
            [
                'name' => 'jobseeker',
                'email' => 'jobseeker@test.com',
                'role' => UserRole::JOBSEEKER,
            ],
        ];
    
        foreach ($users as $user) {
            if (!User::where('email', $user['email'])->exists()) {
                User::create([
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'email_verified_at' => now(),
                    'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                ])->assignRole($user['role'], $user['role']);
            }
        }

        $pages = [
            [
                'title' => 'About',
                'slug' => 'about',
                'thumbnail' => '01HJCE93W8CD0EVR2NRN8WD6ZH.jpg',
                'body' => '<p>About page content</p>',
                'layout' => 1,
                'active' => 1,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'thumbnail' => '01HJCE9223KDXCJKR2EMQK8M87.jpg',
                'body' => '<p>Contact page content</p>',
                'layout' => 1,
                'active' => 1,
            ],
        ];
    
        foreach ($pages as $page) {
            Page::create($page);
        }

        $menus = [
            [
                'id' => 1,
                'name' => 'Header Menu',
                'location' => 'header',
                'active' => 1,
            ],
            [
                'id' => 2,
                'name' => 'Footer Menu',
                'location' => 'footer',
                'active' => 1,
            ],
            [
                'id' => 3,
                'name' => 'Guest Menu',
                'location' => 'guest',
                'active' => 1,
            ],
        ];
    
        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        $menu_items = [
            [
                'name' => 'Home',
                'url' => '/',
                'order' => 0,
                'menu_id' => 1,
            ],
            [
                'name' => 'About',
                'url' => 'about',
                'order' => 1,
                'menu_id' => 1,
            ],
            [
                'name' => 'Blog',
                'url' => 'blog',
                'order' => 2,
                'menu_id' => 1,
            ],
            [
                'name' => 'Contact Us',
                'url' => 'contact-us',
                'order' => 3,
                'menu_id' => 1,
            ],
            [
                'name' => 'Home',
                'url' => '/',
                'order' => 0,
                'menu_id' => 2,
            ],
            [
                'name' => 'About',
                'url' => 'about',
                'order' => 1,
                'menu_id' => 2,
            ],
            [
                'name' => 'Blog',
                'url' => 'blog',
                'order' => 2,
                'menu_id' => 2,
            ],
            [
                'name' => 'Contact Us',
                'url' => 'contact-us',
                'order' => 3,
                'menu_id' => 2,
            ],
            [
                'name' => 'Login',
                'url' => 'login',
                'order' => 0,
                'menu_id' => 3,
            ],
            [
                'name' => 'Register',
                'url' => 'register',
                'order' => 1,
                'menu_id' => 3,
            ]
        ];
    
        foreach ($menu_items as $menu_item) {
            Menuitem::create($menu_item);
        }
    }
}