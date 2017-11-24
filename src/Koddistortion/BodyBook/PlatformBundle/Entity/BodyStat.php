<?php
/*
 * This file is part of the PEC Platform boodybook-web.
 *
 * (c) PEC project engineers &amp; consultants
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
	 * @var float
	 * @ORM\Column(type="float", nullable=false)
	 */
	protected $value;

	/**
	 * @var int
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected $type;

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
	 * @return \DateTime
	 */
	public function getMeasureDate(): \DateTime {
		return $this->measureDate;
	}

	/**
	 * @param \DateTime $measureDate
	 * @return BodyStat
	 */
	public function setMeasureDate(\DateTime $measureDate): BodyStat {
		$this->measureDate = $measureDate;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getValue(): float {
		return $this->value;
	}

	/**
	 * @param float $value
	 * @return BodyStat
	 */
	public function setValue(float $value): BodyStat {
		$this->value = $value;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getType(): int {
		return $this->type;
	}

	/**
	 * @param int $type
	 * @return BodyStat
	 */
	public function setType(int $type): BodyStat {
		$this->type = $type;
		return $this;
	}

}