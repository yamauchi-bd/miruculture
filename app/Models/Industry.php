<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    // タイムスタンプを使用しない場合
    public $timestamps = false;
}
