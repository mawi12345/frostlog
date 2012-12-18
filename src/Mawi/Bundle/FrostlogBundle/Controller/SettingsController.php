<?php
namespace Mawi\Bundle\FrostlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/settings")
 */
class SettingsController extends Controller
{
	
	/**
	 * @Route("/index", name="settings")
	 * @Template()
	 */
	public function indexAction()
	{
		return array();
	}
    
}
