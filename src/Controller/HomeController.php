<?php

namespace App\Controller;
use App\Entity\Categories;
use App\Entity\Books;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {
/**
     * @Route("/", methods={"GET"})
     */

    public function index(){
        //return new Response('<html>Hello</html>');
    $categories= $this->getDoctrine()->getRepository(Categories::class)->findAll();
    $books= $this->getDoctrine()->getRepository(Books::class)->findAll();
    return $this->render('pages/index.html.twig',array('categories'=>$categories,'books'=>$books));
    
    }

    /**
     * @Route("/category/save")
     */

    public function save(){
        //return new Response('<html>Hello</html>');
    $entityManager= $this->getDoctrine()->getManager();
    $category= new Categories();
    $category->setCategory('Extra');
    $entityManager->persist($category);
    $entityManager->flush();

    return Response('Category saved.');
    }


}