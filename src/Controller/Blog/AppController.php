<?php
// src/Controller/LuckyController.php
namespace App\Controller\Blog;

use App\Entity\Blog;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AppController extends Controller
{
    /**
     * 博客列表
     *
     * @Route("/blog.{_format}", name="blog", defaults={"_format": "html"})
     */
    public function list()
    {
        return new Response(
            '<html><body><a href="/detail/1.html">1</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/detail/2.html">2</a></body></html>'
        );
    }

    /**
     * 博客详情页
     *
     * @Route(
     *     "/detail/{id}.{_format}",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "id": "\d+",
     *         "_format": "html"
     *     }
     * )
     */
    public function detail(Blog $blog): Response
    {
        return $this->render('blog/detail.html.twig', ['data' => $blog]);
    }
}