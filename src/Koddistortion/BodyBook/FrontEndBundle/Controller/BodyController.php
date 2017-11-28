<?php
/*
 * This file is part of the PEC Platform boodybook-web.
 *
 * (c) PEC project engineers &amp; consultants
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\FrontEndBundle\Controller;

use Koddistortion\BodyBook\FrontEndBundle\Form\BodyStatType;
use Koddistortion\BodyBook\PlatformBundle\Entity\BodyStat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BodyController extends Controller {

	/**
	 * @Route(name="frontend_body_measures_add", path="/body/measures/add.html")
	 * @return Response
	 */
	public function addMeasureAction(Request $request): Response {
		$bodyStat = new BodyStat();
		$form = $this->createForm(BodyStatType::class, $bodyStat, array(
			'action' => $this->generateUrl('frontend_body_measures_add'),
		));

		$form->handleRequest($request);
		return $this->render('@KoddistortionBodyBookFrontEnd/Body/track_new_measure.html.twig', array(
			'form' => $form->createView()
		));
	}
	
}