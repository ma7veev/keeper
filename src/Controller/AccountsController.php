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
        $entityManager = $this->getDoctrine()->getManager();
        $accounts_rep = $entityManager->getRepository('App\Entity\Accounts');
        $accounts_list = $accounts_rep->findAll();

        return $this->render('accounts/index.html.twig', [
            'controller_name' => 'AccountsController',
            'accounts_list' => $accounts_list,
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
            $account = $form->getData();
            $account->setAmount($account->getAmountStart());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($account);
            $entityManager->flush();

            $this->addFlash(
                'success', 'Success! Account created!'
            );
            return $this->redirectToRoute('accounts_create');
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
