<?php
/*
 * This file is part of the PEC Platform BodyBook.
 *
 * (c) PEC project engineers &amp; consultants
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Koddistortion\BodyBook\FrontEndBundle\Repository\BodyStatRepository")
 * @ORM\Table(name="bb_body_stats")
 */
class BodyStat {

	use DefaultEntity;

	/**
	 * @var User $user
	 * @ORM\ManyToOne(targetEntity="Koddistortion\BodyBook\PlatformBundle\Entity\User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	protected $user;

	/**
	 * @var \DateTime
	 * @ORM\Column(type="datetime", nullable=false)
	 */
	protected $measureDate;

	/**
	 * @var float|null
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $weight;

	/**
	 * @var float|null
	 * @ORM\Column(type="float", nullable=true)
	 */
	protected $fat;

	public function __construct() {
		$this->measureDate = new \DateTime();
	}

	/**
	 * @return User
	 */
	public function getUser(): User {
		return $this->user;
	}

	/**
	 * @param User $user
	 * @return BodyStat
	 */
	public function setUser(User $user): BodyStat {
		$this->user = $user;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getMeasureDate() {
		return $this->measureDate;
	}

	/**
	 * @param \DateTime $measureDate
	 * @return BodyStat
	 */
	public function setMeasureDate(\DateTime $measureDate = null): BodyStat {
		$this->measureDate = $measureDate;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getWeight() {
		return $this->weight;
	}

	/**
	 * @param float|null $weight
	 * @return BodyStat
	 */
	public function setWeight($weight): BodyStat {
		$this->weight = $weight;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getFat() {
		return $this->fat;
	}

	/**
	 * @param float|null $fat
	 * @return BodyStat
	 */
	public function setFat($fat): BodyStat {
		$this->fat = $fat;
		return $this;
	}

	public function getFatAsPercent() {
		return $this->fat !== null ? $this->fat * 100.0 : null;
	}

}