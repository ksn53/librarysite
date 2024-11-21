<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\TestCase;
use App\Models\User;
use App\Models\Book;

class BooksFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_createBookViewAccessible()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('books.create'));
        $response->assertStatus(200);
        $response->assertViewIs('bookAdd');
    }

    public function test_storeBookCreatesNew()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $data = [
            'title' => 'Test Book',
            'content' => 'Some content here',
            'category' => 'Fiction',
            'image' => UploadedFile::fake()->image('book.jpg'),
        ];

        $response = $this->actingAs($user)->post(route('books.store'), $data);

        $response->assertRedirect(route('admin.book.list'));
        $this->assertDatabaseHas('books', [
            'title' => 'Test Book',
            'content' => 'Some content here',
        ]);
        $this->assertDatabaseHas('categories', ['name' => 'Fiction']);
        Storage::disk('public')->assertExists('images/' . $data['image']->hashName());
    }

    public function test_update_book_updates_book_details()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $book = Book::factory()->create(['owner_id' => $user->id]);
        $data = [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
            'category' => 'Updated Category',
            'image' => UploadedFile::fake()->image('updated.jpg'),
            'year' => 1995
        ];
        $this->assertTrue($user->can('update', $book));

        $response = $this->actingAs($user)->put(route('books.update', $book), $data);
        $response->assertRedirect(route('admin.book.list'));
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Updated Title',
        ]);

        Storage::disk('public')->assertExists('images/' . $data['image']->hashName());
    }

    public function test_delete_book_removes_book_and_file()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $book = Book::factory()->create([
            'owner_id' => $user->id,
            'image' => 'images/book.jpg',
        ]);
        Storage::disk('public')->put('images/book.jpg', 'fake image content');
        $response = $this->actingAs($user)->delete(route('books.destroy', $book));
        $response->assertRedirect(route('admin.book.list'));
        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
        Storage::disk('public')->assertMissing('images/book.jpg');
    }


    public function test_guest_cannot_access_create_book_view()
    {
        $response = $this->get(route('books.create'));
        $response->assertRedirect(route('login'));
    }
}

