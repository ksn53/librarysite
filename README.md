# ver 0.01.01

Create a simple web application using Laravel that manages a library system. This application
should allow users to register and log in, manage books in the library, and provide an API for
external systems to access the book information. Below are the specific tasks to complete as
part of this assignment.

Requirements:
1. User Authentication (Sessions)
   ○ Implement user registration and login functionality using Laravel's built-in authentication system.
   ○ Once logged in, users should be able to manage (CRUD) their book collection.
2. CRUD Operations for Books
   ○ Users should be able to:
   ○ Create a new book entry (with title, author, description, and publication year).
   ○ Read (list all books) with pagination (5 books per page).
   ○ Update an existing book entry.
   ○ Delete a book from the library.
   ○ Ensure proper form validation (e.g., required fields, data types).
3. API Endpoints
   ○ Create a set of RESTful API endpoints for external systems to access the books:
   ○ GET /api/books - List all books.
   ○ GET /api/books/{id} - Get a single book by its ID.
   ○ POST /api/books - Create a new book.
   ○ PUT /api/books/{id} - Update an existing book.
   ○ DELETE /api/books/{id} - Delete a book.
   ○ Secure the API with an API token system (e.g., Laravel Passport, Sanctum, or basic token authentication).
4. Relationships (Optional for extra points)
   ○ Add an additional feature where each book can belong to a category (e.g., Fiction, Non-fiction, Science Fiction). Users should be able to assign books to categories, and
   filter books by category.
5. File Uploads - Allow users to upload a book cover image when creating or updating a book. Store this
   image in the storage/app/public folder, and display it when listing the books.
6. Database Migrations and Seeding
   ○ Use database migrations to create the necessary tables.
   ○ Seed the database with at least 10 sample books using Laravel seeders.
7. Middleware and Route Protection
   ○ Protect the book management routes so only authenticated users can access them.
   ○ Ensure that only the user who created a book can update or delete it.
8. Error Handling and Validation
   ○ Handle form validation errors and return meaningful error messages both in the UI and API responses.
   ○ Implement error logging for any server-side errors.
9. Unit and Feature Testing
   ○ Write unit tests for the Book model.
   ○ Write feature tests for the book management routes.
   ○ Write feature tests for the API endpoints/functions.
10. Bonus (Optional but Recommended)
    ○ Caching: Implement caching to optimize performance for listing books (e.g., cache the results of the GET /books query).
    ○ Events & Queues: Implement an event that triggers when a book is added, and log the event to a file.

--------------------------------------------------

Commands needed to power up this project:
 
composer install
composer dump-autoload --no-scripts --optimize

create folders storage/framework:
    sessions
    views
    cache

php artisan key:generate
php artisan migrate
php artisan db:seed

default user credentials:
user: testmail@test.loc
password: password
-----------------------------------------------------
Example API requests

Login
curl --request POST \
--url 'http://librarysite.loc/api/login?email=testmail%40test.loc&password=password' \
--header 'Content-Type: application/json'

GET books
curl --request GET \
--url http://librarysite.loc/api/books \
--header 'Authorization: Bearer 1|B6rNyHPSczUksPFc7qXs5ui4v456HnECf9NPJjOU8f9ab0fc'

GET one book with ID = 1
curl --request GET \
--url http://librarysite.loc/api/books/1 \
--header 'Authorization: Bearer 1|B6rNyHPSczUksPFc7qXs5ui4v456HnECf9NPJjOU8f9ab0fc'

POST create book
curl --request POST \
--url http://librarysite.loc/api/books \
--header 'Authorization: Bearer 1|B6rNyHPSczUksPFc7qXs5ui4v456HnECf9NPJjOU8f9ab0fc' \
--header 'Content-Type: application/json' \
--data '{
"title": "Test Title",
"content": "test content",
"year": 1995,
"category": "sciense"
}'

PUT update book
curl --request PUT \
--url http://librarysite.loc/api/books/1 \
--header 'Authorization: Bearer 1|B6rNyHPSczUksPFc7qXs5ui4v456HnECf9NPJjOU8f9ab0fc' \
--header 'Content-Type: application/json' \
--data '{
"title": "Test Title 1234",
"content": "test contenet",
"year": 1995,
"category": "sciense"
}'

DELETE book
curl --request DELETE \
--url http://librarysite.loc/api/books/1 \
--header 'Authorization: Bearer 1|B6rNyHPSczUksPFc7qXs5ui4v456HnECf9NPJjOU8f9ab0fc'