<?php


namespace App\Services\Hrd\Traits;


trait BindTraits
{

    protected function bindArray(array $data)
    {
        foreach (get_object_vars($this) as $key => $value) {
            if (isset($data[$key])) {
                $this->$key = $this->convertValue($data[$key]);
            }
        }
    }

    protected function convertValue($data) {
        return $data;
    }
}
