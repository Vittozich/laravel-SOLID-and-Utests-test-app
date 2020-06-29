<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add($users)
    {

        $this->guardAgainstTooManyMembers($users);

        $method = $users instanceof User ? 'save' : 'saveMany';

        if ($users instanceof User) {
            return $this->members()->$method($users);
        }

        $this->members()->$method($users);
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

        return $this->members()
            ->whereIn('id',$users->pluck('id'))->update(['team_id'=>null]);
    }

    public function restart()
    {
        return  $this->members()->update(['team_id' => null]);
    }

    public function maximumSize()
    {
        return $this->size;
    }

    //local methods

    protected function guardAgainstTooManyMembers($users)
    {
        $numUsersToAdd = ($users instanceof User) ? 1 : count($users);
        $newTeamCount = $this->count() + $numUsersToAdd;
        if ($newTeamCount > $this->maximumSize()) {
            throw new \Exception('team is full');
        }
    }

}
