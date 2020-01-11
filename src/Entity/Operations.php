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

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt(new \DateTime);
    }

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
    private $account_id;
    /**
     * @ORM\Column(type="integer")
     */


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Accounts", mappedBy="operation")
     */
    private $account;

    private $category_id;
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


    /**
     * @ORM\Column(type="date")
     */
    private $created_at;

    /**
     * @ORM\Column(type="date")
     */
    private $updated_at;




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

    public function getAccountId(){
        return $this->account_id;
    }
    public function getAccount(): ?Accounts
    {
        return $this->account;
    }

    public function getCategoryId(){
        return $this->category_id;
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

    public function setAccountId($account){
        $this->account_id = $account;
    }

    public function setCategoryId($category){
        $this->category_id = $category;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

}