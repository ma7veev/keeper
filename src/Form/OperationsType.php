<?php

namespace App\Form;

use App\Entity\Operations;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperationsType extends AbstractType
{
    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $categories_rep = $this->em->getRepository('App\Entity\Categories');
        $operations_rep = $this->em->getRepository('App\Entity\Operations');
        $accounts_rep = $this->em->getRepository('App\Entity\Accounts');
        $categories_list = [
            'Outcome'=>Categories::makeList($categories_rep->getCategoriesOutcome() ),
            'Income'=>Categories::makeList($categories_rep->getCategoriesIncome() ),
        ];
        $builder
            ->add('amount', IntegerType::class)
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Default' => Operations::TYPE_DEFAULT,
                ] ])
            ->add('account_id', ChoiceType::class, [
                'choices' => $accounts_rep-> getAccountsList() ])
            ->add('category_id', ChoiceType::class, [
                'choices' => $categories_list])
         /*   ->add('direction',ChoiceType::class, [
                'choices' => $operations_rep->getDirectionsList() ])*/
           /* ->add('currency', ChoiceType::class, [
                'choices' => $accounts_rep-> getCurrenciesList() ])*/
            ->add('description', TextType::class)
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Operations::class,
        ]);
    }
}
