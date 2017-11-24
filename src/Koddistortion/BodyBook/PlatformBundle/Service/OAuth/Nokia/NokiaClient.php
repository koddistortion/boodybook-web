<?php
/*
 * This file is part of the PEC Platform boodybook-web.
 *
 * (c) PEC project engineers &amp; consultants
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\PlatformBundle\Service\OAuth\Nokia;

use Buzz\Client\ClientInterface as HttpClientInterface;
use Buzz\Message\RequestInterface as HttpRequestInterface;
use Doctrine\ORM\EntityManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\RequestDataStorageInterface;
use HWI\Bundle\OAuthBundle\OAuth\ResourceOwner\GenericOAuth1ResourceOwner;
use HWI\Bundle\OAuthBundle\Security\OAuthUtils;
use Koddistortion\BodyBook\PlatformBundle\Entity\User;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\HttpUtils;

class NokiaClient extends GenericOAuth1ResourceOwner {

	const URL_GET_MEASURES = 'https://api.health.nokia.com/measure?action=getmeas';

	/** @var User */
	protected $user;

	/** @var EntityManagerInterface */
	protected $entityManager;

	/** @var LoggerInterface */
	protected $logger;

	public function __construct(User $user, EntityManagerInterface $entityManager, LoggerInterface $logger,
								HttpClientInterface $httpClient, HttpUtils $httpUtils,
								array $options, $name, RequestDataStorageInterface $storage) {
		parent::__construct($httpClient, $httpUtils, $options, $name, $storage);
		$this->user = $user;
		$this->entityManager = $entityManager;
		$this->logger = $logger;
	}

	public function getAccessToken(Request $request, $redirectUri, array $extraParameters = array()) {
		$token = parent::getAccessToken($request, $redirectUri, $extraParameters);
		$this->user->setNokiaAccessToken($token['oauth_token']);
		$this->user->setNokiaAccessTokenSecret($token['oauth_token_secret']);
		$this->user->setNokiaId($token['userid']);
		$this->entityManager->persist($this->user);
		$this->entityManager->flush();
		return $token;
	}

	/**
	 * @return bool true in case the user of this client has an access token and secret as well as a nokia user id,
	 *              false otherwise.
	 */
	public function isAccessGranted(): bool {
		return $this->user !== null &&
			$this->user->getNokiaAccessTokenSecret() !== null &&
			$this->user->getNokiaAccessToken() !== null &&
			$this->user->getNokiaId() !== null;
	}

	public function getBodyMeasures(\DateTime $lastUpdated = null) {
		$params = array();
		if($lastUpdated !== null) {
			$params['lastupdate'] = $lastUpdated->getTimestamp();
		}
		return $this->doGet(self::URL_GET_MEASURES, $params);
	}

	protected function doGet($url, array $additionalParameters = array()) {
		$parameters = array(
			'oauth_consumer_key' => $this->options['client_id'],
			'oauth_timestamp' => time(),
			'oauth_nonce' => $this->generateNonce(),
			'oauth_version' => '1.0',
			'oauth_signature_method' => $this->options['signature_method'],
			'oauth_token' => $this->user->getNokiaAccessToken(),
			'userid' => $this->user->getNokiaId()
		);
		$parameters['oauth_signature'] = OAuthUtils::signRequest(
			HttpRequestInterface::METHOD_GET,
			$url,
			$parameters,
			$this->options['client_secret'],
			$this->user->getNokiaAccessTokenSecret(),
			$this->options['signature_method']
		);
		$finalUrl = $this->normalizeUrl($url, array_merge($parameters, $additionalParameters));
		$this->logger->info(sprintf('Accessing nokia WS, using "%s"', $finalUrl));
		return $this->httpRequest($finalUrl, null, array(), array(), HttpRequestInterface::METHOD_GET)->getContent();
	}
}