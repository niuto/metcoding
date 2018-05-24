<?php
// src/Controller/LuckyController.php
namespace App\Controller\Admin;

use App\Entity\Blog;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublicController extends Controller
{
    /**
     * 首页
     */
    public function home()
    {
        return new Response(
            '<html><body><a href="/detail/1.html">1</a></body></html>'
        );
    }
}