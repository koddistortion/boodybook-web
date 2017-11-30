<?php
/*
 * This file is part of the PEC Platform BodyBook.
 *
 * (c) PEC project engineers &amp; consultants
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\PlatformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class WeightType extends AbstractType {

	public function getParent() {
		return NumberType::class;
	}

	public function getBlockPrefix() {
		return 'bodybook_weight';
	}
}