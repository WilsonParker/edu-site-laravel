<?php

namespace Database\Seeders;

use App\Models\Lectures\LectureCategoriesModel;
use Illuminate\Database\Seeder;

class LectureCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->parentStore('ncs', 'NCS 교육', null, 1, true, [
            $this->buildData('electric', '전기설비운영', '19010603', 0),
            $this->buildData('distribution', '유통관리', '02040304', 0),
            $this->buildData('tax', '세무', '02030202', 0),
            $this->buildData('public_welfare', '공공복지', '07010103', 0),
            $this->buildData('hospital', '병원행정', '06010201', 0),
            $this->buildData('hospital_information', '병원행정', '06010202', 0),
            $this->buildData('accounting', '회계·감사', '02030201', 0),
            $this->buildData('budget', '예산', '02030101', 0),
            $this->buildData('office', '사무행정', '02020302', 0),
            $this->buildData('personnel', '인사', '02020201', 0),
            $this->buildData('general_affairs', '총무', '02020101', 0),
            $this->buildData('statistics', '통계조사', '02010303', 0),
            $this->buildData('customer', '고객관리', '02010302', 0),
            $this->buildData('marketing', '마케팅전략기획', '02010301', 0),
            $this->buildData('ad', '광고', '02010202', 0),
            $this->buildData('business_planning', '경영기획', '02010101', 0),
            $this->buildData('project', '프로젝트관리', '01010102', 0),
            $this->buildData('labor', '노무관리', '02020202', 0),
            $this->buildData('legal_affairs', '법무', '05010101', 0),
        ]);

        $this->parentStore('semiconductor', '반도체 교육', null, 2, true, [
            $this->buildData('semiconductor_equipment', '반도체 장비', '19030603', 0),
            $this->buildData('semiconductor_produce', '반도체 제조', '19030602', 0),
            $this->buildData('semiconductor_development', '반도체 개발', '19030601', 0),
            $this->buildData('electric_storage_device', '전기저장장치개발', '19011201', 0),
        ]);

        $this->parentStore('it', 'IT 교육', null, 3, true, [
            $this->buildData('db', 'DB 엔지니어링', '20010204', 0),
            $this->buildData('block_chain', '블록체인 구축·운영', '20010802', 0),
            $this->buildData('sw', '응용SW 엔지니어링', '20010202', 0),
            $this->buildData('big_data', '빅데이터 분석', '20010105', 0),
            $this->buildData('information_technology', '정보기술 컨설팅', '20010102', 0),
        ]);

        $this->parentStore('certificate', '자격증 교육', null, 4, true, [
            $this->buildData('computerized', '전산회계1급', '', 0),
            $this->buildData('distribution_management', '유통관리사2급', '', 0),
            $this->buildData('electricity_technician', '전기기능사', '', 0),
            $this->buildData('social_welfare', '사회복지사1급', '', 0),
        ]);
    }

    private function parentStore(string $code, string $title, ?string $numberCode, int $sort, bool $public, $children)
    {
        $model = $this->store($code, null, $title, $numberCode, $sort, $public);
        collect($children)->each(fn($child) => $this->store($child['code'], $model->code, $child['name'], $child['number_code'], $child['sort'], $child['is_public']));
    }

    private function buildData(string $code, string $title, string $numberCode, int $sort, bool $public = true): array
    {
        return [
            'code' => $code,
            'name' => $title,
            'number_code' => $numberCode,
            'sort' => $sort,
            'is_public' => $public,
        ];
    }

    private function store(string $code, ?string $parent, string $title, ?string $numberCode, int $sort, bool $public = true)
    {
        return LectureCategoriesModel::create([
            'code' => $code,
            'parent' => $parent,
            'name' => $title,
            'number_code' => $numberCode,
            'sort' => $sort,
            'is_public' => $public,
        ]);
    }
}
