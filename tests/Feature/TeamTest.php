<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Team;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

   /** @test */
    public function a_team_has_a_name()
    {
        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme', $team->name);

    }

    /** @test */
    public function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();
        $user_two = factory(User::class)->create();

        $team->add($user);
        $team->add($user_two);

        $this->assertEquals(2, $team->count());
    }


    /** @test */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create();

        $users = factory(User::class, 2)->create();

        $team->add($users);

        $this->assertEquals(2, $team->count());
    }

    
    /** @test */
    public function a_team_has_a_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $user = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $team->add($user);
        $team->add($userTwo);

        $this->assertEquals(2, $team->count());

        $this->expectException('Exception');

        $userThree = factory(User::class)->create();
        $team->add($userThree);
    }


    /** @test */
    public function a_team_can_remove_a_member()
    {

    }

    public function a_team_can_remove_all_members_at_once()
    {

    }
}
