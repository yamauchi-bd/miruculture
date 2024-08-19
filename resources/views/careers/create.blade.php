@include('layouts.header')

<section class="py-24 relative">
    <div class="max-w-7xl px-4 md:px-5 lg:px-5 lg:w-1/2 mx-auto">
        <div class="w-full flex-col justify-start items-start lg:gap-14 md:gap-10 gap-8 inline-flex">
            <div class="w-full flex-col justify-start items-start gap-6 flex">
                <h4 class="text-gray-900 text-xl font-semibold leading-loose">基本情報の登録</h4>
                <div class="w-full flex-col justify-start items-start gap-8 flex">
                    <div class="w-full justify-start items-start gap-8 flex sm:flex-row flex-col">
                        <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                            <label for=""
                                class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">性
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                    fill="none">
                                    <path
                                        d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                        fill="#EF4444" />
                                </svg>
                            </label>
                            <input type="text"
                                class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="山田">
                        </div>
                        <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                            <label for=""
                                class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">名
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                    fill="none">
                                    <path
                                        d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                        fill="#EF4444" />
                                </svg>
                            </label>
                            <input type="text"
                                class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="太郎">
                        </div>
                    </div>
                    <div class="w-full justify-start items-start gap-8 flex sm:flex-row flex-col">
                        <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                            <label for=""
                                class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">セイ
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                    fill="none">
                                    <path
                                        d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                        fill="#EF4444" />
                                </svg>
                            </label>
                            <input type="text"
                                class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="ヤマダ">
                        </div>
                        <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                            <label for=""
                                class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">メイ
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                    fill="none">
                                    <path
                                        d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                        fill="#EF4444" />
                                </svg>
                            </label>
                            <input type="text"
                                class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="タロウ">
                        </div>
                    </div>
                    <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                        <label for="birthdate"
                            class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">生年月日
                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                fill="none">
                                <path
                                    d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                    fill="#EF4444" />
                            </svg>
                        </label>
                        <input type="date" id="birthdate" name="birthdate"
                            class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                        <label for=""
                            class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">性別
                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                fill="none">
                                <path
                                    d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                    fill="#EF4444" />
                            </svg>
                        </label>
                        <div class="flex gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="gender" value="male">
                                <span class="ml-2">男性</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="gender" value="female">
                                <span class="ml-2">女性</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="gender" value="other">
                                <span class="ml-2">無回答</span>
                            </label>
                        </div>
                    </div>
                    <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                        <label for="prefecture"
                            class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">住所
                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                fill="none">
                                <path
                                    d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                    fill="#EF4444" />
                            </svg>
                        </label>
                        <select id="prefecture" name="prefecture"
                            class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">選択してください</option>
                            <option value="北海道">北海道</option>
                            <option value="青森県">青森県</option>
                            <option value="岩手県">岩手県</option>
                            <option value="宮城県">宮城県</option>
                            <option value="秋田県">秋田県</option>
                            <option value="山形県">山形県</option>
                            <option value="福島県">福島県</option>
                            <option value="茨城県">茨城県</option>
                            <option value="栃木県">栃木県</option>
                            <option value="群馬県">群馬県</option>
                            <option value="埼玉県">埼玉県</option>
                            <option value="千葉県">千葉県</option>
                            <option value="東京都">東京都</option>
                            <option value="神奈川県">神奈川県</option>
                            <option value="新潟県">新潟県</option>
                            <option value="富山県">富山県</option>
                            <option value="石川県">石川県</option>
                            <option value="福井県">福井県</option>
                            <option value="山梨県">山梨県</option>
                            <option value="長野県">長野県</option>
                            <option value="岐阜県">岐阜県</option>
                            <option value="静岡県">静岡県</option>
                            <option value="愛知県">愛知県</option>
                            <option value="三重県">三重県</option>
                            <option value="滋賀県">滋賀県</option>
                            <option value="京都府">京都府</option>
                            <option value="大阪府">大阪府</option>
                            <option value="兵庫県">兵庫県</option>
                            <option value="奈良県">奈良県</option>
                            <option value="和歌山県">和歌山県</option>
                            <option value="鳥取県">鳥取県</option>
                            <option value="島根県">島根県</option>
                            <option value="岡山県">岡山県</option>
                            <option value="広島県">広島県</option>
                            <option value="山口県">山口県</option>
                            <option value="徳島県">徳島県</option>
                            <option value="香川県">香川県</option>
                            <option value="愛媛県">愛媛県</option>
                            <option value="高知県">高知県</option>
                            <option value="福岡県">福岡県</option>
                            <option value="佐賀県">佐賀県</option>
                            <option value="長崎県">長崎県</option>
                            <option value="熊本県">熊本県</option>
                            <option value="大分県">大分県</option>
                            <option value="宮崎県">宮崎県</option>
                            <option value="鹿児島県">鹿児島県</option>
                            <option value="沖縄県">沖縄県</option>
                        </select>
                    </div>
                    <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                        <label for=""
                            class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">現在のキャリア
                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                fill="none">
                                <path
                                    d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                    fill="#EF4444" />
                            </svg>
                        </label>
                        <div class="flex gap-4">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="career" value="">
                                <span class="ml-2">社会人</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="career" value="">
                                <span class="ml-2">学生</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="career" value="">
                                <span class="ml-2">その他</span>
                            </label>
                        </div>
                    </div>
                    <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                        <label for="industry"
                            class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">現在の業種
                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                fill="none">
                                <path
                                    d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                    fill="#EF4444" />
                            </svg>
                        </label>
                        <select id="industry" name="industry"
                            class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">選択してください</option>
                            <option value="IT・通信">IT・通信</option>
                            <option value="メーカー">メーカー</option>
                            <option value="商社">商社</option>
                            <option value="小売">小売</option>
                            <option value="サービス">サービス</option>
                            <option value="金融">金融</option>
                            <option value="マスコミ">マスコミ</option>
                            <option value="広告">広告</option>
                            <option value="建設・不動産">建設・不動産</option>
                            <option value="運輸・物流">運輸・物流</option>
                            <option value="エネルギー">エネルギー</option>
                            <option value="医療・福祉">医療・福祉</option>
                            <option value="教育">教育</option>
                            <option value="公務員">公務員</option>
                            <option value="農林水産">農林水産</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>
                    <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                        <label for="job_category"
                            class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">現在の職種（大カテゴリー）
                            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                fill="none">
                                <path
                                    d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                    fill="#EF4444" />
                            </svg>
                        </label>
                        <select id="job_category" name="job_category"
                            class="w-full focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">選択してください</option>
                            <option value="営業">営業</option>
                            <option value="事務・管理">事務・管理</option>
                            <option value="企画・マーケティング">企画・マーケティング</option>
                            <option value="技術・エンジニアリング">技術・エンジニアリング</option>
                            <option value="デザイン・クリエイティブ">デザイン・クリエイティブ</option>
                            <option value="専門職（コンサルタント・士業）">専門職（コンサルタント・士業）</option>
                            <option value="経営・役員">経営・役員</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>
                </div>
                <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                    <label for="job_subcategory"
                        class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">現在の職種（小カテゴリー）
                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                            <path
                                d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                fill="#EF4444" />
                        </svg>
                    </label>
                    <div class="w-full flex gap-4">
                        <select id="job_subcategory" name="job_subcategory"
                            class="w-2/3 focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">選択してください</option>
                            <!-- ここに小カテゴリーの選択肢を追加 -->
                        </select>
                        <select id="experience_years" name="experience_years"
                            class="w-1/3 focus:outline-none text-gray-900 placeholder-gray-400 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">経験年数</option>
                            <option value="1">1年未満</option>
                            <option value="2">1-2年</option>
                            <option value="3">3-5年</option>
                            <option value="4">6-10年</option>
                            <option value="5">11年以上</option>
                        </select>
                    </div>
                </div>
                <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                    <label for="current_income"
                        class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">現在の年収
                        <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7" fill="none">
                            <path
                                d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                fill="#EF4444" />
                        </svg>
                    </label>
                    <select id="current_income" name="current_income" aria-label="現在の年収を選択"
                        class="w-full focus:outline-none text-gray-900 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">選択してください</option>
                        <option value="〜300万円">〜300万円</option>
                        <option value="300万円〜400万円">300万円〜400万円</option>
                        <option value="400万円〜500万円">400万円〜500万円</option>
                        <option value="500万円〜600万円">500万円〜600万円</option>
                        <option value="600万円〜700万円">600万円〜700万円</option>
                        <option value="700万円〜800万円">700万円〜800万円</option>
                        <option value="800万円〜900万円">800万円〜900万円</option>
                        <option value="900万円〜1000万円">900万円〜1000万円</option>
                        <option value="1000万円〜1500万円">1000万円〜1500万円</option>
                        <option value="1500万円〜2000万円">1500万円〜2000万円</option>
                        <option value="2000万円〜">2000万円〜</option>
                    </select>
                </div>
                <div class="w-full justify-start items-start gap-8 flex sm:flex-row flex-col">
                    <div class="w-full justify-start items-start gap-8 flex sm:flex-row flex-col">
                        <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                            <label for="job_change_intention"
                                class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">転職の意欲
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                    fill="none">
                                    <path
                                        d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                        fill="#EF4444" />
                                </svg>
                            </label>
                            <select id="job_change_intention" name="job_change_intention"
                                class="w-full focus:outline-none text-gray-900 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">選択してください</option>
                                <option value="積極的に検討中">積極的に検討中</option>
                                <option value="検討している">検討している</option>
                                <option value="いい案件があれば">いい案件があれば</option>
                                <option value="全く考えていない">全く考えていない</option>
                            </select>
                        </div>
                        <div class="w-full flex-col justify-start items-start gap-1.5 flex">
                            <label for="side_job_intention"
                                class="flex gap-1 items-center text-gray-600 text-base font-medium leading-relaxed">副業の意欲
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="7" viewBox="0 0 7 7"
                                    fill="none">
                                    <path
                                        d="M3.11222 6.04545L3.20668 3.94744L1.43679 5.08594L0.894886 4.14134L2.77415 3.18182L0.894886 2.2223L1.43679 1.2777L3.20668 2.41619L3.11222 0.318182H4.19105L4.09659 2.41619L5.86648 1.2777L6.40838 2.2223L4.52912 3.18182L6.40838 4.14134L5.86648 5.08594L4.09659 3.94744L4.19105 6.04545H3.11222Z"
                                        fill="#EF4444" />
                                </svg>
                            </label>
                            <select id="side_job_intention" name="side_job_intention"
                                class="w-full focus:outline-none text-gray-900 text-base font-normal leading-relaxed px-4 py-2 rounded-md shadow-sm border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">選択してください</option>
                                <option value="積極的に検討中">積極的に検討中</option>
                                <option value="検討している">検討している</option>
                                <option value="いい案件があれば">いい案件があれば</option>
                                <option value="全く考えていない">全く考えていない</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button
            class="mx-auto mt-16 sm:w-fit w-full px-9 py-3 bg-indigo-600 hover:bg-indigo-700 ease-in-out transition-all duration-700 rounded-xl shadow justify-center items-center flex">
            <span class="px-3.5 text-center text-white text-lg font-semibold leading-8">確認画面へ</span>
        </button>
    </div>
    </div>
</section>

@include('layouts.footer')