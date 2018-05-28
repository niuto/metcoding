<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mc_links")
 * @ORM\Entity(repositoryClass="App\Repository\LinksRepository")
 */
class Links
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 类型 [0 => 文本, 1 => 本地图片, 3 => 远程图片]
     * @ORM\Column(type="smallint", options={"unsigned":"true", "default":"0"})
     */
    private $type;

    /**
     * 位置 [site id]
     * @ORM\Column(type="smallint", options={"unsigned":"true", "default":"0"})
     */
    private $sid;

    /**
     * 名称
     * @ORM\Column(type="string", length=254)
     */
    private $name;

    /**
     * URL
     * @ORM\Column(type="string", length=254)
     */
    private $url;

    /**
     * 备注
     * @ORM\Column(type="string", length=254)
     */
    private $notes;

    /**
     * 图片
     * @ORM\Column(type="string", length=254)
     */
    private $img;

    /**
     * 是否显示
     * @ORM\Column(type="smallint", columnDefinition="TINYINT(3) UNSIGNED NOT NULL DEFAULT '0'")
     */
    private $visible;

    /**
     * 创建时间
     * @ORM\Column(type="integer", columnDefinition="INT(10) UNSIGNED NOT NULL DEFAULT '0'")
     */
    private $ctime;

    public function getId()
    {
        return $this->id;
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

    public function getSid(): ?int
    {
        return $this->sid;
    }

    public function setSid(int $sid): self
    {
        $this->sid = $sid;

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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getVisible(): ?int
    {
        return $this->visible;
    }

    public function setVisible(int $visible): self
    {
        $this->visible = $visible;

        return $this;
    }

    public function getCtime(): ?int
    {
        return $this->ctime;
    }

    public function setCtime(int $ctime): self
    {
        $this->ctime = $ctime;

        return $this;
    }
}
