<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * 登录
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // 已登录
        if (!empty($this->getUser())) {
            // 默认首页
            return $this->redirectToRoute('admin_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * 退出
     */
    public function logout()
    {
        throw new \Exception('This should never be reached!');
    }
}
