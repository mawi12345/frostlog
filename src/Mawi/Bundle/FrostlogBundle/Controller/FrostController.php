<?php
namespace Mawi\Bundle\FrostlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class FrostController extends Controller
{
    /**
     * @Route("/index", name="home")
     * @Template()
     */
    public function frostAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	
    	$entities = $em->getRepository('MawiFrostlogBundle:Stock')->findAll();
    	
    	return array(
    			'entities' => $entities,
    	);
    }
    
}
