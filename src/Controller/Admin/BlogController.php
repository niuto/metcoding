<?php
// src/Controller/Admin/BlogController.php
namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    /**
     * 博客
     * @Route("/admin/blog", name="admin_blog")
     */
    public function blog()
    {
        // $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        // $user = $this->getUser();
        // var_dump($user); exit();
        return $this->render('admin/blog/blog.html.twig');
    }
}