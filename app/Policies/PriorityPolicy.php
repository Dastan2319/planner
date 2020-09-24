<?php

namespace App\Policies;

use App\Models\Priority;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PriorityPolicy
{
    use HandlesAuthorization;

    protected function allPriority(User $user){
        return $user->user_type_id == 1;
    }

    public function viewAny(User $user)
    {
        return $this->allPriority($user);
    }


    public function view(User $user)
    {
        return $this->allPriority($user);
    }


    public function create(User $user)
    {
        return $this->allPriority($user);
    }


    public function update(User $user)
    {
        return $this->allPriority($user);
    }


    public function delete(User $user)
    {
        return $this->allPriority($user);
    }


}
