<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalityType extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'enrollment_record_id'];

    public static function getSixteenTypes()
    {
        return [
            // 外交官
            'INFP' => 'INFP（仲介者）',
            'INFJ' => 'INFJ（提唱者）',
            'ENFP' => 'ENFP（運動家）',
            'ENFJ' => 'ENFJ（主人公）',
            // 分析家
            'INTP' => 'INTP（論理学者）',
            'INTJ' => 'INTJ（建築家）',
            'ENTP' => 'ENTP（論理者）',
            'ENTJ' => 'ENTJ（指揮官）',
            // 探検家
            'ISTP' => 'ISTP（巨匠）',
            'ISFP' => 'ISFP（冒険家）',
            'ESTP' => 'ESTP（起業家）',
            'ESFP' => 'ESFP（エンターテイナー）',
            // 番人
            'ISTJ' => 'ISTJ（管理者）',
            'ISFJ' => 'ISFJ（擁護者）',
            'ESTJ' => 'ESTJ（幹部）',
            'ESFJ' => 'ESFJ（領事）',
        ];
    }

    public function enrollmentRecord()
    {
        return $this->belongsTo(EnrollmentRecord::class);
    }
}
