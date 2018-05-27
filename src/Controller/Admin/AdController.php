<?php
// src/Controller/Admin/AdController.php
namespace App\Controller\Admin;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdController extends Controller
{
    /**
     * 概览
     * @Route("/admin/ad/site")
     */
    public function site()
    {
        $data = $this->siteData();

        return $this->render('admin/ad/site.html.twig', ['datas' => $data]);
    }

    private function siteData()
    {
        return array(
            array(
                'id' => 1,
                'name' => '博客详情页',
                'description' => '博客详情页右侧广告001',
                'ctime' => '2018-05-27 18:00:00',
            ),
        );
    }
}