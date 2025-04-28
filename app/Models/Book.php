<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'category_id',
        'is_available'
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'is_available' => 'boolean'
    ];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function currentBorrowing()
    {
        return $this->borrowings()->whereNull('returned_at')->first();
    }

    public function isAvailable()
    {
        return $this->is_available && !$this->currentBorrowing();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
