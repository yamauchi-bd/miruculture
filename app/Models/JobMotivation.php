<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobMotivation extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type'];

    // タイプの定数
    const TYPE_CHANGE = 'change';
    const TYPE_SIDE = 'side';

    // タイプの選択肢
    public static $types = [
        self::TYPE_CHANGE => '転職',
        self::TYPE_SIDE => '副業',
    ];

    // スコープ：転職タイプのみ取得
    public function scopeChange($query)
    {
        return $query->where('type', self::TYPE_CHANGE);
    }

    // スコープ：副業タイプのみ取得
    public function scopeSide($query)
    {
        return $query->where('type', self::TYPE_SIDE);
    }
}