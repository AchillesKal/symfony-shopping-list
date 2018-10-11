<?php

namespace App\Controller;

use App\Repository\ShoppingListRepository;
use Knp\Component\Pager\PaginatorInterface;
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
    public function index(Security $security, Request $request, ShoppingListRepository $repository,  PaginatorInterface $paginator): Response
    {
        $q = $request->query->get('q');

        /* @var $currentUser User */
        $currentUser = $security->getUser();
        $queryBuilder = $repository->getWithSearchQueryBuilder($currentUser, $q);

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('app/index.html.twig', [
            'pagination' => $pagination
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
