<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\CategoriesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     */
    public function index()
    {
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoriesController',
        ]);
    }

    /**
     * @Route("/categories/create", name="categories_create")
     */
    public function create(Request $request)
    {
        $categories = new Categories;
        $form = $this->createForm(CategoriesType::class, $categories);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash(
                'success', 'Success! Category created!'
            );
            return $this->redirectToRoute('categories_create');
        } else {
         /*   $this->addFlash(
                'error', 'Smth went wrong!'
            );*/
        }

        return $this->render('categories/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
