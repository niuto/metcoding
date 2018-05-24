<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mc_category")
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 父类ID
     * @ORM\Column(type="smallint", options={"unsigned":"true", "default":"0"})
     */
    private $parentid;

    /**
     * 分类名称
     * @ORM\Column(type="string", length=254)
     */
    private $name;

    /**
     * 别名
     * @ORM\Column(type="string", length=254)
     */
    private $alias;

    /**
     * 概述
     * @ORM\Column(type="string", length=254)
     */
    private $summary;

    public function getId()
    {
        return $this->id;
    }

    public function getParentid(): ?int
    {
        return $this->parentid;
    }

    public function setParentid(int $parentid): self
    {
        $this->parentid = $parentid;

        return $this;
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

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }
}
