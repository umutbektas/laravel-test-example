<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{


    protected $fillable = [
        'name', 'size'
    ];

    public function add($users)
    {
        //guard
        $this->guardAgainstTooManyMember($this->extractNewUsersCount($users));


        $method = $users instanceof User ? 'save' : 'saveMany';

        $this->members()->$method($users);
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






    protected function removeMany($users)
    {
        $this->members()
            ->whereIn('id', $users->pluck('id'))
            ->update(['team_id' => null]);
    }



    protected function maximumTeamSize()
    {
        return $this->size;
    }



    protected function guardAgainstTooManyMember($newUsersCount)
    {

        $newTeamCount = $this->count() + $newUsersCount;

        if ($newTeamCount > $this->maximumTeamSize()) {
            throw new \Exception;
        }
    }



    protected function extractNewUsersCount($users)
    {
        return ($users instanceof User) ? 1 : count($users);
    }






}
