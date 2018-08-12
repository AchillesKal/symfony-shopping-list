<?php

namespace App\Controller;

use App\Entity\ShoppingList;
use App\Form\ShoppingListType;
use App\Repository\ShoppingListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/shopping/list")
 */
class ShoppingListController extends Controller
{
    /**
     * @Route("/", name="shopping_list_index", methods="GET")
     */
    public function index(ShoppingListRepository $shoppingListRepository): Response
    {
        return $this->render('shopping_list/index.html.twig', ['shopping_lists' => $shoppingListRepository->findAll()]);
    }

    /**
     * @Route("/new", name="shopping_list_new", methods="GET|POST")
     */
    public function new(Request $request, Security $security): Response
    {
        $shoppingList = new ShoppingList();
        $form = $this->createForm(ShoppingListType::class, $shoppingList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $currentUser = $security->getUser();
            $shoppingList->setOwner($currentUser);
            $em->persist($shoppingList);
            $em->flush();

            return $this->redirectToRoute('shopping_list_index');
        }

        return $this->render('shopping_list/new.html.twig', [
            'shopping_list' => $shoppingList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shopping_list_show", methods="GET")
     */
    public function show(ShoppingList $shoppingList): Response
    {
        return $this->render('shopping_list/show.html.twig', ['shopping_list' => $shoppingList]);
    }

    /**
     * @Route("/{id}/edit", name="shopping_list_edit", methods="GET|POST")
     */
    public function edit(Request $request, ShoppingList $shoppingList): Response
    {
        $form = $this->createForm(ShoppingListType::class, $shoppingList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('shopping_list_edit', ['id' => $shoppingList->getId()]);
        }

        return $this->render('shopping_list/edit.html.twig', [
            'shopping_list' => $shoppingList,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="shopping_list_delete", methods="DELETE")
     */
    public function delete(Request $request, ShoppingList $shoppingList): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoppingList->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($shoppingList);
            $em->flush();
        }

        return $this->redirectToRoute('shopping_list_index');
    }
}
