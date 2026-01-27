<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeKeywordSearch($query, $keyword,$matchType='partial')
    {
        if (!empty($keyword)) {
            $searchKeyword = ($matchType === 'exact') ? $keyword : '%' . $keyword . '%';
            $operator = ($matchType === 'exact') ? '=' : 'like';

            $query->where(function($q) use ($searchKeyword, $operator) {
                $q->where('last_name', $operator, $searchKeyword)
                  ->orWhere('first_name', $operator, $searchKeyword)
                  ->orWhere('email', $operator, $searchKeyword)
                  ->orWhereRaw('CONCAT(last_name, first_name) ' . ($operator === '=' ? '= ?' : 'like ?'), [$searchKeyword]);
            });
        }
    }

    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender) && $gender !== 'all') {
            $query->where('gender', $gender);
        }
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    public function scopeDateSearch($query, $date)
    {
    if (!empty($date)) {
        $query->whereDate('created_at', $date);
        }
    }
}
