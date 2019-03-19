<?php

namespace Tests\Feature\Models;

use App\Models\User;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function a_user_can_like_a_post()
    {
        $post = factory(Post::class)->create();

        $user = factory(User::class)->create();

        $this->actingAs($user);

        $post->like();

        $this->assertDatabaseHas('likes', [
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

        $this->assertDatabaseMissing('likes', [
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

        $this->assertEquals(1, $post->likesCount);
    }
}
