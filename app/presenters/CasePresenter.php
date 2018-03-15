<?php

namespace App\Presenters;


class CasePresenter extends BasePresenter
{
    public function renderDefault()
    {
        $this->template->anyVariable = 'any value';
    }
}
