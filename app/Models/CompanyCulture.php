<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCulture extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function enrollmentRecord()
    {
        return $this->belongsTo(EnrollmentRecord::class);
    }

    public static function getCultureItems()
    {
        return [
            ['name' => '人間関係', 'a' => 'ドライ', 'b' => 'ウェット'],
            ['name' => '業務スタイル', 'a' => 'ロジカル', 'b' => 'クリエイティブ'],
            ['name' => '評価基準', 'a' => 'プロセス重視', 'b' => '結果重視'],
            ['name' => '組織スタイル', 'a' => '個人プレー', 'b' => 'チームプレー'],
            ['name' => '意思決定', 'a' => 'トップダウン', 'b' => 'ボトムアップ'],
            ['name' => '行動スタイル', 'a' => '計画･確実性', 'b' => '実行･スピード'],
            ['name' => '雰囲気', 'a' => 'モクモク･真面目', 'b' => 'ワイワイ･元気'],
            ['name' => 'ワークライフ', 'a' => 'バランス重視', 'b' => 'ワーク重視'],
        ];
    }
}
