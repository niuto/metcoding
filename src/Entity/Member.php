<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="mc_member")
 * @ORM\Entity(repositoryClass="App\Repository\MemberRepository")
 */
class Member
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * 状态 [0 => 正常, 1 => 禁用]
     * @ORM\Column(type="integer", columnDefinition="TINYINT(3) UNSIGNED NOT NULL DEFAULT '0'")
     */
    private $status;

    /**
     * 会员等级
     * @ORM\Column(type="integer", columnDefinition="TINYINT(3) UNSIGNED NOT NULL DEFAULT '0'")
     */
    private $level;

    /**
     * 昵称
     * @ORM\Column(type="string", length=254)
     */
    private $nickname;

    /**
     * 手机号码
     * @ORM\Column(type="string", columnDefinition="CHAR(11) NOT NULL")
     */
    private $mobile;

    /**
     * 邮箱
     * @ORM\Column(type="string", length=254)
     */
    private $email;

    /**
     * 密码
     * @ORM\Column(type="string", columnDefinition="CHAR(32) NOT NULL")
     */
    private $password;

    /**
     * 明文密码
     * @ORM\Column(type="string", length=254)
     */
    private $pwd;

    /**
     * URL
     * @ORM\Column(type="string", length=254)
     */
    private $url;

    /**
     * 注册时间
     * @ORM\Column(type="integer", columnDefinition="INT(10) UNSIGNED NOT NULL DEFAULT '0'")
     */
    private $rtime;

    public function getId()
    {
        return $this->id;
    }
}
