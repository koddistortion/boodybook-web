<?php

namespace Koddistortion\BodyBook\FrontEndBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DashboardController extends Controller {

	/**
	 * @Route(name="homepage", path="/")
	 */
	public function indexAction() {
		return $this->render('KoddistortionBodyBookFrontEndBundle:Default:index.html.twig');
	}
}
