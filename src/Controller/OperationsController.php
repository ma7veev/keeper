<?php

namespace App\Controller;

use App\Entity\Operations;
use App\Form\OperationsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class OperationsController extends AbstractController
{
    /**
     * @Route("/operations", name="operations")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $operations_rep = $entityManager->getRepository('App\Entity\Operations');
        $operations_list = $operations_rep->getOperationsList();
        return $this->render('operations/index.html.twig', [
            'controller_name' => 'OperationsController',
            'operations_list'=>$operations_list,
        ]);
    }

    /**
     * @Route("/", name="operations_create")
     */
    public function create(Request $request)
    {
        $operations = new Operations;
        $form = $this->createForm(OperationsType::class, $operations);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $operation = $form->getData();

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($operation);
             $entityManager->flush();
                $this->addFlash(
                    'success', 'Success! Operation created!'
                );
            return $this->redirectToRoute('operations_create');
        } else {

         /*   $this->addFlash(
                'error', 'Smth went wrong!'
            );*/
        }
        return $this->render('operations/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
