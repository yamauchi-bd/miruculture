<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'parent_id'];

    // 親カテゴリとのリレーション（多対1）
    public function parent()
    {
        return $this->belongsTo(JobCategory::class, 'parent_id');
    }

    // 子カテゴリとのリレーション（1対多）
    public function children()
    {
        return $this->hasMany(JobCategory::class, 'parent_id');
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

     // すべての子孫カテゴリを取得
     public function descendants()
     {
         return $this->children()->with('descendants');
     }
 
     // カテゴリの完全な階層パスを取得
     public function getFullPathAttribute()
     {
         $path = [$this->name];
         $category = $this;
         while ($category->parent) {
             $category = $category->parent;
             array_unshift($path, $category->name);
         }
        return implode(' > ', $path);
    }
}
