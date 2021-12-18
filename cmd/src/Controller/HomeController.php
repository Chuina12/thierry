<?php

namespace App\Controller;

use App\Entity\Stock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

/**
 * @Route("/inscription", name="inscription")
 */
    public function inscription()
    {
        return $this->render("home/inscription.html.twig");
    }

/**
 * @Route("/save", name="save")
 */
    public function save(Request $request)
    {
        $datas = $request->request->All();
        $stock = new stock();
        $stock->setNom($datas['nom']);
        $stock->setDateajout(new \Datetime());
        $stock->setPrix($datas['prix']);
        $stock->setDescription($datas['description']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($stock);
        $em->flush();
        return new Response('ok');

    }

/**
 * @Route("/affiche", name="affiche")
 */
    public function affiche()
    {
        $Repository = $this->getDoctrine()->getRepository(Stock::class);
        $stocks = $Repository->findAll();
        return $this->render("home/affiche.html.twig", [
            "stocks" => $stocks,
        ]);

    }

    /**
     * @Route("suppression{id}",name="suppression")
     */
    public function suppression($id)
    {

        $Repository = $this->getDoctrine()->getRepository(Stock::class);
        $stock = $Repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($stock);
        $em->flush();
        return new Response("ok");
    }

    /**
     *@Route("modication{id}", name="modification")
     */
    public function modification($id)
    {
        $Repository = $this->getDoctrine()->getRepository(Stock::class);
        $stock = $Repository->find($id);
        return $this->render("home/recuper_donne_a_modifir.html.twig", ['stock' => $stock]);

    }

    /**
     *@Route("save_update{id}", name="save_update")
     */
    public function save_update(Request $request, $id)
    {
        $Repository = $this->getDoctrine()->getRepository(Stock::class);
        $nom = $request->request->get('nom');
        $prix = $request->request->get('prix');
        $description = $request->request->get('description');
        $stock = $Repository->find($id);
        $em = $this->getDoctrine()->getManager();
        $stock->SetNom($nom);
        $stock->SetPrix($prix);
        $stock->SetDescription($description);
        $em->flush();

        return new Response("ok");

    }

    /**
     * @Route("thierry", name="thierry")
     */
    public function thierry()
    {
        return $this->render("home/test.html.twig");
    }

















    
}
