<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    public static function rules($id = 0)
    {
        return [
            'name' => "required|string|max:255|unique:categories,name,{$id}",
            'parent_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|in:active,archived',
        ];
    }


    // localScop in the controller we call this function without scop like => Filter
    function scopeFilter(Builder $builder, $filters)
    {
        $builder->when($filters['name'] ?? false, function ($builder, $value) {
            $builder->where('name', 'LIKE', "%$value%");
        });
        $builder->when($filters['status'] ?? false, function ($builder, $value) {
            $builder->where('status', $value );
        });
    }

    // public function parentCategory()
    // {
    //     return $this->belongsTo(Category::class, 'parent_id');
    // }
}
