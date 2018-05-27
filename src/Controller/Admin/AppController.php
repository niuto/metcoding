<?php
// src/Controller/Admin/AppController.php
namespace App\Controller\Admin;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AppController extends Controller
{
    /**
     * 导航
     */
    public function nav(Request $request)
    {
        // nav menu
        $menus = array(
            'system' => array(
                'name' => '系统',
                'url' => '#',
                'status' => '0',
                'icon' => 'fa-desktop',
                'navs' => array(
                    'admin_home' => array(
                        'name' => '概览',
                        'url' => $this->generateUrl('admin_home'),
                        'status' => '0',
                    ),
                    'admin_setting' => array(
                        'name' => '设置',
                        'url' => $this->generateUrl('admin_setting'),
                        'status' => '0',
                    ),
                    'admin_category' => array(
                        'name' => '分类',
                        'url' => $this->generateUrl('admin_category'),
                        'status' => '0',
                    )
                )
            ),
            'blog' => array(
                'name' => '博客',
                'url' => '#',
                'status' => '0',
                'icon' => 'fa-edit',
                'navs' => array(
                    'admin_blog' => array(
                        'name' => '博客',
                        'url' => $this->generateUrl('admin_blog'),
                        'status' => '0',
                    ),
                    array(
                        'name' => '教程',
                        'url' => '###',
                        'status' => '0',
                    ),
                    array(
                        'name' => '问答',
                        'url' => '###',
                        'status' => '0',
                    ),
                    array(
                        'name' => '发现',
                        'url' => '###',
                        'status' => '0',
                    )
                )
            ),
            'link' => array(
                'name' => '广告',
                'url' => '#',
                'status' => '0',
                'icon' => 'fa-at',
                'navs' => array(
                    array(
                        'name' => '管理',
                        'url' => '###',
                        'status' => '0',
                    ),
                    array(
                        'name' => '位置',
                        'url' => '###',
                        'status' => '0',
                    )
                )
            )
        );

        // pathinfo
        $pathinfo = $request->get('pathinfo');
        $url = str_replace('/', '_', trim($pathinfo, '/'));
        // dump($url); exit();

        // 系统
        // 系统-概览
        if (in_array($url, ['admin_home'])) {
            $menus['system']['status'] = 1;
            $menus['system']['navs']['admin_home']['status'] = 1;
        }
        // 系统-设置
        if (in_array($url, ['admin_setting'])) {
            $menus['system']['status'] = 1;
            $menus['system']['navs']['admin_setting']['status'] = 1;
        }
        // 系统-分类
        if (preg_match('/admin_category/i', $url)) {
            $menus['system']['status'] = 1;
            $menus['system']['navs']['admin_category']['status'] = 1;
        }
        // 博客
        // 博客-博客
        if (preg_match('/admin_blog/i', $url)) {
            $menus['blog']['status'] = 1;
            $menus['blog']['navs']['admin_blog']['status'] = 1;
        }

        return $this->render('admin/components/nav.html.twig', ['menus' => $menus]);
    }

    /**
     * 概览
     * @Route("/admin/home", name="admin_home")
     */
    public function home(SessionInterface $session)
    {
        $session->set('testname', 'administrator');

        $name = $session->get('testname');
        // var_dump($name); exit();
        return $this->render('admin/home.html.twig');
    }

    /**
     * 设置
     *
     * @Route("/admin/setting", name="admin_setting")
     */
    public function setting()
    {
        return $this->render('admin/home.html.twig');
    }

    /**
     * 分类
     *
     * @Route("/admin/category", name="admin_category")
     */
    public function category(CategoryRepository $categorys)
    {
        $datas = $categorys->findAll();
        // var_dump($datas); exit();
        $formatDatas = $this->formatCategory($datas);
        // var_dump($formatDatas); exit();

        return $this->render('admin/system/category.html.twig', ['datas' => $formatDatas]);
    }

    /**
     * 编辑/新增-分类
     *
     * @Route("/admin/category/edit/{id}", name="admin_category_edit", defaults={"id": "0"}, requirements={"id": "\d+"})
     */
    public function categoryEdit(CategoryRepository $categorys, $id)
    {
        $datas = $categorys->findAll();
        // var_dump($datas); exit();
        $formatDatas = $this->formatCategory($datas);
        // var_dump($formatDatas); exit();
        if (!empty($id)) {
            $category = $this->getDoctrine()
                ->getRepository(Category::class)
                ->find($id);
        } else {
            $category = new Category();
        }
        // dump($category); exit();
        return $this->render('admin/system/category_edit.html.twig', ['categorys' => $formatDatas, 'data' => $category]);
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
     * @Route("/admin/category/edit/do", name="admin_category_edit_do")
     * @Method("POST")
     */
    public function categoryEditDo(Request $request)
    {
        $id = $request->get('id');
        $parentid = $request->get('parentid');
        $name = $request->get('name');
        $alias = $request->get('alias');
        $summary = $request->get('summary');

        // id非空时为编辑
        if (!empty($id)) {
            $category = $this->getDoctrine()
                ->getRepository(Category::class)
                ->find($id);
        } else {
            $category = new Category();
        }
        // 赋值
        $category->setParentid($parentid);
        $category->setName($name);
        $category->setAlias($alias);
        $category->setSummary($summary);
        // dump($category); exit();

        // 存储数据
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($category);
        $entityManager->flush();

        // 分类列表
        return $this->redirectToRoute('admin_category');
    }

    /**
     * 删除-分类
     *
     * @Route("/admin/category/delete/{id}", name="admin_category_delete", defaults={"id": "0"}, requirements={"id": "\d+"})
     */
    public function categoryDelete($id)
    {
        // dump($id); exit();
        if (!empty($id)) {
            $category = $this->getDoctrine()
                ->getRepository(Category::class)
                ->find($id);
            // dump($category); exit();

            // 删除数据
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($category);
            $entityManager->flush();
        }

        // 分类列表
        return $this->redirectToRoute('admin_category');
    }
}