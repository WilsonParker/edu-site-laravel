<?php

namespace App\ViewModels\Common;


class BasicComponentViewModel extends BaseViewModel
{
    const ROOT = 'layouts.components.';

    final protected function load()
    {
        $this->view = self::ROOT . $this->viewPrefix . '.' . $this->viewSuffix;
    }

}
