<?php

namespace Blog\Controllers;

use Blog\Core\View;
use App\Services\PostService;

/**
 * Controller class for handling post-related operations
 */
class PostController
{
    /**
     * @var PostService Instance of the PostService
     */
    private $postService;

    /**
     * Constructor for PostController
     * Initializes a new PostService instance
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Displays all posts
     * Retrieves all posts and renders the index view
     */
    public function index()
    {
        $posts = $this->postService->getAll();
        View::render('mainView.php', ['posts' => $posts]);
    }

    /**
     * Displays the create post form
     * Renders the create view
     */
    public function create()
    {
        View::render('posts/create.php');
    }

    /**
     * Stores a new post
     * Creates a new post with the submitted data and redirects to the homepage
     */
    public function store()
    {
        $this->postService->create($_POST);
        header('Location: /');
    }

    /**
     * Displays the edit post form
     * Finds the post by ID and renders the edit view with the post data
     */
    public function edit()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $post = $this->postService->find($id);
        if (!$post) {
            // Handle the case when the post is not found
            header('Location: /');
            exit;
        }
        View::render('posts/edit.php', ['post' => $post]);
    }

    /**
     * Updates an existing post
     * Updates the post with the submitted data and redirects to the homepage
     */
    public function update()
    {
        $this->postService->update($_POST);
        header('Location: /');
    }

    /**
     * Deletes a post
     * Deletes the post with the given ID and redirects to the homepage
     */
    public function delete()
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $this->postService->delete($id);
        header('Location: /');
    }
}
