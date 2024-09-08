<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('基本情報') }}
        </h2>
    </header>

    {{-- <form method="post" action="{{ route('careers.update') }}" class="mt-6 space-y-6"> --}}

<div class="container">
    
    @if(isset($career))
        <div class="card mb-3">
            <div class="card-body">
                <div>
                    <x-input-label for="full_name" :value="__('氏名')" />
                    <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="$career->last_name . ' ' . $career->first_name" disabled />
                </div>
            
                <div>
                    <x-input-label for="full_name_kana" :value="__('カナ')" />
                    <x-text-input id="full_name_kana" name="full_name_kana" type="text" class="mt-1 block w-full" :value="$career->last_name_kana . ' ' . $career->first_name_kana" disabled />
                </div>
                
                <div>
                    <x-input-label for="birth_date" :value="__('生年月日')" />
                    <x-text-input id="birth_date" name="birth_date" type="text" class="mt-1 block w-full" :value="$career->birth_date ? $career->birth_date->format('Y年m月d日') : '未設定'" disabled />
                </div>
            
                <div>
                    <x-input-label for="gender" :value="__('性別')" />
                    <x-text-input id="gender" name="gender" type="text" class="mt-1 block w-full" :value="$career->gender->name" disabled />
                </div>
            
                <div>
                    <x-input-label for="prefecture" :value="__('都道府県')" />
                    <x-text-input id="prefecture" name="prefecture" type="text" class="mt-1 block w-full" :value="$career->prefecture->name" disabled />
                </div>
            
                <div>
                    <x-input-label for="career_status" :value="__('現在のキャリア')" />
                    <x-text-input id="career_status" name="career_status" type="text" class="mt-1 block w-full" :value="$career->careerStatus->name" disabled />
                </div>
            
                @if($career->career_status_id == 1 || $career->career_status_id == 9)
                    <div>
                        <x-input-label for="current_industry" :value="__('現在の業界')" />
                        <x-text-input id="current_industry" name="current_industry" type="text" class="mt-1 block w-full" :value="$career->currentIndustry->name ?? '未設定'" disabled />
                    </div>
            
                    <div>
                        <x-input-label for="current_job_category" :value="__('現在の職種')" />
                        <x-text-input id="current_job_category" name="current_job_category" type="text" class="mt-1 block w-full" :value="$career->currentJobCategory->name ?? '未設定'" disabled />
                    </div>
            
                    <div>
                        <x-input-label for="current_job_subcategory" :value="__('職種の詳細')" />
                        <x-text-input id="current_job_subcategory" name="current_job_subcategory" type="text" class="mt-1 block w-full" :value="$career->currentJobSubcategory->name ?? '未設定'" disabled />
                    </div>
            
                    <div>
                        <x-input-label for="current_job_years" :value="__('経験年数')" />
                        <x-text-input id="current_job_years" name="current_job_years" type="text" class="mt-1 block w-full" :value="$career->currentJobYears->name ?? '未設定'" disabled />
                    </div>
            
                    <div>
                        <x-input-label for="annual_income" :value="__('現在の年収')" />
                        <x-text-input id="annual_income" name="annual_income" type="text" class="mt-1 block w-full" :value="$career->annualIncome->name ?? '未設定'" disabled />
                    </div>
            
                    <div>
                        <x-input-label for="job_change_motivation" :value="__('転職の意欲')" />
                        <x-text-input id="job_change_motivation" name="job_change_motivation" type="text" class="mt-1 block w-full" :value="$career->jobChangeMotivation->name ?? '未設定'" disabled />
                    </div>
            
                    <div>
                        <x-input-label for="side_job_motivation" :value="__('副業の意欲')" />
                        <x-text-input id="side_job_motivation" name="side_job_motivation" type="text" class="mt-1 block w-full" :value="$career->sideJobMotivation->name ?? '未設定'" disabled />
                    </div>
                @elseif($career->career_status_id == 2)
                    <div>
                        <x-input-label for="college_type" :value="__('学校種別')" />
                        <x-text-input id="college_type" name="college_type" type="text" class="mt-1 block w-full" :value="$career->collegeType->name ?? '未設定'" disabled />
                    </div>
            
                    <div>
                        <x-input-label for="college_name" :value="__('学校名')" />
                        <x-text-input id="college_name" name="college_name" type="text" class="mt-1 block w-full" :value="$career->college_name ?? '未設定'" disabled />
                    </div>
            
                    <div>
                        <x-input-label for="college_faculty" :value="__('学部')" />
                        <x-text-input id="college_faculty" name="college_faculty" type="text" class="mt-1 block w-full" :value="$career->college_faculty ?? '未設定'" disabled />
                    </div>
            
                    <div>
                        <x-input-label for="college_department" :value="__('学科')" />
                        <x-text-input id="college_department" name="college_department" type="text" class="mt-1 block w-full" :value="$career->college_department ?? '未設定'" disabled />
                    </div>
            
                    <div>
                        <x-input-label for="graduation_date" :value="__('卒業予定')" />
                        <x-text-input id="graduation_date" name="graduation_date" type="text" class="mt-1 block w-full" :value="$career->graduation_years . '年 ' . $career->graduation_month . '月'" disabled />
                    </div>
                @endif
            </div>
            <x-primary-button id="editButton" class="mt-8">{{ __('変更する') }}</x-primary-button>
        </div>
    @endif
</div>
    <!-- モーダル用のプレースホルダー -->
    <div id="editModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span><br>
            <div id="editContent"></div>
        </div>
    </div>
</section>

<script>
    document.getElementById('editButton').addEventListener('click', function() {
        fetch('{{ route("careers.edit", $career) }}')
            .then(response => response.text())
            .then(html => {
                document.getElementById('editContent').innerHTML = html;
                document.getElementById('editModal').style.display = 'block';
            });
    });
    
    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('editModal').style.display = 'none';
    });

    // モーダルの外側をクリックしたときにモーダルを閉じる
    window.onclick = function(event) {
        var modal = document.getElementById('editModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

<style>
    .modal {
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>