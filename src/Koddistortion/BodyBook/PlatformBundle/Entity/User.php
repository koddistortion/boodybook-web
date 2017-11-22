<?php
/*
 * This file is part of the Koddistortions BodyBook.
 *
 * (c) Oliver Kotte
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="bb_user")
 * @UniqueEntity(fields="usernameCanonical", errorPath="username", message="fos_user.username.already_used")
 * @ORM\AttributeOverrides({
 *      @ORM\AttributeOverride(name="emailCanonical", column=@ORM\Column(type="string", name="email_canonical", length=255, unique=false, nullable=false))
 * })
 */
class User extends BaseUser {

	use TimestampableEntity;

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @var string|null
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $firstName;

	/**
	 * @var string|null
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $lastName;

	/**
	 * @var string|null
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $profilePicture;

	/**
	 * @var string|null
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $google_id;

	/**
	 * @var string|null
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $google_access_token;

	/**
	 * @var string|null
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $facebook_id;

	/**
	 * @var string|null
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $facebook_access_token;

	/**
	 * @var string|null
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $twitter_id;

	/**
	 * @var string|null
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	protected $twitter_access_token;

	/**
	 * @return mixed
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @param mixed $firstName
	 * @return User
	 */
	public function setFirstName($firstName): User {
		$this->firstName = $firstName;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @param mixed $lastName
	 * @return User
	 */
	public function setLastName($lastName): User {
		$this->lastName = $lastName;
		return $this;
	}

	public function getFullName() {
		if($this->lastName && $this->firstName) {
			return $this->firstName . ' ' . $this->lastName;
		}
		if($this->lastName) {
			return $this->lastName;
		}

		return $this->firstName;
	}

	/**
	 * @return string|null
	 */
	public function getProfilePicture() {
		return $this->profilePicture;
	}

	/**
	 * @param string|null $profilePicture
	 * @return User
	 */
	public function setProfilePicture($profilePicture): User {
		$this->profilePicture = $profilePicture;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getGoogleId(): string {
		return $this->google_id;
	}

	/**
	 * @param string $google_id
	 * @return User
	 */
	public function setGoogleId(string $google_id): User {
		$this->google_id = $google_id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getGoogleAccessToken(): string {
		return $this->google_access_token;
	}

	/**
	 * @param string $google_access_token
	 * @return User
	 */
	public function setGoogleAccessToken(string $google_access_token): User {
		$this->google_access_token = $google_access_token;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFacebookId(): string {
		return $this->facebook_id;
	}

	/**
	 * @param string $facebook_id
	 * @return User
	 */
	public function setFacebookId(string $facebook_id): User {
		$this->facebook_id = $facebook_id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getFacebookAccessToken(): string {
		return $this->facebook_access_token;
	}

	/**
	 * @param string $facebook_access_token
	 * @return User
	 */
	public function setFacebookAccessToken(string $facebook_access_token): User {
		$this->facebook_access_token = $facebook_access_token;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTwitterId(): string {
		return $this->twitter_id;
	}

	/**
	 * @param string $twitter_id
	 * @return User
	 */
	public function setTwitterId(string $twitter_id): User {
		$this->twitter_id = $twitter_id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTwitterAccessToken(): string {
		return $this->twitter_access_token;
	}

	/**
	 * @param string $twitter_access_token
	 * @return User
	 */
	public function setTwitterAccessToken(string $twitter_access_token): User {
		$this->twitter_access_token = $twitter_access_token;
		return $this;
	}

	public function fromExternalSource(): bool {
		return $this->twitter_id !== null || $this->facebook_id !== null || $this->google_id !== null;
	}

}