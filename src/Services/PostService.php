<?php

namespace Blog\Services;

use Blog\Interfaces\PostRepositoryInterface;
class PostService
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * Creates a new post
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        try {
            return $this->postRepository->create($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    /**
     * Retrieves all posts
     * @return array
     */
    public function getAll(): array
    {
        try {
            return $this->postRepository->getAll();
        } catch (\Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    /**
     * Finds a post by its ID
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array
    {
        try {
            return $this->postRepository->find($id);
        } catch (\Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    /**
     * Updates an existing post
     * @param array $data
     * @return array
     */
    public function update(array $data): array
    {
        try {
            return $this->postRepository->update($data);
        } catch (\Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    /**
     * Deletes a post
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        try {
            return $this->postRepository->delete($id);
        } catch (\Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }
}
