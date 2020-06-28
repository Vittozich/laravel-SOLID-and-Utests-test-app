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

        $this->expectException('Exception');
        $this->expectExceptionMessage('team is full');
        $userThree = factory(User::class)->create();
        $team->add($userThree);

    }

    /** @test */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create();
        $users = factory(User::class,2)->create();

        $team->add($users);
        $this->assertEquals(2, $team->count());

    }


    //todo complete all methods
    /** @test */
    public function a_team_can_remove_a_member()
    {

    }

    /** @test */
    public function a_team_can_remove_all_methods_at_once()
    {

    }


}
