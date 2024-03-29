<?php

namespace Vicgonvt\Press\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Vicgonvt\Press\Post;
use Vicgonvt\Press\Tests\TestCase;

class SavePostTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_post_can_be_created_with_the_factory()
    {
        $post = factory(Post::class)->create();
        $this->assertCount(1, Post::all());
    }
}