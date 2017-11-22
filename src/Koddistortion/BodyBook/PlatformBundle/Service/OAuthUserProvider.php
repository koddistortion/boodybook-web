<?php
/*
 * This file is part of the Koddistortions BodyBook.
 *
 * (c) Oliver Kotte
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\PlatformBundle\Service;

use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Util\TokenGeneratorInterface;
use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\FacebookResourceOwner;
use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GoogleResourceOwner;
use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\TwitterResourceOwner;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\Exception\AccountNotLinkedException;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseFOSUBProvider;
use Koddistortion\BodyBook\PlatformBundle\Entity\User;

class OAuthUserProvider extends BaseFOSUBProvider {

	protected $tokenGenerator;

	public function __construct(UserManagerInterface $userManager, TokenGeneratorInterface $generator, array $properties) {
		parent::__construct($userManager, $properties);
		$this->tokenGenerator = $generator;
	}

	/**
	 * {@inheritdoc}
	 */
	public function loadUserByOAuthUserResponse(UserResponseInterface $response) {
		$username = $response->getUsername();

		$user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
		if(null === $user || null === $username) {
			switch(true) {
				case ($response->getResourceOwner() instanceof GoogleResourceOwner):
					$user = $this->createGoogleUser($response);
					break;
				case ($response->getResourceOwner() instanceof TwitterResourceOwner):
					$user = $this->createTwitterUser($response);
					break;
				case ($response->getResourceOwner() instanceof FacebookResourceOwner):
					$user = $this->createFacebookUser($response);
					break;
			}
		}
		if(null === $user || null === $username) {
			throw new AccountNotLinkedException(sprintf("User '%s' not found.", $username));
		}
		return $user;
	}

	protected function getOAuthUserName(UserResponseInterface $response) : string {
		return $response->getResourceOwner()->getName() . '_' . $response->getUsername();
	}

	protected function createUser(UserResponseInterface $response) : User {
		/** @var User $user */
		$user = $this->userManager->createUser();
		$user->setUsername($this->getOAuthUserName($response));
		$user->setEmail($response->getEmail());
		$user->setFirstName($response->getFirstName());
		$user->setLastName($response->getLastName());
		$user->setProfilePicture($response->getProfilePicture());
		$user->setPassword($response->getUsername());
		$user->setEnabled(true);
		return $user;
	}

	protected function createTwitterUser(UserResponseInterface $response) {
		$user = $this->createUser($response);
		$user->setFirstName($response->getRealName());
		$user->setTwitterId($response->getUsername());
		$user->setTwitterAccessToken($response->getAccessToken());
		$this->userManager->updateUser($user);
		return $user;
	}


	protected function createFacebookUser(UserResponseInterface $response) {
		$user = $this->createUser($response);
		$user->setFacebookId($response->getUsername());
		$user->setFacebookAccessToken($response->getAccessToken());
		$this->userManager->updateUser($user);
		return $user;
	}

	protected function createGoogleUser(UserResponseInterface $response) {
		$user = $this->createUser($response);
		$user->setGoogleId($response->getUsername());
		$user->setGoogleAccessToken($response->getAccessToken());
		$this->userManager->updateUser($user);
		return $user;
	}
}