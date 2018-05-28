<?php
// src/Controller/Blog/LinkController.php
namespace App\Controller\Blog;

use App\Entity\Links;
use App\Repository\LinksRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LinkController extends Controller
{
    /**
     * 博客详情页001
     * 博客详情页右侧广告001
     */
    public function blogDetailLink001(LinksRepository $links)
    {
        // $repository = $this->getDoctrine()->getRepository(Links::class);
        $link = $links->findOneBy(['sid' => 3], ['id' => 'DESC']);
        // dump($link); exit();

        return $this->render('blog/link/_001.html.twig', ['data' => $link]);
    }
}