<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Post;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="front_page")
     * @Route("/page/{pageCount}")
     */
    public function index($pageCount = 1)
    {
        $posts = $this->getDoctrine()
        ->getRepository(Post::class)
        ->getPosts($pageCount);

        return $this->render('components/index.html.twig',
            ['posts' => $posts,'pageCount' => $pageCount]
        );
    }


    /**
     * @Route("/post/{id}", name="post_page")
     */
    public function post($id = null)
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->find($id);

        if($post == null) {
            return new Response("Post doesn't exist");
        }
        
        return $this->render('components/post_page.html.twig',
            ['post' => $post]
        );
    }
}

?>