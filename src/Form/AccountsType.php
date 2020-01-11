<?php

namespace App\Form;

use App\Entity\Accounts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountsType extends AbstractType
{


    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Accounts::class,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $accounts_rep = $this->em->getRepository('App\Entity\Accounts');
        $accounts_list = $accounts_rep->getaccountsList();

        $builder
            ->add('type', ChoiceType::class, [
                'choices' => ['Default'=>0]  ])
            ->add('name', TextType::class)
            ->add('amount_start', IntegerType::class)
            ->add('currency', ChoiceType::class, [
             'choices' => $accounts_rep->getCurrenciesList() ])
            ->add('save', SubmitType::class);
    }
}
