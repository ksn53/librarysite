<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;

    public function test_hasFallibleAttributes()
    {
        $book = new Book();

        $this->assertEquals(
            ['title', 'content', 'owner_id', 'category_id', 'image', 'year'],
            $book->getFillable()
        );
    }

    public function test_DispatchesEvent()
    {
        Event::fake();
        $book = Book::factory()->create();
        Event::assertDispatched(\App\Events\BookCreated::class);
    }

    public function test_belongsToOwner()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['owner_id' => $user]);

        $this->assertInstanceOf(User::class, $book->owner);
        $this->assertEquals($user->id, $book->owner->id);
    }

    public function test_belongsToCategory()
    {
        $category = Category::factory()->create();
        $book = Book::factory()->create(['category_id' => $category->id]);
        $this->assertInstanceOf(Category::class, $book->category);
        $this->assertEquals($category->id, $book->category->id);
    }

    public function test_usesCorrectRouteKeyName()
    {
        $book = new Book();
        $this->assertEquals('id', $book->getRouteKeyName());
    }

    public function test_hasCacheTags()
    {
        $book = new Book();
        $this->assertEquals(['books', 'categorys'], $book->getCacheTags());
        $this->assertEquals('book|', $book->getSingleCacheTag());
    }
}
