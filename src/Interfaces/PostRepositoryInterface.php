<?php

namespace Blog\Interfaces;

interface PostRepositoryInterface
{
    /**
     * Create a new post
     * @param array $data
     * @return array
     */
    public function create(array $data): array;

    /**
     * Get all posts
     * @return array
     */
    public function getAll(): array;

    /**
     * Find a post by ID
     * @param int $id
     * @return array|null
     */
    public function find(int $id): ?array;

    /**
     * Update an existing post
     * @param array $data
     * @return array
     */
    public function update(array $data): array;

    /**
     * Delete a post
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}