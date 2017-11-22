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
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller {

	/**
	 * @Route(name="frontend_user_profile", path="/user/show/{user}.html")
	 */
	public function showProfileAction(User $user) {
		return $this->render('@KoddistortionBodyBookFrontEnd/User/profile.html.twig', array(
			'user' => $user
		));
	}

}