<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\BookCreated;
use App\Traits\FlushCacheTrait;
use Storage;

class Book extends Model
{
    use HasFactory;
    use FlushCacheTrait;
    public $fillable = ['title', 'content', 'owner_id', 'category_id', 'image', 'year'];
    protected $cacheTags = ['books', 'categorys'];
    protected $singleCacheTag = 'book|';
    protected $dispatchesEvents = ['created' => BookCreated::class];
    public function getRouteKeyName()
    {
        return 'id';
    }
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function getCacheTags()
    {
        return $this->cacheTags;
    }
    public function getSingleCacheTag()
    {
        return $this->singleCacheTag;
    }
    public function deleteImage(): void
    {
        if (!empty($this->image)) {
            $path = str_replace('/storage/', '', $this->image);
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}
