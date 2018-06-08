<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Forms;
use App\Entity\Post;
use App\Entity\Comment;

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
    public function post(Request $request, $id = null)
    {
        $post = $this->getDoctrine()
            ->getRepository(Post::class)
            ->find($id);

        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->getComments($id);

        if($post == null) {
            return new Response("Post doesn't exist");
        }

        $comment = new comment();
        $form = $this->createFormBuilder($comment)
            ->add('username', TextType::class, [
                'required' => true,
                'label' => 'Whats your name?',
                'attr' => ['class' => 'form-control mb-2']
            ])
            ->add('body', TextareaType::class, [
                'required' => true,
                'label' => 'What did you think about it?',
                'attr' => ['class' => 'form-control mb-2']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Post comment!',
                'attr' => ['class' => 'btn btn-primary mb-2']
            ])
            ->getForm();

        $form->handleRequest($request);

        // submits the form to the database and redirects
        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setDate(new \DateTime());
            $comment->setHostid($id);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirect("/post/".$id);
        }
        
        return $this->render('components/post_page.html.twig',
            [
                'post' => $post,
                'comments' => $comments,
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/createPost", name="create_post_page")
     */
    public function createPost(Request $request)
    {
        // builds a form
        $post = new Post();
        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Post title',
                'attr' => ['class' => 'form-control mb-2']
            ])
            ->add('body', TextareaType::class, [
                'required' => true,
                'label' => 'Post body',
                'attr' => ['class' => 'form-control mb-2']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Post item!',
                'attr' => ['class' => 'btn btn-primary mb-2']
            ])
            ->getForm();

        $form->handleRequest($request);
        
        // submits the form to the database and redirects
        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();
            $post->setDate(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('front_page');
        }

        return $this->render('components/create_post_page.html.twig',
        [ 'form' => $form->createView() ]);
    }
}

?>