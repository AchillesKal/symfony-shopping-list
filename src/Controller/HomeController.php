<?php

namespace App\Controller;

use App\Repository\ShoppingListRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(ShoppingListRepository $shoppingListRepository)
    {
        return $this->render('app/index.html.twig', ['shopping_lists' => $shoppingListRepository->findAll()]);
    }

    /**
     * @Route("/about", name="aboutpage")
     */
    public function about()
    {
        return $this->render('about.html.twig');
    }
}
