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

class FooterMenuBuilder extends AbstractMenuBuilder {

	public function createFooterMenuRight() {
		return $this->factory->createItem('footerRight');
//		$menu->setChildrenAttribute('class', 'navbar-right');
//		$menu->addChild('Help center');
//		$menu->addChild('Policy');
//		$menu->addChild('Upgrade your account')->setAttribute('class', 'text-semibold');
//
//		$cog = $menu->addChild('Cog');
//		$cog
//			->setLabel('Settings')
//			->setLabelAttribute('icon', 'icon-cog3')
//			->setLabelAttribute('class', 'visible-xs-inline-block position-right');
//
//		$cog->addChild('Dribbble')->setLabelAttribute('icon', 'icon-dribbble3');
//		$cog->addChild('Pinterest')->setLabelAttribute('icon', 'icon-pinterest2');
//		$cog->addChild('Github')->setLabelAttribute('icon', 'icon-github');
//		$cog->addChild('Stack Overflow')->setLabelAttribute('icon', 'icon-stackoverflow');
//
//		return $menu;
	}
}