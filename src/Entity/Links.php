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
     * 类型
     * @ORM\Column(type="smallint", options={"unsigned":"true", "default":"0"})
     */
    private $type;

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
     * @ORM\Column(type="string", columnDefinition="TINYINT(3) UNSIGNED NOT NULL DEFAULT '0'")
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
}
