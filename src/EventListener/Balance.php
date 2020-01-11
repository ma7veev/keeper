<?php

namespace App\EventListener;

namespace App\EventListener;

use App\Entity\Entries;
use App\Entity\Operations;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

class Balance
{
    protected $em;

    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    public function postPersist(Operations $operation)
    {
        $entry = new  Entries;
        $entry->setAmount($operation->getAmount());

        $accounts_rep = $this->em->getRepository('App\Entity\Accounts');
        $account = $accounts_rep->find($operation->getAccountId());
        $entry->setAmountBefore($account->getAmount());
        $direction = $operation->getDirection();
        $amount_after = 0;
        if($direction == Operations::DIRECTION_INCOME){
            $amount_after = $entry->getAmountBefore() + $entry->getAmount();
        } else {
            $amount_after = $entry->getAmountBefore() - $entry->getAmount();
        }

        $entry->setAmountAfter($amount_after);
        $entry->setOperationId($operation->getId());
        $entry->setAccountId($operation->getAccountId());
        $this->em->persist($entry);
        $this->em->flush($entry);
        $account->setAmount($amount_after);
        $this->em->flush();
    }
}