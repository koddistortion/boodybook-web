<?php
/*
 * This file is part of the PEC Platform BodyBook.
 *
 * (c) PEC project engineers &amp; consultants
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\PlatformBundle\Service\OAuth\Nokia;

use Buzz\Client\Curl;
use Doctrine\ORM\EntityManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\RequestDataStorageInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Http\HttpUtils;

class NokiaClientFactory {

	/** @var HttpUtils */
	protected static $httpUtils;

	/** @var Curl */
	protected static $httpClient;

	/** @var EntityManagerInterface */
	protected static $entityManager;

	/** @var RequestDataStorageInterface */
	protected static $storage;

	/** @var LoggerInterface */
	protected static $logger;

	public function __construct(RequestDataStorageInterface $storage, EntityManagerInterface $entityManager,
								LoggerInterface $logger, Curl $httpClient, HttpUtils $httpUtils) {
		self::$httpUtils = $httpUtils;
		self::$httpClient = $httpClient;
		self::$entityManager = $entityManager;
		self::$storage = $storage;
		self::$logger = $logger;
	}

	public static function createClient(TokenStorageInterface $tokenStorage): NokiaClient {
		$user = $tokenStorage->getToken() ? $tokenStorage->getToken()->getUser() : null;
		if($user) {
			$client = new NokiaClient(
				$user,
				self::$entityManager,
				self::$logger,
				self::$httpClient,
				self::$httpUtils,
				array(
					'client_id' => 'f66c93414d2d6ce969de977846b720bdcdb572e991952c4db6093c7d8890e2',
					'client_secret' => 'd399d89464b7de894716333128420949839b074c1584862129cb2513198b7',
					'request_token_url' => 'https://developer.health.nokia.com/account/request_token',
					'authorization_url' => 'https://developer.health.nokia.com/account/authorize',
					'access_token_url' => 'https://developer.health.nokia.com/account/access_token',
					'infos_url' => 'https://path.to/api/user',
					'realm' => 'read'),
				'nokia-withings',
				self::$storage
			);
			return $client;
		}
		throw new \InvalidArgumentException('There is no user logged in!');
	}
}