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

use Knp\Menu\ItemInterface;

class MainMenuBuilder extends AbstractMenuBuilder {

	public function createMainMenuLeft(): ItemInterface {
		return $this->factory->createItem('mainMenuLeft');
//		$menu->addChild('Text Link', array(
//				'route' => 'homepage',
//			)
//		);
//
//		$calendar = $menu->addChild('Calendar');
//		$calendar
//			->setLabel('Icon Link')
//			->setLabelAttribute('icon', 'icon-calendar3')
//			->setLabelAttribute('class', 'visible-xs-inline-block position-right');
//
//		return $menu;
	}

	public function createMainMenuRight(): ItemInterface {
		$menu = $this->factory->createItem('mainMenuRight', array(
			'childrenAttributes' => array('class' => 'navbar-right no-margin-left')
		));

		if($this->isGranted(array('IS_AUTHENTICATED_REMEMBERED'))) {
//			$cog = $menu->addChild('Cog');
//			$cog
//				->setLabel('Icon Link')
//				->setLabelAttribute('icon', 'icon-cog3')
//				->setLabelAttribute('class', 'visible-xs-inline-block position-right');
//			$cog->addChild('Action');
//			$cog->addChild('Another Action');
//			$cog->addChild('Something else here')
//				->setAttribute('divider-after', true)
//				->setLabelAttribute('icon', 'icon-comment-discussion')
//				->setLabelAttribute('extra', array(
//					'value' => 58,
//					'class' => 'badge badge-warning pull-right'
//				));
//
//			$cog->addChild('One more separated line')
//				->setLabelAttribute('extra', array(
//					'value' => 'NEW',
//					'class' => 'label label-success pull-right'
//				));;
		} else {
			$menu->addChild('bb_frontend.menu.main.login', array(
					'route' => 'fos_user_security_login',
					'labelAttributes' => array('icon' => 'icon-user-lock'),
					'extras' => array('translation_domain' => 'BodyBookFrontEndBundle')
				));
			$menu->addChild('bb_frontend.menu.main.register', array(
					'route' => 'fos_user_registration_register',
					'labelAttributes' => array('icon' => 'icon-user-plus'),
					'extras' => array('translation_domain' => 'BodyBookFrontEndBundle')
				));
		}
		return $menu;
	}

	public function createMainMenuUser(): ItemInterface {
		$menu = $this->factory->createItem('mainMenuUser');
		$menu->setChildrenAttribute('class', 'dropdown-menu dropdown-menu-right');

		$menu->addChild('bb_frontend.menu.user.profile', array(
			'route' => 'fos_user_profile_show',
			'labelAttributes' => array('icon' => 'icon-user-plus'),
			'attributes' => array('divider-below' => true),
			'extras' => array('translation_domain' => 'BodyBookFrontEndBundle')
		));

		$menu->addChild('bb_frontend.menu.user.logout', array(
			'route' => 'fos_user_security_logout',
			'labelAttributes' => array('icon' => 'icon-switch2'),
			'extras' => array('translation_domain' => 'BodyBookFrontEndBundle')
		));;

		return $menu;
	}
}