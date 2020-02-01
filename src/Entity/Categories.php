<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManager;
use phpDocumentor\Reflection\Types\Self_;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
{
    const STATUS_HIDDEN = 0;
    const STATUS_VISIBLE = 1;

    const TYPE_OUTCOME = 1;
    const TYPE_INCOME = 2;



    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $parent_id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categories", inversedBy="products")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Categories", mappedBy="parent")
     */
    private $children;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $status = self::STATUS_VISIBLE ;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sort=9999;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function setParentId(?int $parent_id): self
    {

        $this->parent_id = $parent_id;

        return $this;
    }

    public function getParent(): ?Categories
    {
        return $this->parent;
    }

    public function setParent(?Categories $parent): self
    {
        $this->parent = $parent;

        return $this;
    }


    /**
     * @return Collection|Categories[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(?int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }


    public static function makeList($arr = [])
    {
        $list = [];
        foreach ($arr as $item) {
            $list[ $item[ 'name' ] ] = $item[ 'id' ];
        }

        return $list;
    }
}
