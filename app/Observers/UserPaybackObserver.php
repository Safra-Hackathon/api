<?php

namespace App\Observers;

use App\Entities\UserPayback;
use App\Entities\UserPaybackHistory;

class UserPaybackObserver
{
    /**
     * Grava linha no histórico quando houver o evento created do modelo UserPayback.
     *
     * @param UserPayback $userPayback
     * @return void
     */
    public function created(UserPayback $userPayback)
    {
        UserPaybackHistory::create($userPayback->toArray());
    }

    /**
     * Grava linha no histórico quando houver o evento updated do modelo UserPayback.
     *
     * @param UserPayback $userPayback
     * @return void
     */
    public function updated(UserPayback $userPayback)
    {
        UserPaybackHistory::create($userPayback->toArray());
    }
}
