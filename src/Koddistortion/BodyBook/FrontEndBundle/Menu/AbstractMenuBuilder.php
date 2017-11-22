<?php
/*
 * This file is part of the Koddistortions BodyBook.
 *
 * (c) Oliver Kotte
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\FrontEndBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;

abstract class AbstractMenuBuilder {

	/** @var FactoryInterface */
	protected $factory;

	/**
	 * @var TokenStorageInterface
	 */
	protected $tokenStorage;

	/**
	 * @var AccessDecisionManagerInterface
	 */
	protected $accessDecisionManager;

	/**
	 * @param FactoryInterface               $factory
	 * @param TokenStorageInterface          $tokenStorage
	 * @param AccessDecisionManagerInterface $accessDecisionManager
	 */
	public function __construct(FactoryInterface $factory, TokenStorageInterface $tokenStorage, AccessDecisionManagerInterface $accessDecisionManager) {
		$this->factory = $factory;
		$this->tokenStorage = $tokenStorage;
		$this->accessDecisionManager = $accessDecisionManager;
	}

	public function isGranted(array $attributes, $object = null): bool {
		return $this->accessDecisionManager->decide($this->tokenStorage->getToken(), $attributes, $object);
	}
}