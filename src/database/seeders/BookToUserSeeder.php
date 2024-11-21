<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Category;
use App\Models\User;

class BookToUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->create(['name' => 'Business']);
        $user = User::factory()->create(['email' => 'testmail@test.loc']);
        $this->createBooks($user);
    }

    public function createBooks(User $user)
    {
        Book::factory()->count(5)->create(['owner_id' => $user, 'category_id' => Category::get()->first()]);
    }
}
