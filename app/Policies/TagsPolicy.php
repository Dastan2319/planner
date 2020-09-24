<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tags;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagsPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        return true;
    }


    public function view(User $user, Tags $tags)
    {
        return true;
    }


    public function create(User $user)
    {
        if ($user->user_type_id == 1){
            return true;
        }
        return false;
    }


    public function update(User $user, Tags $tags)
    {
        if ($user->user_type_id == 1){
            return true;
        }
        return false;
    }


    public function delete(User $user, Tags $tags)
    {
        if ($user->user_type_id == 1){
            return true;
        }
        return false;
    }


}
