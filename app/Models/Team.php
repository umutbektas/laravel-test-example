<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{


    protected $fillable = [
        'name', 'size'
    ];




    public function add($user)
    {
        //guard
        $this->guardAgainstTooManyMember();


        $method = $user instanceof User ? 'save' : 'saveMany';

        $this->members()->$method($user);
    }



    public function remove($users)
    {
        if ($users instanceof User) {
            return $users->leaveTeam();
        }

        return $this->removeMany($users);

    /** Other way
        $users->each(function ($user) {
            $user->leaveTeam();
        });
     */

    }



    public function removeMany($users)
    {
        $this->members()
            ->whereIn('id', $users->pluck('id'))
            ->update(['team_id' => null]);
    }




    public function restart()
    {
        return $this->members()->update(['team_id' => null]);

    }

    public function members()
    {
        return $this->hasMany(User::class);
    }





    public function count()
    {
        return $this->members()->count();
    }





    public function guardAgainstTooManyMember()
    {
        if ($this->count() >= $this->size) {
            throw new \Exception;
        }
    }

}
