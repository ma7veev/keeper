<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EntriesController extends AbstractController
{
    /**
     * @Route("/entries", name="entries")
     */
    public function index()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entries_rep = $entityManager->getRepository('App\Entity\Entries');
        $entries_list =$entries_rep->getAllList();

        return $this->render('entries/index.html.twig', [
            'controller_name' => 'EntriesController',
            'entries_list' => $entries_list,
        ]);
    }
}
