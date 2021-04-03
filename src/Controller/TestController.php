<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function test(): Response
    {
        $tab=["ali","mohamed","amina","amani"];
        $reponse = $this->render('test/index.html.twig', ["liste"=>$tab    ]);
        return $reponse;
    }

    /**
     * @Route("/test2", name="test2")
     */
    public function test2(): Response
    {
        return $this->render('test/index2.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    /**
     * @Route("/notes", name="notes")
     */
    public function notes(SessionInterface $session): Response
    {
        $prenom=$session->get('prenom');
        $notes=[12,10,15,14,16,18,20,5];
        return $this->render('test/notes.html.twig', [
            'tabnotes' => $notes,'prenom'=>$prenom
        ]);
    }
    /**
     * @Route("/bonjour/{nom}", name="bonjour")
     */
    public function bonjour($nom="toto"): Response
    {
        $name = strtoupper($nom);
        return $this->render('test/bonjour.html.twig', [
            'name' => $name,
        ]);
    }
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request,SessionInterface $session): Response
    {
        $session->set('prenom', 'lotfi');
        //return $this->redirect('http://symfony.com/doc');
        //dd($request);
        $routeName = $request->attributes->get('_route');
      
        return $this->render('test/default.html.twig',['route'=>$routeName]);
    }

}
