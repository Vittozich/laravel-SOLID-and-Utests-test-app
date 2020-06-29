<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($user)
    {

        $this->guardAgainstTooManyMembers();

        $method = $user instanceof User ? 'save' : 'saveMany';

        if ($user instanceof User) {
            return $this->members()->$method($user);
        }

        $this->members()->$method($user);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    public function remove($users = null)
    {

        if (is_null($users)) return $this->restart();

        if ($users instanceof User) return  $users->leaveTeam();

        $this->removeMany($users);

    }

    public function removeMany($users){

        //todo template
        // slow methods
//        $users->each(function ($user){
//            $user->leaveTeam();
//        });

        return $this->members()
            ->whereIn('id',$users->pluck('id'))->update(['team_id'=>null]);
    }

    public function restart()
    {
        return  $this->members()->update(['team_id' => null]);
    }

    //local methods

    protected function guardAgainstTooManyMembers()
    {
        if ($this->count() >= $this->size) {
            throw new \Exception('team is full');
        }
    }

}
