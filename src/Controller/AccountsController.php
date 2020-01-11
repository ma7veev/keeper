<?php

namespace App\Controller;

use App\Entity\Accounts;
use App\Form\AccountsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AccountsController extends AbstractController
{
    /**
     * @Route("/accounts", name="accounts")
     */
    public function index()
    {
        return $this->render('accounts/index.html.twig', [
            'controller_name' => 'AccountsController',
        ]);
    }


    /**
     * @Route("/accounts/create", name="accounts_create")
     */
    public function create(Request $request)
    {
        $accounts = new Accounts();
        $form = $this->createForm(AccountsType::class, $accounts);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash(
                'success', 'Success! Account created!'
            );
        } else {
            /*   $this->addFlash(
                   'error', 'Smth went wrong!'
               );*/
        }

        return $this->render('accounts/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
