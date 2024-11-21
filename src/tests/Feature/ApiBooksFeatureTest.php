<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase;

class ApiBooksFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test user can retrieve list of books
     *
     * @return void
     */
    public function test_userCanGetBooksList()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $books = Book::factory(3)->create(['owner_id' => $user->id]);
        $response = $this->getJson(route('api.books.index'));
        $response->assertStatus(200)->assertJsonCount(3, 'data');
    }

    /**
     * Test user can create a new book
     *
     * @return void
     */
    public function test_userCanCreateBook()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();

        $data = [
            'title' => 'Test Book',
            'content' => 'Test content of the book',
            'category' => $category->name,
            'year' => 2024
        ];

        $response = $this->postJson(route('api.books.create'), $data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => 'true',
                'data' => [
                    'title' => 'Test Book',
                    'content' => 'Test content of the book',
                ]
            ]);
    }

    /**
     * Test user can retrieve a specific book
     *
     * @return void
     */
    public function test_userCanGetBook()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['owner_id' => $user->id]);
        $response = $this->actingAs($user)->getJson(route('api.books.show', $book->id));
        $response->assertStatus(200)
            ->assertJson([
                'success' => 'true',
                'data' => [
                    'id' => $book->id,
                    'title' => $book->title,
                ]
            ]);
    }

    /**
     * Test user can update a book
     *
     * @return void
     */
    public function test_userCanUpdateBook()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['owner_id' => $user->id]);
        $category = Category::factory()->create();

        $data = [
            'title' => 'Updated Title',
            'content' => 'Updated content',
            'category' => $category->name,
            'year' => 2025
        ];

        $response = $this->actingAs($user)->putJson(route('api.books.update', $book->id), $data);
        $response->assertStatus(200)
            ->assertJson([
                'success' => 'true',
                'data' => [
                    'title' => 'Updated Title',
                    'content' => 'Updated content',
                ]
            ]);
    }

    /**
     * Test user can delete a book
     *
     * @return void
     */
    public function test_userCanDeleteBook()
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['owner_id' => $user->id]);
        $response = $this->actingAs($user)->deleteJson(route('api.books.delete', $book->id));
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Book deleted successfully.'
            ]);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
