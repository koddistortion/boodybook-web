<?php
/*
 * This file is part of the Koddistortions BodyBook.
 *
 * (c) Oliver Kotte
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\FrontEndBundle\Controller;

use Koddistortion\BodyBook\PlatformBundle\Entity\User;
use Koddistortion\BodyBook\PlatformBundle\Service\OAuth\Nokia\NokiaClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserController extends Controller {

	/**
	 * @Route(name="frontend_user_profile", path="/user/show/{user}.html")
	 * @param User $user
	 * @return Response
	 */
	public function showProfileAction(User $user): Response {
		return $this->render('@KoddistortionBodyBookFrontEnd/User/profile.html.twig', array(
			'user' => $user
		));
	}

	/**
	 * @Route(name="frontend_user_nokia_connect", path="/user/nokia/connect/{user}.html")
	 * @param User $user
	 * @return RedirectResponse
	 */
	public function connectNokiaAction(User $user): RedirectResponse {
		$authUrl = $this->getNokiaClient()->getAuthorizationUrl($this->getNokiaAuthCallbackUri($user));
		return $this->redirect($authUrl);
	}

	/**
	 * @Route(name="frontend_user_nokia_connect_check", path="/user/nokia/check/{user}.html")
	 * @param Request $request
	 * @param User    $user
	 * @return RedirectResponse
	 */
	public function checkConnectNokiaAction(Request $request, User $user): RedirectResponse {
		$this->getNokiaClient()->getAccessToken($request, $this->getNokiaAuthCallbackUri($user));
		return $this->redirectToRoute('homepage');
	}

	/**
	 * @Route(name="frontend_user_nokia_body_measures", path="/user/nokia/measures/{user}.html")
	 */
	public function getBodyMeasuresAction() {
		$lastUpdated = \DateTime::createFromFormat('Y-m-d', '2017-11-22');
		$measures = $this->getNokiaClient()->getBodyMeasures($lastUpdated);
		return new JsonResponse($measures, 200, array(), true);
	}

	/**
	 * @return NokiaClient
	 * @throws \Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException
	 * @throws \Symfony\Component\DependencyInjection\Exception\ServiceCircularReferenceException
	 */
	protected function getNokiaClient(): NokiaClient {
		return $this->container->get(NokiaClient::class);
	}

	/**
	 * @param User $user
	 * @return string
	 */
	protected function getNokiaAuthCallbackUri(User $user): string {
		return $this->generateUrl('frontend_user_nokia_connect_check', array('user' => $user->getId()), UrlGeneratorInterface::ABSOLUTE_URL);
	}

}