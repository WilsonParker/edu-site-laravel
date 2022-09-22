<?php

namespace Database\Seeders;

use App\Models\Members\MemberTypesModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        /*$this->call([
            MigrationLectures::class,
        ]);
        return;*/

        if (MemberTypesModel::count() < 1) {
            $this->init();
        } else {
            $this->migration();
        }
    }

    private function init()
    {
        $this->call([
            AdminPermissionsSeeder::class,
            AdminPermissionTemplatesSeeder::class,
            AdminPermissionTemplatePivotSeeder::class,
//            MemberPermissionTemplatePivotSeeder::class,

            MemberTypesSeeder::class,

            ExamTypesSeeder::class,
            ExamStatusSeeder::class,
            EncourageStatusSeeder::class,

            LectureTypesSeeder::class,
            LectureCategoriesSeeder::class,
            BoardCategoriesSeeder::class,
            BoardTypesSeeder::class,
            BoardCategoryTypePivotSeeder::class,

            PaymentMethodsSeeder::class,
            CouponBenefitTypesSeeder::class,
            CouponConditionTypesSeeder::class,

            BannerTypesSeeder::class,
            PopUpTypeSeeder::class,
            LectureSurveyTypeSeeder::class,

            NBCTypeSeeder::class
        ]);
    }

    private function migration()
    {
        $this->call([

            // 회원, 강사, 관리자
            MigrationMembers::class,
            // 게시판
            MigrationBoards::class,
            // 자동문자 내용 설정, mms 문자내용
            MigrationSms::class,
            // 배너
            MigrationSite::class,
            // 강의
            MigrationLectures::class,
            // 결제
            MigrationLectures::class,
        ]);
    }
}
