<?php
/*
 * This file is part of the PEC Platform BodyBook.
 *
 * (c) PEC project engineers &amp; consultants
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\FrontEndBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Koddistortion\BodyBook\PlatformBundle\Entity\BodyStat;
use Koddistortion\BodyBook\PlatformBundle\Entity\User;

class BodyStatRepository extends EntityRepository {

	/**
	 * @param User     $user
	 * @param int|null $mostRecent
	 * @return BodyStat[]
	 */
	public function getMeasuresForUser(User $user, $mostRecent = null): array {
		return $this->getMeasuresForUserQueryBuilder($user, $mostRecent)->getQuery()->getResult();
	}

	/**
	 * @param User $user
	 * @return int
	 */
	public function getMeasuresCountForUser(User $user): int {
		$count = $this->getMeasuresCountForUserQueryBuilder($user)->getQuery()->getSingleScalarResult();
		return (int)$count;
	}

	/**
	 * @param User $user
	 * @return QueryBuilder
	 */
	protected function getMeasuresCountForUserQueryBuilder(User $user): QueryBuilder {
		$qb = $this->createQueryBuilder('measure');
		$qb->where('measure.user = :user')->setParameter('user', $user);
		$qb->select('COUNT(measure)');
		return $qb;
	}

	/**
	 * @param User     $user
	 * @param int|null $mostRecent
	 * @return QueryBuilder
	 */
	protected function getMeasuresForUserQueryBuilder(User $user, $mostRecent = null): QueryBuilder {
		$qb = $this->createQueryBuilder('measure');
		$qb->where('measure.user = :user')->setParameter('user', $user);
		if($mostRecent !== null && \is_int($mostRecent)) {
			$qb->setMaxResults($mostRecent);
		}
		$qb->orderBy('measure.measureDate', 'DESC');
		return $qb;
	}

}