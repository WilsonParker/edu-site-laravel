<?php


namespace App\Models\Lectures;


use App\Models\Common\BaseModel;
use App\Models\Members\MemberLectureProgramModel;
use App\Models\Members\MembersModel;
use App\Models\Payments\PaymentsModel;
use App\Services\Payments\Contracts\Payable;
use Illuminate\Support\Carbon;
use LaravelSupports\Libraries\Supports\Date\DateHelper;

class LectureProgramModel extends BaseModel implements Payable
{
    protected $table = 'lecture_program';

    public function scopeNormal($query)
    {
        return $query->whereHas('normalType');
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LectureTypesModel::class, 'lecture_type_code', 'code');
    }

    public function normalType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->type()->where('code', 'normal');
    }

    public function nbcType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->type()->where('code', 'nbc');
    }

    public function lecture(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(LecturesModel::class);
    }

    public function normalInformation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LectureProgramNormalModel::class);
    }

    public function nbcInformation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LectureProgramNbcModel::class);
    }

    public function members(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(MembersModel::class, MemberLectureProgramModel::class);
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PaymentsModel::class);
    }

    public function getLearningStartDate(): \Carbon\Carbon
    {
        return match ($this->lecture_type_code) {
            'nbc' => $this->nbcInformation->study_start,
            'normal' => Carbon::createFromTimeString(now()->format('Y-m-d 00:00:00'))->copy(),
        };
    }

    public function getLearningEndDate(): \Carbon\Carbon
    {
        return match ($this->lecture_type_code) {
            'nbc' => $this->nbcInformation->study_end,
            'normal' => DateHelper::addDate($this->getLearningStartDate(), $this->learning_date_type, $this->learning_time)->copy(),
        };
    }

    public function getReviewStartDate(): \Carbon\Carbon
    {
        return $this->getLearningEndDate()->addDay();
    }

    public function getReviewEndDate(): \Carbon\Carbon
    {
        return DateHelper::addDate($this->getReviewStartDate(), $this->review_date_type, $this->review_time);
    }

    public function getTitle(): string
    {
        return $this->lecture->title;
    }

    public function getPrice(): int
    {
        return $this->lecture->price;
    }

    public function getDetailTitle(): string
    {
        return match ($this->lecture_type_code) {
            'normal' => $this->getTitle() . ' ' . date('Y') . '년 상시',
            'nbc' => $this->getTitle() . "{$this->nbcInformation->year}년 {$this->nbcInformation->number}기",
            default => $this->getTitle(),
        };
    }
}

