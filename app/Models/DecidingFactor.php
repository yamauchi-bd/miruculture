<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecidingFactor extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_record_id',
        'factor_1', 'detail_1', 'satisfaction_1',
        'factor_2', 'detail_2', 'satisfaction_2',
        'factor_3', 'detail_3', 'satisfaction_3',
    ];

    public function enrollmentRecord()
    {
        return $this->belongsTo(EnrollmentRecord::class);
    }

    public static function getFactors()
    {
        return [
            '企業ビジョンへの共感' => '企業ビジョンへの共感',
            '革新的なビジネスモデル' => '革新的なビジネスモデル',
            '優秀で熱意のある仲間' => '優秀で熱意のある仲間',
            '成長できる環境･チャンス' => '成長できる環境･チャンス',
            '柔軟な働き方･場所' => '柔軟な働き方･場所',
            '給与･報酬など' => '給与･報酬など',
            'その他' => 'その他'
        ];
    }
}
