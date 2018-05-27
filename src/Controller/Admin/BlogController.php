<?php
// src/Controller/Admin/BlogController.php
namespace App\Controller\Admin;

use App\Entity\Blog;
use App\Repository\BlogRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BlogController extends Controller
{
    /**
     * 博客
     * @Route("/admin/blog", name="admin_blog")
     */
    public function blog()
    {
        return $this->render('admin/blog/blog.html.twig');
    }

    /**
     * 博客
     * @Route("/admin/blog/ajax", name="admin_blog_ajax")
     * @Method("POST")
     */
    public function blogAjax(BlogRepository $blogs, Request $request)
    {
        $draw = $request->get('draw');
        $datas = $blogs->findAll();

        $data = array(
            'draw' => $draw,
            'recordsTotal' => 2,
            'recordsFiltered' => 2,
            'data' => $datas,
        );

        return $this->json($data);
    }

    /**
     * 博客
     * @Route("/admin/blog/edit/{id}", name="admin_blog_edit", defaults={"id": "0"}, requirements={"id": "\d+"})
     */
    public function blogEdit(CategoryRepository $categorys, $id)
    {
        if (!empty($id)) {
            $blog = $this->getDoctrine()
                ->getRepository(Blog::class)
                ->find($id);
        } else {
            $blog = new Blog();
        }
        // dump($blog); exit();

        // 分类
        $category = $this->formatCategory($categorys->findAll());
        // dump($category); exit();

        return $this->render('admin/blog/blog_edit.html.twig', ['data' => $blog, 'categorys' => $category]);
    }

    /**
     * 组装分类数据
     */
    private function formatCategory($datas)
    {
        // var_dump($datas); exit();
        // 循环分类
        function getPathName($parentid, &$data, $pathName = '')
        {
            for ($j = 0; $j < count($data); $j++) {
                if ($data[$j]->getId() == $parentid) {
                    $pathName = $data[$j]->getName().'->'.$pathName;
                    if (!empty($data[$j]->getParentid())) {
                        return getPathName($data[$j]->getParentid(), $data, $pathName);
                    }
                    break;
                }
            }

            return substr($pathName, 0, -2);
        }
        // 组装数据
        for ($i = 0; $i < count($datas); $i++) {
            if (!empty($datas[$i]->getParentid())) {
                $datas[$i]->pathName = getPathName($datas[$i]->getParentid(), $datas);
            }
        }

        return $datas;
    }

    /**
     * 处理编辑/新增-分类
     *
     * @Route("/admin/blog/edit/do", name="admin_blog_edit_do")
     * @Method("POST")
     */
    public function blogEditDo(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $cid = $request->get('category');
        $title = $request->get('title');
        $excerpt = $request->get('excerpt');
        $content = $request->get('content');
        $views = $request->get('views');
        $status = 0;
        $mid = 0;

        // id非空时为编辑
        if (!empty($id)) {
            $blog = $this->getDoctrine()
                ->getRepository(Blog::class)
                ->find($id);

            $blog->setMtime(time());
        } else {
            $blog = new Blog();

            $blog->setMtime(time());
            $blog->setCtime(time());
        }
        // 赋值
        $blog->setType($type);
        $blog->setCid($cid);
        $blog->setTitle($title);
        $blog->setExcerpt($excerpt);
        $blog->setContent($content);
        $blog->setViews($views);
        $blog->setMid($mid);
        $blog->setStatus($status);
        // $blog->setMtime(time());
        // $blog->setCtime(time());
        // dump($blog); exit();

        // 存储数据
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($blog);
        $entityManager->flush();

        // 分类列表
        return $this->redirectToRoute('admin_blog');
    }

    /**
     * 删除-分类
     *
     * @Route("/admin/blog/delete/{id}", name="admin_blog_delete", defaults={"id": "0"}, requirements={"id": "\d+"})
     */
    public function blogDelete($id)
    {
        return true;
    }
}