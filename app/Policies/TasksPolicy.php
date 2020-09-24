<?php

namespace App\Policies;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TasksPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return false;
    }


    public function view(User $user, Tasks $tasks)
    {
        return true;
    }


    public function create(User $user)
    {
        return true;
    }


    public function update(User $user, Tasks $tasks)
    {
        if($this->isAdmin($user))return true;
        return $tasks->user_id == $user->id;
    }

    public function delete(User $user, Tasks $tasks)
    {
        if($this->isAdmin($user))return true;
        return $tasks->user_id == $user->id;
    }

    protected function isAdmin(User $user){
        if($user->user_type_id == 1){
            return true;
        }
        return false;
    }


}
