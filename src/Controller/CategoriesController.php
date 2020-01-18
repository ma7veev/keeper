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
        $entityManager = $this->getDoctrine()->getManager();
        $categories_rep = $entityManager->getRepository('App\Entity\Categories');
        $categories_income = $categories_rep->getCategoriesIncome();
        $categories_outcome = $categories_rep->getCategoriesOutcome();
        $categories_parents =$categories_rep->getCategoriesParentsList();

        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoriesController',
            'categories_income' => $categories_income,
            'categories_outcome' => $categories_outcome,
            'categories_parents' => $categories_parents,
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
            if(!empty($category->parent_id)){

                $categories_rep = $entityManager->getRepository('App\Entity\Categories');
                $category->setParent($categories_rep->find($category->parent_id));
            }
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
