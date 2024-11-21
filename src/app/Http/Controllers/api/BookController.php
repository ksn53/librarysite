<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Resources\BookResource;
use Illuminate\Http\JsonResponse;

class BookController extends BaseController
{
    const rules = [
            'title' => 'required|min:5|max:100',
            'category' => 'required|min:5|max:100',
            'content' => 'required|max:512',
            'year' => 'sometimes|digits:4'
        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {
        $user = \Auth::user()->withAccessToken($request->bearerToken());
        $books = Book::whereOwnerId($user->id)->orderBy('id')->get();
        return $this->sendResponse(BookResource::collection($books), 'Books retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createBook(Request $request): JsonResponse
    {
        $user = Auth::user()->withAccessToken($request->bearerToken());
        $input = $request->all();
        $validator = Validator::make($input, $this::rules);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input['owner_id'] = $user->id;
        $input['category_id'] = Category::firstOrCreate(['name' => $input['category']])->id;
        unset($input['category']);
        $book = Book::create($input);

        return $this->sendResponse(new BookResource($book), 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getBook(Request $request, $id): JsonResponse
    {
        $user = \Auth::user()->withAccessToken($request->bearerToken());
        $book = Book::whereOwnerId($user->id)->find((int) $id);

        if (is_null($book)) {
            return $this->sendError('Book not found.');
        }

        return $this->sendResponse(new BookResource($book), 'Book retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBook(Request $request, $id): JsonResponse
    {
        $user = \Auth::user()->withAccessToken($request->bearerToken());
        $book = Book::whereOwnerId($user->id)->find((int) $id);

        if (is_null($book)) {
            return $this->sendError('Book not found.');
        }

        $input = $request->all();
        $validator = Validator::make($input, $this::rules);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $input['owner_id'] = $user->id;
        $input['category_id'] = Category::firstOrCreate(['name' => $input['category']])->id;
        unset($input['category']);

        $book->update($input);
        return $this->sendResponse(new BookResource($book), 'Book updated successfully.');
    }

    public function deleteBook(Request $request, $id): JsonResponse
    {
        $user = Auth::user()->withAccessToken($request->bearerToken());
        $book = Book::whereOwnerId($user->id)->find((int) $id);

        if (is_null($book)) {
            return $this->sendError('Book not found.');
        }
        $book->deleteImage();
        $book->delete();

        return $this->sendResponse([], 'Book deleted successfully.');
    }
}
