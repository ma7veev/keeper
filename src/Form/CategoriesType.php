<?php

namespace App\Form;

use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoriesType extends AbstractType
{
    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categories_rep = $this->em->getRepository('App\Entity\Categories');
        $categories_parent_list = [null=>0] + Categories::makeList($categories_rep->getCategoriesParent());

        $builder
            ->add('parent', ChoiceType::class, [
                'choices' => $categories_parent_list  ])
            ->add('name', TextType::class)
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Visible'  => Categories::STATUS_VISIBLE,
                    'Disabled' => Categories::STATUS_HIDDEN,
                ] ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Outcome'  => Categories::TYPE_OUTCOME,
                    'Income' => Categories::TYPE_INCOME,
                ] ])
            ->add('sort')
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categories::class,
        ]);
    }
}
