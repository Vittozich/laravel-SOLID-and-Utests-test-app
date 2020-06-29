<?php

namespace Tests\Integration\Models;


use App\Models\Article;
use App\Models\Team;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function a_team_has_a_name()
    {
        $team = new Team(['name'=>'teamnumberone']);

        $this->assertEquals('teamnumberone',$team->name);
    }

    /** @test */
    public function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();

        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();


        $team->add($userOne);
        $team->add($userTwo);

        $this->assertEquals(2, $team->count());

    }

    /** @test */
    public function a_team_has_a_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $team->add($userOne);
        $team->add($userTwo);

        $this->assertEquals(2, $team->count());

        $userThree = factory(User::class)->create();
        $this->expectException('Exception');
        $this->expectExceptionMessage('team is full');
        $team->add($userThree);

    }

    /** @test  this is the regression test */
    public function when_adding_many_members_at_once_you_still_may_not_exceed_the_team_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $users = factory(User::class,3)->create();

        $this->expectException('Exception');
        $this->expectExceptionMessage('team is full');
        $team->add($users);

    }

    /** @test */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create();
        $users = factory(User::class,2)->create();

        $team->add($users);
        $this->assertEquals(2, $team->count());

    }



    /** @test */
    public function a_team_can_remove_a_member()
    {
        $team = factory(Team::class)->create(['size' => 3]);
        $users = factory(User::class,3)->create();

        $team->add($users);

        $team->remove($users[0]);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function a_team_can_remove_more_than_one_member_at_once()
    {
        $team = factory(Team::class)->create(['size' => 3]);
        $users = factory(User::class,3)->create();

        $team->add($users);

        $team->remove($users->slice(0,2)); //or removeMany()

        $this->assertEquals(1, $team->count());
    }

    /** @test */
    public function a_team_can_remove_all_methods_at_once()
    {

        $team = factory(Team::class)->create(['size' => 3]);
        $users = factory(User::class,3)->create();

        $team->add($users);

        $team->remove(); //or restart()

        $this->assertEquals(0, $team->count());

    }


}
