<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Common\ResourceableModel;
use App\Models\Common\ResourcesModel;
use App\Models\Payments\PaymentItemsModel;
use App\Models\Sms\EncourageSmsModel;
use App\Models\Traits\ResourceTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class LecturesModel extends ResourceableModel
{
    protected $table = 'lectures';
    protected $types;

    /*public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureCategoriesModel::class, 'lecture_category_code', 'code');
    }*/

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(LectureCategoriesModel::class, LectureCategoryPivotModel::class);
    }

    public function information(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LectureInformationModel::class);
    }

    public function trialInformation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LectureTrialInformationModel::class);
    }

    public function books(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureBooksModel::class);
    }

    public function classes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureClassesModel::class);
    }

    public function programs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureProgramModel::class);
    }

    public function normalPrograms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->programs()->whereHas('normalType');
    }

    public function nbcPrograms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->programs()->whereHas('nbcType');
    }

    public function availableNbcPrograms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->programs()->whereHas('nbcType')->whereHas('nbcInformation', function ($query) {
            $now = Carbon::now();
            $query->whereDate('study_start', '>', $now);
        });
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureCompaniesModel::class);
    }

    public function subjectMatterExperts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(SubjectMatterExpertModel::class, LectureSubjectMatterExpertModel::class);
    }

    public function exams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureExamsModel::class);
    }

    public function middleExams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->exams()->where('kind', 'middle');
    }

    public function finalExams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->exams()->where('kind', 'final');
    }

    public function taskExams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->exams()->where('kind', 'task');
    }

    public function surveys(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureSurveysModel::class);
    }

    public function paymentItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PaymentItemsModel::class);
    }

    public function encourageSms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EncourageSmsModel::class);
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ResourcesModel::class, 'idx', 'image_idx');
    }

    public function studyMaterial(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ResourcesModel::class, 'idx', 'study_material_idx');
    }

    public function getMiddleExams(): \Illuminate\Support\Collection
    {
        return $this->filterExam('middle');
    }

    public function getFinalExams(): \Illuminate\Support\Collection
    {
        return $this->filterExam('final');
    }

    public function getTaskExams(): \Illuminate\Support\Collection
    {
        return $this->filterExam('task');
    }

    public function filterExam(string $type): \Illuminate\Support\Collection
    {
        return $this->exams->filter(fn($exam) => $exam->kind == $type);
    }

    public function hasMiddleExams(): bool
    {
        return $this->hasExam('middle');
    }

    public function hasFinalExams(): bool
    {
        return $this->hasExam('final');
    }

    public function hasTaskExams(): bool
    {
        return $this->hasExam('task');
    }

    public function hasExam(string $type): bool
    {
        return $this->exams->exists(fn($exam) => $exam->kind == $type);
    }

    /**
     * LectureTypesModel 를 제공 받습니다.
     *
     * @return Collection
     * @author  dev9163
     * @added   2021/10/12
     * @updated 2021/10/12
     */
    public function getTypes(): Collection
    {
        if (!isset($types)) {
            $this->types = $this->programs->map(fn($program) => $program->type)->unique(function ($type) {
                return $type->code;
            });
        }
        return $this->types;
    }

    public function getCategory(string $type = ''): LectureCategoriesModel
    {
        if ($this->categories->count() > 1) {
            return $this->categories->filter(fn($category) => $category->parent == $type);
        } else {
            return $this->categories->first();
        }
    }

    public function isNormalType(): bool
    {
        return $this->getTypes()->exists('normal');
    }

    public function isNBCType(): bool
    {
        return $this->getTypes()->exists('nbc');
    }

    /**
     *
     * @return string
     * @todo
     * 카테고리가 2개 이상일 경우 return 설정 필요
     * @author  WilsonParker
     * @added   2022/01/07
     * @updated 2022/01/07
     */
    public function getNCSTitle(): string
    {
        $category = $this->categories->first();
        return "{$category->name}({$category->number_code})";
    }

    public function getLeaningTermText(): string
    {
        return "{$this->learning_term}{$this->getLeaningTermUnit()}";
    }

    public function getLeaningTermUnit(): string
    {
        return match ($this->learning_term_type) {
            'years' => '년',
            'months' => '월',
            'days' => '일',
        };
    }

    /**
     * 최대 지원금
     *
     * @return int
     * @author  dev9163
     * @added   2021/10/01
     * @updated 2021/10/01
     */
    public function getMaxRefund(): int
    {
        return max([$this->refund_over, $this->refund_less, $this->refund_support, /*$this->worker_subsidy*/]);
    }

    /**
     * 수료 조건에 충족할 시험 수 제공
     *
     * @return int
     * @author  dev9163
     * @added   2021/10/13
     * @updated 2021/10/13
     */
    public function getExamCount(): int
    {
        return ($this->exam_reflection_rate > 0 ? 1 : 0) + ($this->evaluation_reflection_rate > 0 ? 1 : 0);
    }

    /**
     * model 에 맞는 hrd url 을 제공합니다
     *
     * @param LectureProgramModel|null $model
     * @return string
     * @author  dev9163
     * @added   2021/10/13
     * @updated 2021/10/13
     */
    public function getHrdUrl(LectureProgramModel $model = null): string
    {
        if (isset($this->hrd_url)) {
            $urlArray = parse_url($this->hrd_url);
            parse_str($urlArray['query'], $query_array);
            $model = $model ?? $this->availableNbcPrograms->first();
            if (isset($model)) {
                $query_array['tracseTme'] = $model->nbcInformation->number;
                return $urlArray['scheme'] . '://' . $urlArray['host'] . $urlArray['path'] . '?' . http_build_query($query_array);
            } else {
                return '';
            }
        } else {
            return '';
        }
    }

    /**
     * 내일배움카드 사용자의 결제 금액
     *
     * @return int
     * @author  dev9163
     * @added   2021/10/14
     * @updated 2021/10/14
     */
    public function getWorkerPrice(): int
    {
        return $this->tuition - $this->worker_subsidy;
    }

    public function getNormalProgram()
    {
        return $this->normalPrograms->first();
    }

    public function getResourcePath(): string
    {
        return '/lecture';
    }
}
