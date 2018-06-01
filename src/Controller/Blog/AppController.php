<?php
// src/Controller/AppController.php
namespace App\Controller\Blog;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AppController extends Controller
{
    /**
     * 首页
     *
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig');
    }

    /**
     * 博客
     *
     * @Route("/blog.{_format}", name="blog", defaults={"_format": "html"})
     */
    public function blog(BlogRepository $blog)
    {
        // $blogs = $blog->findOneBy(['sid' => 3], ['id' => 'DESC']);
        $blogs = $blog->findAll();

        return $this->render('blog/blog.html.twig', ['datas' => $blogs]);
    }

    /**
     * 博客详情页
     *
     * @Route(
     *     "/detail/{id}.{_format}",
     *     name="detail",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "id": "\d+",
     *         "_format": "html"
     *     }
     * )
     */
    public function detail(Blog $blog)
    {
        return $this->render('blog/detail.html.twig', ['data' => $blog]);
    }
}