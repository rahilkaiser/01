<?php

namespace Tests\Repositories;

use Blog\Models\Post;
use Blog\Repositories\PostRepository;
use PHPUnit\Framework\TestCase;

class PostRepositoryTest extends TestCase
{
    private $postModel;
    private $postRepository;

    protected function setUp(): void
    {
        $this->postModel = $this->createMock(Post::class);
        $this->postRepository = new PostRepository($this->postModel);
    }

    public function testGetAll()
    {
        $posts = [
            ['id' => 1, 'title' => 'Test Post', 'content' => 'This is a test post.']
        ];

        $this->postModel->expects($this->once())
            ->method('all')
            ->willReturn($posts);

        $result = $this->postRepository->getAll();

        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals('Test Post', $result[0]['title']);
    }

    // Weitere Tests für find, create, update und delete Methoden...
}
