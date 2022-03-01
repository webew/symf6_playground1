<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'truc' => 'Toto',
        ]);
    }
    
    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('main/about.html.twig');
    }

    #[Route('/test', name: 'app_test')]
    public function test(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $cat = new Categorie();
        $cat->setNom("Nouvelles technologies");
        $cat->setDescription("La catégorie consacrée aux nouvelles technologies.");

        $entityManager->persist($cat);

        $entityManager->flush();
        

        return $this->render('main/test.html.twig');
    }

    #[Route('/voirCategories', name: 'app_voir_categories')]
    public function voirCategories(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll(); // $categories contient un array d'objets de type Categorie
        // dd($categories);

        foreach($categories as $categorie){
            dump($categorie->getNom());
        }

        return $this->render('main/voirCategories.html.twig', ["categories" => $categories]);
    }
}
