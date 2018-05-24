<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mc_blog")
 * @ORM\Entity(repositoryClass="App\Repository\BlogRepository")
 */
class Blog
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned":"true"})
     */
    private $id;

    /**
     * 标题
     * @ORM\Column(type="string", length=254)
     */
    private $title;

    /**
     * 分类
     * @ORM\Column(type="smallint", options={"unsigned":"true", "default":"0"})
     */
    private $cid;

    /**
     * 类型 [0 => DB, 1 => File]
     * @ORM\Column(type="smallint", options={"unsigned":"true", "default":"0"})
     */
    private $type;

    /**
     * 作者/发布者
     * @ORM\Column(type="smallint", columnDefinition="MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0'")
     */
    private $mid;

    /**
     * 摘要
     * @ORM\Column(type="string", length=1000)
     */
    private $excerpt;

    /**
     * 正文
     * @ORM\Column(type="text", columnDefinition="TEXT NOT NULL")
     */
    private $content;

    /**
     * 浏览量
     * @ORM\Column(type="integer", columnDefinition="MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0'")
     */
    private $views;

    /**
     * 状态 [0 => 开启/显示, 1 => 关闭/隐藏, 2 => 付费/VIP]
     * @ORM\Column(type="integer", columnDefinition="TINYINT(3) UNSIGNED NOT NULL DEFAULT '0'")
     */
    private $status;

    /**
     * 修改时间
     * @ORM\Column(type="integer", columnDefinition="INT(10) UNSIGNED NOT NULL DEFAULT '0'")
     */
    private $mtime;

    /**
     * 创建时间
     * @ORM\Column(type="integer", columnDefinition="INT(10) UNSIGNED NOT NULL DEFAULT '0'")
     */
    private $ctime;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCid(): ?int
    {
        return $this->cid;
    }

    public function setCid(int $time): self
    {
        $this->cid = $cid;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $time): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMid(): ?int
    {
        return $this->mid;
    }

    public function setMid(int $time): self
    {
        $this->mid = $mid;

        return $this;
    }

    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    public function setExcerpt(string $time): self
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $time): self
    {
        $this->content = $content;

        return $this;
    }

    public function getViews(): ?int
    {
        return $this->views;
    }

    public function setViews(int $time): self
    {
        $this->views = $views;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $time): self
    {
        $this->status = $status;

        return $this;
    }

    public function getMtime(): ?int
    {
        return $this->mtime;
    }

    public function setMtime(int $time): self
    {
        $this->mtime = $mtime;

        return $this;
    }
}
