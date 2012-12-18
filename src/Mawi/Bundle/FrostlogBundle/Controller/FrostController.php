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
    	
    	$entities = $em->getRepository('MawiFrostlogBundle:Stock')->findStockGroups();
    	
    	return array(
    			'entities' => $entities,
    	);
    }
    
    /**
     * @Route("/productstock/{id}", name="productstock")
     * @Template()
     */
    public function productAction($id)
    {
        $em = $this->getDoctrine()->getManager();
    	
    	$entities = $em->getRepository('MawiFrostlogBundle:Stock')->findByProduct($id);
    	
        $product = $em->getRepository('MawiFrostlogBundle:Product')->find($id);
    	return array(
    			'entities' => $entities,
                'product' => $product,
    	);
    }
    
}
