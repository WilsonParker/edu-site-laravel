<?php


namespace App\Services\Hrd\Model;


use App\Services\Hrd\Traits\BindTraits;
use Illuminate\Contracts\Support\Arrayable;
use ReflectionClass;
use ReflectionProperty;

class HrdResponseItemModel implements Arrayable
{
    use BindTraits;

    public string $address = '';
    public string $courseMan = '';
    public string $contents = '';
    public string $grade = '';
    public string $imgGubun = '';
    public string $instCd = '';
    public string $ncsCd = '';
    public string $realMan = '';
    public string $regCourseMan = '';
    public string $subTitle = '';
    public string $subTitleLink = '';
    public string $superViser = '';
    public string $telNo = '';
    public string $title = '';
    public string $titleIcon = '';
    public string $titleLink = '';
    public string $traEndDate = '';
    public string $traStartDate = '';
    public string $trainTarget = '';
    public string $trainTargetCd = '';
    public string $trainstCstId = '';
    public string $trprDegr = '';
    public string $trprId = '';
    public string $yardMan = '';

    /**
     * HrdResponseItemModel constructor.
     * @param $data
     */
    public function __construct($data, public string $trainingGbn)
    {
        $this->bindArray($data);
    }

    protected function convertValue($data)
    {
        return is_array($data) ? implode(',', $data) : $data;
    }

    public function toArray(): array
    {
        $class = new ReflectionClass($this);
        return collect($class->getProperties(ReflectionProperty::IS_PUBLIC))
            ->mapWithKeys(function (ReflectionProperty $property) {
                return [$property->getName() => $this->{$property->getName()}];
            })->toArray();
    }
}
