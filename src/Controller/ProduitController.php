<?php

namespace App\Controller;

use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    /**
     * @Route("/add/{name}/{price}/{quantite}", name="add",requirements={"price"="\d+","quantite"="\d+"})
     */
    public function add($name,$price,$quantite): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $produit = new Produit();
        $produit->setName($name);
        $produit->setPrice($price);
        $produit->setQuantity($quantite);
        $produit->setDescription("c'est un bon produit.....");

        $entityManager->persist($produit);
        $entityManager->flush();

        return $this->render('produit/add.html.twig', [
            'name' => $name,'price'=>$price,'quantite'=>$quantite
        ]);
    }
    /**
     * @Route("/liste", name="liste")
     */
    public function liste(): Response
    {


        $products = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();

        if (!$products) {
            throw $this->createNotFoundException(
                'La table est vide '
            );
        }

        return $this->render('produit/liste.html.twig', ['produits'=>$products
           
        ]);
    }
    /**
     * @Route("/detail/{id}", name="detaliproduit")
     */
    public function detail(Produit $product): Response
    {


       /* $product = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'produit introuvable '
            );
        }*/

        return $this->render('produit/detail.html.twig', [
            'produit' => $product

        ]);
    }
    /**
     * @Route("/delete/{id}", name="deleteproduit")
     */
    public function delete($id): Response
    {


        $product = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->find($id);

        if (!$product) {
            throw $this->createNotFoundException(
                'produit introuvable '
            );
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($product);
        $entityManager->flush();
        return $this->redirectToRoute('liste');
    }
   
}
