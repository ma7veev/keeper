<?php namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;

/**
 * @ORM\Entity
 * @ORM\Table(name="operations")
 */
/**
 * @ORM\Entity(repositoryClass="App\Repository\OperationsRepository")
 */
class Operations
{
    const TYPE_DEFAULT = 1;

    const DIRECTION_INCOME = 1;
    const DIRECTION_OUTCOME = 2;



    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="integer")
     */
    private $amount;
    /**
     * @ORM\Column(type="integer")
     */
    private $type;
    /**
     * @ORM\Column(type="integer")
     */
    private $account;
    /**
     * @ORM\Column(type="integer")
     */
    private $category;
    /**
     * @ORM\Column(type="integer")
     */
    private $direction;
    /**
     * @ORM\Column(type="string", length=4)
     */
    private $currency;
    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId()
    {
        return $this->id;
    }

    public function getAmount(){
        return $this->amount;
    }

    public function getType(){
        return $this->type;
    }

    public function getAccount(){
        return $this->account;
    }

    public function getCategory(){
        return $this->category;
    }

    public function getDirection(){
        return $this->direction;
    }

    public function getCurrency(){
        return $this->currency;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setAmount($amount){
        $this->amount = $amount;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setAccount($account){
        $this->account = $account;
    }

    public function setCategory($category){
        $this->category = $category;
    }

    public function setDirection($direction){
        $this->direction = $direction;
    }

    public function setCurrency($currency){
        $this->currency = $currency;
    }

    public function setDescription($description){
        $this->description = $description;
    }

}