<?php
namespace Mawi\Bundle\FrostlogBundle\Controller;

use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Yaml\Parser;
use Symfony\Component\Yaml\Exception\ParseException;

class FrontController extends Controller
{
    /**
     * @Route("/", name="front")
     * @Template("MawiFrostlogBundle::layout.html.twig")
     */
    public function frontAction()
    {
        return array();
    }
    
    /**
     * @Route("/check", name="ajax_login_check")
     */
    public function indexAction()
    {
    	if (false === $this->get('security.context')->isGranted(
    			'IS_AUTHENTICATED_FULLY'
    	)) {
    		return new Response('NOT AUTHENTICATED');
    	}
    	$token = $this->get('security.context')->getToken();
    	if ($token) {
    		$user = $token->getUser();
    		if ($user) {
    			return new Response('OK');
    			
    		} else {
    			return new Response('NO USER');
    		}
    	}
    	return new Response('NO TOKEN');
    }
    
    public function loginPageAction()
    {
    	$request = $this->getRequest();
    	$session = $request->getSession();
    
    	// get the login error if there is one
    	if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
    		$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    	} else {
    		$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
    		$session->remove(SecurityContext::AUTHENTICATION_ERROR);
    	}
    
    	return $this->render('MawiFrostlogBundle:Front:login.html.twig', array(
    			// last username entered by the user
    			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
    			'error'         => $error,
    	));
    }
    
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
    	return $this->render('MawiFrostlogBundle::layout.html.twig', array(
    			// last username entered by the user
    			'content' => 'MawiFrostlogBundle:Front:loginPage',
    	));
    }
    
    /**
     * @Route("/login/done", name="login_done")
     */
    public function loginDoneAction()
    {
    	return new Response('DONE');
    }
    
    /**
     * @Route("/login/fail", name="login_fail")
     */
    public function loginFailAction()
    {
    	return new Response('FAIL');
    }
    
    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {

    }
    
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    
    }
    
}
