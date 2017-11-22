<?php
/*
 * This file is part of the Koddistortions BodyBook.
 *
 * (c) Oliver Kotte
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\FrontEndBundle\Twig;

class FrontEndExtension extends \Twig_Extension {

	public function getFilters() {
		return array(
			new \Twig_SimpleFilter('array_unset', array($this, 'arrayUnset')),
		);
	}

	public function arrayUnset($array, $key) {
		if(is_array($array) && array_key_exists($key, $array)) {
			unset($array[$key]);
		}
		return $array;
	}
}