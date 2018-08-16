<?php

namespace App\Controller;

use App\Repository\ShoppingListRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Security;
use App\Entity\User;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Security $security
     * @return Response
     */
    public function index(Security $security, Request $request, ShoppingListRepository $repository): Response
    {
        $q = $request->query->get('q');

        /* @var $currentUser User */
        $currentUser = $security->getUser();
        $userShoppingLists = $repository->findAllShoppingListsByUser($currentUser, $q);

        return $this->render('app/index.html.twig', [
            'shopping_lists' => $userShoppingLists
        ]);
    }

    /**
     * @Route("/about", name="aboutpage")
     */
    public function about()
    {
        return $this->render('about.html.twig');
    }
}
