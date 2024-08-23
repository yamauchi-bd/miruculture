こん
<div class="container">
    <h1>プロフィール</h1>
    
    @if(isset($career))
        <div class="card mb-3">
            <div class="card-body">
                <h2 class="card-title">基本情報</h2>
                <p>氏名: {{ $career->last_name }} {{ $career->first_name }}</p>
                <p>フリガナ: {{ $career->last_name_kana }} {{ $career->first_name_kana }}</p>
                <p>生年月日: {{ $career->birth_date ? $career->birth_date->format('Y年m月d日') : '未設定' }}</p>
                <p>性別: {{ $career->gender->name }}</p>
                <p>都道府県: {{ $career->prefecture->name }}</p>
                <p>キャリアステータス: {{ $career->careerStatus->name }}</p>

                @if($career->career_status_id == 1 || $career->career_status_id == 9)
                    <h2 class="card-title mt-4">社会人情報</h2>
                    <p>転職動機: {{ $career->jobChangeMotivation->name ?? '未設定' }}</p>
                    <p>副業動機: {{ $career->sideJobMotivation->name ?? '未設定' }}</p>
                    <p>現在の業界: {{ $career->currentIndustry->name ?? '未設定' }}</p>
                    <p>現在の職種: {{ $career->currentJobCategory->name ?? '未設定' }}</p>
                    <p>現在の職種（詳細）: {{ $career->currentJobSubcategory->name ?? '未設定' }}</p>
                    <p>現在の職務経験年数: {{ $career->currentJobYears->name ?? '未設定' }}</p>
                    <p>年収: {{ $career->annualIncome->name ?? '未設定' }}</p>
                @elseif($career->career_status_id == 2)
                    <h2 class="card-title mt-4">学生情報</h2>
                    <p>学校種別: {{ $career->collegeType->name ?? '未設定' }}</p>
                    <p>学校名: {{ $career->college_name ?? '未設定' }}</p>
                    <p>学部: {{ $career->college_faculty ?? '未設定' }}</p>
                    <p>学科: {{ $career->college_department ?? '未設定' }}</p>
                    <p>卒業予定年月: {{ $career->graduation_years }}年 {{ $career->graduation_month }}月</p>
                @endif
            </div>
        </div>
    @else
        <p>キャリア情報がまだ登録されていません。</p>
    @endif
</div>