<?php

namespace Tests\Controllers;

use Blog\Controllers\PostController;
use Blog\Services\PostService;
use PHPUnit\Framework\TestCase;

class PostControllerTest extends TestCase
{
    private $postService;
    private $postController;

    protected function setUp(): void
    {
        $this->postService = $this->createMock(PostService::class);
        $this->postController = new PostController($this->postService);
    }

    public function testIndex()
    {
        $posts = [
            ['id' => 1, 'title' => 'Test Post', 'content' => 'This is a test post.']
        ];

        $this->postService->expects($this->once())
            ->method('getAllPosts')
            ->willReturn($posts);

        $result = $this->postController->index();

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals('Test Post', $result[0]['title']);
    }

    // Weitere Tests für create, store, edit, update und delete Methoden...
}
