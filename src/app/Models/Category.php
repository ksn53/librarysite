<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subcategory()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function books()
    {
        return $this->hasMany(Book::class);
    }
    public static function categoryCloud()
    {
        $categoryCloud = \Cache::tags(['categorys'])->remember('categoryCloud', 3600, function() {
            $bookCategorys = (new static())->has('books')->get();
            return $bookCategorys;
        });
        return $categoryCloud;
    }
}
