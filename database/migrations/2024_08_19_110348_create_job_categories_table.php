<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->timestamps();
        });
    
        Schema::table('job_categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('job_categories')->onDelete('cascade');
        });

        DB::table('job_categories')->insert([
            ['name' => '営業', 'parent_id' => null],
            ['name' => '管理・事務', 'parent_id' => null],
            ['name' => '経営・事業企画', 'parent_id' => null],
            ['name' => 'マーケティング', 'parent_id' => null],
            ['name' => 'ITエンジニア', 'parent_id' => null],
            ['name' => '機械・電気・電子・半導体（技術職）', 'parent_id' => null],
            ['name' => '化学・繊維・食品（技術職）', 'parent_id' => null],
            ['name' => '建築・土木・設備（技術職）', 'parent_id' => null],
            ['name' => 'メディカル（専門職）', 'parent_id' => null],
            ['name' => '金融（専門職）', 'parent_id' => null],
            ['name' => '不動産（専門職）', 'parent_id' => null],
            ['name' => 'コンサルタント・士業', 'parent_id' => null],
            ['name' => 'クリエイティブ', 'parent_id' => null],
            ['name' => 'サービス', 'parent_id' => null],
            ['name' => '小売・運輸', 'parent_id' => null],
            ['name' => 'その他', 'parent_id' => null],

            // サブカテゴリ（営業）
            ['name' => '法人営業', 'parent_id' => 1],
            ['name' => '個人営業', 'parent_id' => 1],
            ['name' => 'インサイドセールス', 'parent_id' => 1],
            ['name' => 'カウンターセールス・内勤営業', 'parent_id' => 1],
            ['name' => '代理店営業', 'parent_id' => 1],
            ['name' => '海外営業', 'parent_id' => 1],
            ['name' => 'カスタマーサクセス', 'parent_id' => 1],
            ['name' => '営業企画・営業管理', 'parent_id' => 1],
            ['name' => 'MR・医療関連営業', 'parent_id' => 1],
            ['name' => 'その他（営業）', 'parent_id' => 1],

            // サブカテゴリ（管理・事務）
            ['name' => '総務', 'parent_id' => 2],
            ['name' => '人事・労務', 'parent_id' => 2],
            ['name' => '法務', 'parent_id' => 2],
            ['name' => '内部監査', 'parent_id' => 2],
            ['name' => '特許・知的財産', 'parent_id' => 2],
            ['name' => '経理・会計・財務', 'parent_id' => 2],
            ['name' => 'IR', 'parent_id' => 2],
            ['name' => '広報', 'parent_id' => 2],
            ['name' => '資材購買・調達', 'parent_id' => 2],
            ['name' => '物流', 'parent_id' => 2],
            ['name' => '国際業務・貿易事務', 'parent_id' => 2],
            ['name' => '秘書', 'parent_id' => 2],
            ['name' => '一般事務・営業事務', 'parent_id' => 2],
            ['name' => '医療事務', 'parent_id' => 2],
            ['name' => '受付', 'parent_id' => 2],

            // サブカテゴリ（経営・事業企画）
            ['name' => '経営者・CEO・COO', 'parent_id' => 3],
            ['name' => '経営企画・戦略', 'parent_id' => 3],
            ['name' => '事業企画・統括', 'parent_id' => 3],
            ['name' => '新規事業企画・事業開発', 'parent_id' => 3],
            ['name' => 'CIO・CTO', 'parent_id' => 3],
            ['name' => 'CFO・コントローラー', 'parent_id' => 3],

            // サブカテゴリ（マーケティング）
            ['name' => 'プロダクトマーケティング・商品企画', 'parent_id' => 4],
            ['name' => 'PR・広告宣伝・販促', 'parent_id' => 4],
            ['name' => 'マーケティングリサーチ', 'parent_id' => 4],
            ['name' => 'Webマーケティング', 'parent_id' => 4],
            ['name' => 'バイヤー・マーチャンダイザー', 'parent_id' => 4],

            // サブカテゴリ（ITエンジニア）
            ['name' => 'プロジェクトマネージャー', 'parent_id' => 5],
            ['name' => 'ITコンサルタント・システムコンサルタント', 'parent_id' => 5],
            ['name' => 'システム開発（WEB・オープン系）', 'parent_id' => 5],
            ['name' => 'システム開発（汎用系）', 'parent_id' => 5],
            ['name' => 'システム開発（制御・組込み系）', 'parent_id' => 5], 
            ['name' => 'モバイルアプリエンジニア', 'parent_id' => 5],
            ['name' => 'サーバー設計・構築', 'parent_id' => 5],
            ['name' => 'ネットワーク設計・構築', 'parent_id' => 5],
            ['name' => 'セキュリティ設計・構築', 'parent_id' => 5],
            ['name' => '通信インフラ設計・構築', 'parent_id' => 5],
            ['name' => 'ITプリセールス・セールスエンジニア', 'parent_id' => 5],
            ['name' => '品質管理・テスティング・QA', 'parent_id' => 5],
            ['name' => 'テクニカルサポート・運用・保守', 'parent_id' => 5],
            ['name' => '社内SE', 'parent_id' => 5],
            ['name' => 'データアナリスト・データサイエンティスト', 'parent_id' => 5],

            // サブカテゴリ（機械・電気・電子・半導体（技術職））
            ['name' => '研究開発・企画（機械系）', 'parent_id' => 6],
            ['name' => '製品開発・設計（機械系）', 'parent_id' => 6],
            ['name' => '回路・電機・電機制御設計', 'parent_id' => 6],
            ['name' => '光学設計', 'parent_id' => 6],
            ['name' => '半導体・記録媒体・液晶プロセスエンジニア', 'parent_id' => 6],
            ['name' => 'パターン・レイアウト設計', 'parent_id' => 6],
            ['name' => '評価・解析・検証（機械系）', 'parent_id' => 6],
            ['name' => '生産技術・製造技術（機械系）', 'parent_id' => 6],
            ['name' => '生産管理・品質管理（機械系）', 'parent_id' => 6],
            ['name' => 'セールス・サポートエンジニア（機械系）', 'parent_id' => 6],

            // サブカテゴリ（化学・繊維・食品（技術職））
            ['name' => '研究・開発（化学系）', 'parent_id' => 7],
            ['name' => '生産技術・製造技術（化学系）', 'parent_id' => 7],
            ['name' => '生産管理・品質管理（化学系）', 'parent_id' => 7],
            ['name' => 'セールス・サポートエンジニア（化学系）', 'parent_id' => 7],

            // サブカテゴリ（建築・土木・設備（技術職））
            ['name' => '設計・測量・積算（建築）', 'parent_id' => 8],
            ['name' => '施工管理（建築）', 'parent_id' => 8],
            ['name' => '保守・メンテナンス（建築）', 'parent_id' => 8],
            ['name' => '設計・測量・積算（土木）', 'parent_id' => 8],
            ['name' => '施工管理（土木）', 'parent_id' => 8],
            ['name' => '保守・メンテナンス（土木）', 'parent_id' => 8],
            ['name' => '設計・測量・積算（設備）', 'parent_id' => 8],
            ['name' => '施工管理（設備）', 'parent_id' => 8],
            ['name' => '保守・メンテナンス（設備）', 'parent_id' => 8],

            // サブカテゴリ（メディカル（専門職））
            ['name' => '研究・開発（医薬品）', 'parent_id' => 9],
            ['name' => '臨床開発・学術・薬事（医療機器）', 'parent_id' => 9],
            ['name' => '臨床開発・治験（医薬品）', 'parent_id' => 9],
            ['name' => '製剤・薬事・学術', 'parent_id' => 9],
            ['name' => '生産管理・品質管理・品質保証（医薬品）', 'parent_id' => 9],
            ['name' => 'セールス・サポートエンジニア（医療機器）', 'parent_id' => 9],
            ['name' => '医師', 'parent_id' => 9],
            ['name' => '薬剤師', 'parent_id' => 9],
            ['name' => '看護師', 'parent_id' => 9],
            ['name' => 'その他（メディカル系）', 'parent_id' => 9],

            // サブカテゴリ（金融（専門職））
            ['name' => 'プライベートバンカー', 'parent_id' => 10],
            ['name' => 'ファンドマネージャー・ディーラー・トレーダー', 'parent_id' => 10],
            ['name' => '投資研究・アナリスト・エコノミスト・ストラテジスト', 'parent_id' => 10],
            ['name' => 'M&A・投資銀行部門', 'parent_id' => 10],
            ['name' => 'アクチュアリー・クオンツ・金融工学', 'parent_id' => 10],
            ['name' => 'リスク管理・与信管理・債権管理', 'parent_id' => 10],
            ['name' => 'コンプライアンス・内部監査', 'parent_id' => 10],
            ['name' => '金融事務・バックオフィス', 'parent_id' => 10],

            // サブカテゴリ（不動産（専門職））
            ['name' => 'アセットマネジメント・プロパティマネジメント', 'parent_id' => 11],
            ['name' => '鑑定・デューデリジェンス', 'parent_id' => 11],
            ['name' => '開発（用地仕入・企画）', 'parent_id' => 11],
            ['name' => 'マンション管理・ビル管理', 'parent_id' => 11],

            // サブカテゴリ（コンサルタント・士業）
            ['name' => '経営・戦略・業務コンサルタント', 'parent_id' => 12],
            ['name' => '財務・会計コンサルタント', 'parent_id' => 12],
            ['name' => '組織・人事コンサルタント', 'parent_id' => 12],
            ['name' => '物流・SCMコンサルタント', 'parent_id' => 12],
            ['name' => '生産管理・品質管理コンサルタント', 'parent_id' => 12],
            ['name' => '弁護士・弁理士', 'parent_id' => 12],
            ['name' => '会計士・税理士', 'parent_id' => 12],
            ['name' => '司法書士・行政書士・社会保険労務士', 'parent_id' => 12],
            ['name' => 'その他（コンサルタント系）', 'parent_id' => 12],

            // サブカテゴリ（クリエイティブ）
            ['name' => 'ディレクター（WEB）', 'parent_id' => 13],
            ['name' => 'ディレクター（ゲーム）', 'parent_id' => 13],
            ['name' => 'ディレクター（その他）', 'parent_id' => 13],
            ['name' => 'デザイナー（WEB）', 'parent_id' => 13],
            ['name' => 'デザイナー（アパレル・ファッション）', 'parent_id' => 13],
            ['name' => 'Webコーディング', 'parent_id' => 13],
            ['name' => 'プロダクト・工業デザイナー', 'parent_id' => 13],
            ['name' => 'グラフィック・CGデザイナー', 'parent_id' => 13],
            ['name' => 'DTPオペレーター', 'parent_id' => 13],
            ['name' => '映像クリエーター', 'parent_id' => 13],
            ['name' => 'サウンドクリエーター', 'parent_id' => 13],
            ['name' => '編集・ライター', 'parent_id' => 13],
            ['name' => '芸能関連', 'parent_id' => 13],
            ['name' => 'その他（クリエイティブ系）', 'parent_id' => 13],

            // サブカテゴリ（サービス）
            ['name' => 'カスタマーサポート・コールセンター運営・管理', 'parent_id' => 14],
            ['name' => '教師・講師・インストラクター', 'parent_id' => 14],
            ['name' => '介護・福祉', 'parent_id' => 14],
            ['name' => 'ウェディングプランナー', 'parent_id' => 14],
            ['name' => 'ホテル・レジャー施設運営', 'parent_id' => 14],
            ['name' => 'コーディネーター・仲介（人材・ブライダルなど）', 'parent_id' => 14],
            ['name' => '翻訳・通訳', 'parent_id' => 14],
            ['name' => 'キャビンアテンダント', 'parent_id' => 14],
            ['name' => '調理師・パティシエ・キッチンスタッフ', 'parent_id' => 14],
            ['name' => '飲食ホールスタッフ', 'parent_id' => 14],
            ['name' => 'エステティシャン・ネイリスト・美容師', 'parent_id' => 14],
            ['name' => '整体士・マッサージ', 'parent_id' => 14],

            // サブカテゴリ（小売・運輸）
            ['name' => '販売', 'parent_id' => 15],
            ['name' => '店長・店舗開発・スーパーバイザー', 'parent_id' => 15],
            ['name' => 'パイロット', 'parent_id' => 15],
            ['name' => '運転手・セールスドライバー', 'parent_id' => 15],

            // サブカテゴリ（その他）
            ['name' => '警察官・消防士・自衛官', 'parent_id' => 16],
            ['name' => '行政事務・サービス職', 'parent_id' => 16],
            ['name' => '警備員', 'parent_id' => 16],
            ['name' => '学芸員・司書', 'parent_id' => 16],
            ['name' => '水産・農林・酪農・農園', 'parent_id' => 16],
            ['name' => 'その他', 'parent_id' => 16],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_categories');
    }
};
