<?php
// src/Controller/Blog/PublicController.php
namespace App\Controller\Blog;

use App\Repository\BlogRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicController extends Controller
{
    /**
     * 详情页相关文章
     */
    public function blogDetailAboutArticle(BlogRepository $blog)
    {
        $blogs = $blog->findBy(['cid' => 8], ['id' => 'DESC']);
        // dump($link); exit();

        return $this->render('blog/components/blog_detail_about_article.html.twig', ['datas' => $blogs]);
    }
}