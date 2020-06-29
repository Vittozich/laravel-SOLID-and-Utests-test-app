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


    /** @test */
    public function a_user_can_like_a_post (){

        //given I have a post |
        $post = factory(Post::class)->create();

        //and a user |
        $user = factory(User::class)->create();

        //and that user is logged in |
        $this->actingAs($user);

        //when they like a post |
        $post->like();

        //then wi should see evidence in the database, and the post should be liked.
        $this->assertDatabaseHas('likes' , [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertTrue($post->isLiked());
    }

    /** @test */
    public function a_user_can_unlike_a_post()
    {


        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $post->like();
        $post->unlike();

        $this->assertDatabaseMissing('likes' , [
            'user_id' => $user->id,
            'likeable_id' => $post->id,
            'likeable_type' => get_class($post)
        ]);

        $this->assertFalse($post->isLiked());
    }

    /** @test */
    public function a_user_may_toggle_a_posts_like_status()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $post->toggle();

        $this->assertTrue($post->isLiked());

        $post->toggle();

        $this->assertFalse($post->isLiked());

    }

    /** @test */
    public function a_post_knows_how_many_likes_it_has()
    {
        $post = factory(Post::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $post->toggle();

        $this->assertEquals(1,$post->likes_count);
    }
}
