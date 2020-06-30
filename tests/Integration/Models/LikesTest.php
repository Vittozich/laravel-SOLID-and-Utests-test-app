<?php

namespace Tests\Integration\Models;


use App\Models\Article;
use App\Models\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikesTest extends TestCase
{
    use RefreshDatabase;

    protected $post;

    public function setUp() : void
    {
        parent::setUp();

//        $this->post = factory(Post::class)->create();
        $this->post = createPost();
        $this->signIn();
    }


    /** @test */
    public function a_user_can_like_a_post (){

        //given I have a post |
//        $this->post = factory(Post::class)->create();

        //and a user |
//        $user = factory(User::class)->create();

        //and that user is logged in |
//        $this->actingAs($user);


        //when they like a post |
        $this->post->like();

        //then wi should see evidence in the database, and the post should be liked.
        $this->assertDatabaseHas('likes' , [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);

        $this->assertTrue($this->post->isLiked());
    }

    /** @test */
    public function a_user_can_unlike_a_post()
    {

        $this->post->like();
        $this->post->unlike();

        $this->assertDatabaseMissing('likes' , [
            'user_id' => $this->user->id,
            'likeable_id' => $this->post->id,
            'likeable_type' => get_class($this->post)
        ]);

        $this->assertFalse($this->post->isLiked());
    }

    /** @test */
    public function a_user_may_toggle_a_posts_like_status()
    {

        $this->post->toggle();

        $this->assertTrue($this->post->isLiked());

        $this->post->toggle();

        $this->assertFalse($this->post->isLiked());

    }

    /** @test */
    public function a_post_knows_how_many_likes_it_has()
    {

        $this->post->toggle();

        $this->assertEquals(1,$this->post->likes_count);
    }
}
