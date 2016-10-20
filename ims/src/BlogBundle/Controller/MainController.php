<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Comments;
use BlogBundle\Entity\Posts;
use BlogBundle\Form\Type\CommentType;
use BlogBundle\Form\Type\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class MainController extends Controller
{

    private $itemsLimit = 4;

    /**
     * @Route(
     *     "/{page}",
     *     name = "blog_index",
     *     defaults = {"page" = 1},
     *     requirements = {"page" = "\d+"}
     *  )
     */
    public function indexAction($page)
    {
        $PostsRepo = $this->getDoctrine()->getRepository('BlogBundle:Posts');

        $qb = $PostsRepo->getQueryBuilder(array(
            'orderBy' => 'p.createDate',
            'orderDir' => 'DESC'
        ));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $this->itemsLimit);

        return $this->render('BlogBundle:Pages:index.html.twig', array(
            'pagination' => $pagination
        ));
    }

    /**
     * @Route("/add-post", name = "blog_add")
     */
    public function addPost(Request $request)
    {
        $Post = new Posts();

        $postForm = $this->createForm(PostType::class, $Post);

        if($request->isMethod('POST'))
        {
            $postForm->handleRequest($request);

            if($postForm->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($Post);
                $em->flush();

                $redirectUrl = $this->generateUrl('blog_post', array(
                    'slug' => $Post->getSlug()
                ));

                return $this->redirect($redirectUrl);
            }
        }

        return $this->render('BlogBundle:Pages:addPost.html.twig', array(
            'postForm' => $postForm->createView()
        ));
    }

    /**
     * @Route(
     *     "/{slug}",
     *     name = "blog_post"
     *  )
     */
    public function postAction(Request $request, $slug)
    {
        $PostRepo = $this->getDoctrine()->getRepository('BlogBundle:Posts');

        $Post = $PostRepo->getPublishedPost($slug);

        if(null === $Post){
            throw $this->createNotFoundException('Post nie został odnaleziony');
        }

        $Comment = new Comments();
        $Comment->setPost($Post);

        $commentForm = $this->createForm(CommentType::class, $Comment);


        if($request->isMethod('POST'))
        {
            $commentForm->handleRequest($request);

            if($commentForm->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->persist($Comment);
                $em->flush();

                $redirectUrl = $this->generateUrl('blog_post', array(
                    'slug' => $Post->getSlug()
                ));

                return $this->redirect($redirectUrl);
            }
        }

        return $this->render('BlogBundle:Pages:post.html.twig', array(
            'post' => $Post,
            'commentForm' => $commentForm->createView()
        ));
    }

}
