<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name','size'];

    public function add($user)
    {

        $this->guardAgainstTooManyMembers();

        $method = $user instanceof User ? 'save' : 'saveMany';

        if ($user instanceof User){
            return   $this->members()->$method($user);
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

    public function guardAgainstTooManyMembers()
    {
        if ($this->count() >= $this->size) {
            throw new \Exception('team is full');
        }
    }

}
