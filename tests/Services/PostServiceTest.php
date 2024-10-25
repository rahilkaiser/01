<?php

namespace Tests\Services;

use Blog\Repositories\PostRepository;
use Blog\Services\PostService;
use PHPUnit\Framework\TestCase;

class PostServiceTest extends TestCase
{
    private $postRepository;
    private $postService;

    protected function setUp(): void
    {
        $this->postRepository = $this->createMock(PostRepository::class);
        $this->postService = new PostService($this->postRepository);
    }

    public function testGetAllPosts()
    {
        $posts = [
            ['id' => 1, 'title' => 'Test Post', 'content' => 'This is a test post.']
        ];

        $this->postRepository->expects($this->once())
            ->method('getAll')
            ->willReturn($posts);

        $result = $this->postService->getAllPosts();

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals('Test Post', $result[0]['title']);
    }

    // Weitere Tests für createPost, updatePost und deletePost Methoden...
}
