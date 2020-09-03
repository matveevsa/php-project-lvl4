<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class LabelPolicy
{
    use HandlesAuthorization;

    public function create()
    {
        return Auth::check();
    }

    public function update()
    {
        return Auth::check();
    }

    public function delete()
    {
        return Auth::check();
    }
}
