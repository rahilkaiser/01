<?php

namespace Blog\Repositories;

use Blog\Models\Post;
use Blog\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    /**
     * @var Post
     */
    private $postModel;

    /**
     * PostRepository constructor.
     * @param Post $postModel
     */
    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * Create a new post
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        $id = $this->postModel->create($data);
        return $this->find($id);
    }

    /**
     * Get all posts
     * @return array
     */
    public function getAll(): array
    {
        return $this->postModel->getAll();
    }

    /**
     * Find a post by ID
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array
    {
        return $this->postModel->find($id) ?: null;
    }

    /**
     * Update an existing post
     * @param array $data
     * @return array
     */
    public function update(array $data): array
    {
        $id = $data['id'] ?? null;
        if (!$id) {
            throw new \InvalidArgumentException('Post ID is required for update');
        }
        $success = $this->postModel->update($id, $data);
        if (!$success) {
            throw new \RuntimeException('Failed to update post');
        }
        return $this->find($id);
    }

    /**
     * Delete a post
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->postModel->delete($id);
    }
}
