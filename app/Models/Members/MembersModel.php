<?php


namespace App\Models\Members;


use App\Models\Boards\BoardAnswersModel;
use App\Models\Boards\BoardsModel;
use App\Models\Common\BaseModel;
use App\Models\Lectures\CartsModel;
use App\Models\Lectures\LectureClassesModel;
use App\Models\Lectures\LectureExamSubmitsModel;
use App\Models\Lectures\LectureProgramModel;
use App\Models\Lectures\LecturesModel;
use App\Models\Lectures\LectureSurveySubmitsModel;
use App\Models\Payments\PaymentsModel;
use App\Models\Sms\SmsModel;
use App\Services\Payments\Contracts\PayableMember;
use App\Traits\Auth\CredentialsCryptTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class MembersModel extends BaseModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, PayableMember
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail, HasFactory, Notifiable, CredentialsCryptTrait;

    protected $with = ['memberInformation'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'pw',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pw',
        'remember_token',
    ];

    protected $table = 'members';

    public function buildScope($query, string $code) {
        return $query->whereHas('type', function ($subQuery) use($code) {
            $subQuery->where('code', $code);
        });
    }

    public function scopeNormal($query)
    {
        return $this->buildScope($query, 'member');
    }

    public function scopeTutor($query)
    {
        return $this->buildScope($query, 'tutor');
    }

    public function scopeAdmin($query)
    {
        return $this->buildScope($query, 'admin');
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(MemberTypesModel::class, MemberTypePivotModel::class);
    }

    public function memberInformation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MemberInformationModel::class);
    }

    public function tutorInformation(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TutorInformationModel::class);
    }

    public function learningLecturePrograms(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        $now = now();
        return $this->lecturePrograms()->where('learning_start_date', '<=', $now)->where('learning_end_date', '>', $now);
    }

    public function endedLecturePrograms(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->lecturePrograms()->where('learning_end_date', '<', now());
    }

    public function lecturePrograms(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(LectureProgramModel::class, MemberLectureProgramModel::class)->withPivot(['learning_start_date', 'learning_end_date', 'review_end_date']);
    }

    public function memberLecturePrograms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MemberLectureProgramModel::class);
    }

    public function availableMemberLecturePrograms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        $now = now();
        return $this->memberLecturePrograms()->whereDate('learning_start_date', '<=', $now)->whereDate('learning_end_date', '>', $now);
    }

    public function lectureClasses(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(LectureClassesModel::class, MemberLectureClassesModel::class);
    }

    public function lectureExams(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MemberExamsModel::class);
    }

    public function lectureMiddleExam(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->lectureExams()->where('exam_type_code', 'middle');
    }

    public function lectureFinalExam(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->lectureExams()->where('exam_type_code', 'final');
    }

    public function lectureTaskExam(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->lectureExams()->where('exam_type_code', 'task');
    }

    public function lectureExamSubmits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureExamSubmitsModel::class);
    }

    public function lectureSurveySubmits(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LectureSurveySubmitsModel::class);
    }

    public function boardAnswers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BoardAnswersModel::class);
    }

    public function boards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BoardsModel::class);
    }

    public function qnaBoards(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->boards()->where('board_category_code', 'question');
    }

    public function payments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PaymentsModel::class)->orderBy('created_at', 'desc');
    }

    public function sms(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SmsModel::class);
    }

    public function carts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CartsModel::class);
    }

    public function cartLectures(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(LecturesModel::class, CartsModel::class);
    }

    public function memberPush(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MemberPushModel::class);
    }

    public function getLectures()
    {
        return $this->lecturePrograms->map(fn($item) => $item->lecture);
    }

    public function getEmail(): string
    {
        return $this->memberInformation->email;
    }

    public function getName(): string
    {
        return $this->memberInformation->name;
    }

    public function getContact(): string
    {
        return $this->memberInformation->phone_number;
    }

    public function getAddress(): string
    {
        return $this->memberInformation->address . ' ' . $this->memberInformation->detail_address;
    }

    public function getZipCode(): string
    {
        return $this->memberInformation->zip_code;
    }
}
