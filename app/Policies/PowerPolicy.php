<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
class PowerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function show(User $user){
        return $user->super_user === 'Y' || $user->super_user === 'N';
    }

    public function useAllBtn(User $user){
        return $user->super_user === 'Y';
    }

    public function useManager(User $user){
        return $user->super_user === 'Y';
    }
}
