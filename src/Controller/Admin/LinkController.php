<?php
// src/Controller/Admin/LinkController.php
namespace App\Controller\Admin;

use App\Entity\Links;
use App\Repository\LinksRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class LinkController extends Controller
{
    /**
     * 概览
     * @Route("/admin/link", name="admin_link")
     */
    public function link()
    {
        $datas = array();

        // 位置数据
        $sites = $this->siteData();

        return $this->render('admin/link/link.html.twig', ['datas' => $datas, 'sites' => $sites]);
    }

    /**
     * 博客
     * @Route("/admin/link/ajax", name="admin_link_ajax")
     * @Method("POST")
     */
    public function linkAjax(LinksRepository $links, Request $request)
    {
        $draw = $request->get('draw');
        $datas = $links->findAll();

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
     * @Route("/admin/link/edit/{id}", name="admin_link_edit", defaults={"id": "0"}, requirements={"id": "\d+"})
     */
    public function linkEdit($id)
    {
        if (!empty($id)) {
            $link = $this->getDoctrine()
                ->getRepository(Links::class)
                ->find($id);
        } else {
            $link = new Links();
        }
        // dump($link); exit();

        // 位置数据
        $sites = $this->siteData();

        return $this->render('admin/link/link_edit.html.twig', ['data' => $link, 'sites' => $sites]);
    }

    /**
     * 处理编辑/新增-分类
     *
     * @Route("/admin/link/edit/do", name="admin_link_edit_do")
     * @Method("POST")
     */
    public function blogEditDo(Request $request)
    {
        $id = $request->get('id');
        $type = $request->get('type');
        $sid = $request->get('site');
        $visible = $request->get('show');
        $name = $request->get('name');
        $url = $request->get('url');
        $img = $request->get('img');
        $notes = $request->get('notes');

        // id非空时为编辑
        if (!empty($id)) {
            $link = $this->getDoctrine()
                ->getRepository(Links::class)
                ->find($id);
        } else {
            $link = new Links();

            $link->setCtime(time());
        }
        // 赋值
        $link->setType($type);
        $link->setSid($sid);
        $link->setName($name);
        $link->setVisible($visible);
        $link->setUrl($url);
        $link->setImg($img);
        $link->setNotes($notes);
        // dump($link); exit();

        // 存储数据
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($link);
        $entityManager->flush();

        // 分类列表
        return $this->redirectToRoute('admin_link');
    }

    /**
     * 概览
     * @Route("/admin/link/site", name="admin_link_site")
     */
    public function site()
    {
        $data = $this->siteData();

        return $this->render('admin/link/site.html.twig', ['datas' => $data]);
    }

    /**
     * 广告位置数据
     */
    private function siteData()
    {
        return array(
            array(
                'id' => 1,
                'name' => '友情链接',
                'description' => '友情链接',
                'size' => '',
                'ctime' => '2018-05-27 18:00:00',
            ),
            array(
                'id' => 2,
                'name' => '首页Banner',
                'description' => '首页Banner',
                'size' => '',
                'ctime' => '2018-05-27 18:00:00',
            ),
            array(
                'id' => 3,
                'name' => '博客详情页001',
                'description' => '博客详情页右侧广告001',
                'size' => '298*48',
                'ctime' => '2018-05-27 18:00:00',
            ),
        );
    }

    /**
     * 删除-广告
     *
     * @Route("/admin/link/delete/{id}", name="admin_link_delete", defaults={"id": "0"}, requirements={"id": "\d+"})
     */
    public function linkDelete($id)
    {
        // dump($id); exit();
        if (!empty($id)) {
            $link = $this->getDoctrine()
                ->getRepository(Links::class)
                ->find($id);
            // dump($link); exit();

            // 删除数据
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($link);
            $entityManager->flush();
        }

        // 分类列表
        return $this->redirectToRoute('admin_link');
    }
}