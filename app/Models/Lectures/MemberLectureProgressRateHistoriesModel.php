<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Models\Members\MembersModel;
use Awobaz\Compoships\Compoships;

class MemberLectureProgressRateHistoriesModel extends BaseModel
{
    use Compoships;

    protected $table = 'member_lecture_progress_rate_histories';

    public function memberLectureProgram(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MemberLectureProgramModel::class);
    }

    public function lectureClass(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureClassesModel::class);
    }

    public function member(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MembersModel::class);
    }

    public function memberLectureProgressRecord(): \Awobaz\Compoships\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MemberLectureProgressRecordsModel::class, ['member_lecture_program_idx', 'lecture_class_idx'], ['member_lecture_program_idx', 'lecture_class_idx']);
    }

    /**
     * 이전 내역 중 하나를 가져 옵니다
     * @return MemberLectureProgressRateHistoriesModel
     * @author  dev9163
     * @added   2021/11/23
     * @updated 2021/11/23
     */
    public function getPreviousHistory(): self
    {
        return self::with(['lectureClass'])->where([
            'member_lecture_program_idx' => $this->member_lecture_program_idx,
            'lecture_class_idx' => $this->lectureClass->getPreviousLectureClass()->idx,
        ])->first();
    }

    public static function createModel(MemberLectureProgramModel $memberLectureProgramModel, LectureClassesModel $lectureClassesModel)
    {
        $model = self::firstOrNew([
            'member_lecture_program_idx' => $memberLectureProgramModel->idx,
            'lecture_class_idx' => $lectureClassesModel->idx,
            // 'member_idx' => $membersModel->idx,
            'end' => null,
        ]);
        $model->access_ip = request()->ip();
        $model->start = now();
        $model->save();
        return $model;
    }

    /**
     * MembersModel 과 LectureProgramModel 에 해당하는 내역을 가져 옵니다.
     *
     * @param MemberLectureProgramModel $memberLectureProgramModel
     * @return array|\Illuminate\Database\Eloquent\Collection
     * @author  dev9163
     * @added   2021/11/23
     * @updated 2021/11/23
     */
    public static function getHistories(MemberLectureProgramModel $memberLectureProgramModel): array|\Illuminate\Database\Eloquent\Collection
    {
        return self::getHistoriesQuery($memberLectureProgramModel)->get();
    }

    public static function getHistoriesWithNumber(MemberLectureProgramModel $memberLectureProgramModel, int $number): array|\Illuminate\Database\Eloquent\Collection
    {
        return self::getHistoriesQuery($memberLectureProgramModel)
            ->whereHas('lectureClass', function ($query) use ($number) {
                return $query->where('number', $number);
            })
            ->get();
    }

    private static function getHistoriesQuery(MemberLectureProgramModel $memberLectureProgramModel): \Illuminate\Database\Eloquent\Builder
    {
        return self::with(['lectureClass', 'memberLectureProgram.lectureProgram'])->where([
            'member_lecture_program_idx' => $memberLectureProgramModel->idx,
        ])->whereNotNull('end');
    }

}
