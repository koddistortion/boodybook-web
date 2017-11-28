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

class SecondMenuBuilder extends AbstractMenuBuilder {

	public function createSecondMenuLeft() {
		$menu = $this->factory->createItem('secondLeft');
		$menu->addChild('bb_frontend.menu.second.dashboard', array(
			'route' => 'homepage',
			'extras' => array('translation_domain' => 'BodyBookFrontEndBundle')
		))->setLabelAttribute('icon', 'icon-display4 position-left');

//		$mega = $menu->addChild('Mega menu');
//		$mega->setAttribute('mega', true);
//		$mega->setAttribute('class', 'mega-menu mega-menu-wide');
//		$column1 = $mega->addChild('Column 1 title')
//			->setAttribute('class', 'col-md-4')
//			->setLabelAttribute('class', 'menu-heading underlined');
//		$column1->addChild('First link, first column');
//		$secondLinkMultiLevel = $column1->addChild('Second link (multilevel)')->setLabelAttribute('icon', 'icon-brush');
//
//		$secondLinkMultiLevel->addChild('Second level, first link');
//		$secondLinkMultiLevel->addChild('Second level, second link');
//		$secondLinkMultiLevel->addChild('Second level, third link');
//		$secondLinkMultiLevel->addChild('Second level, fourth link');
//
//		$column2 = $mega->addChild('Column 2 title')
//			->setAttribute('class', 'col-md-8')
//			->setLabelAttribute('class', 'menu-heading underlined');
//		$column2->addChild('test', array(
//			'contentTemplate' => 'KoddistortionBodyBookFrontEndBundle:Menu:test.html.twig',
//			'contentTemplateParams' => array(
//				'name' => 'Penis'
//			)
//		));
////		$mega->addChild('Column 3 title');
////		$mega->addChild('Column 4 title');
//
		if($this->isGranted(array('IS_AUTHENTICATED_REMEMBERED'))) {
			$body = $menu->addChild('bb_frontend.menu.second.body.label', array(
				'labelAttributes' => array('icon' => 'icon-accessibility'),
				'extras' => array('translation_domain' => 'BodyBookFrontEndBundle')
			));

			$body->addChild('bb_frontend.menu.second.body.track', array(
				'route' => 'frontend_body_measures_add',
				'labelAttributes' => array('icon' => 'icon-plus2'),
				'attributes' => array('divider-below' => true),
				'extras' => array('translation_domain' => 'BodyBookFrontEndBundle')
			));
			$body->addChild('bb_frontend.menu.second.body.progress', array(
				'labelAttributes' => array('icon' => 'icon-stats-growth'),
				'extras' => array('translation_domain' => 'BodyBookFrontEndBundle')
			));

			$body->addChild('bb_frontend.menu.second.body.calendar', array(
				'labelAttributes' => array('icon' => 'icon-calendar2'),
				'extras' => array('translation_domain' => 'BodyBookFrontEndBundle')
			));
		}
		//		$columns = $starterKit->addChild('Columns')->setLabelAttribute('icon', 'icon-grid2');
//		$columns->addChild('header1-1')
//			->setLabel('Options')
//			->setAttribute('class', 'dropdown-header highlight')
//			->setAttribute('dropdown-header', true);
//		$columns->addChild('One Column');
//		$columns->addChild('Two Columns');
//		$threeColumns = $columns->addChild('Three Columns');
//		$threeColumns->addChild('header1-1-1')
//			->setLabel('Sidebar Position')
//			->setAttribute('class', 'dropdown-header highlight')
//			->setAttribute('dropdown-header', true);
//		$threeColumns->addChild('Dual sidebars');
//		$threeColumns->addChild('Double sidebars');
//		$columns->addChild('Four Columns');
//
//		$navbars = $starterKit->addChild('Navbars')->setLabelAttribute('icon', 'icon-paragraph-justify3');
//		$navbars->addChild('header1-1-2')
//			->setLabel('Fixed Navbars')
//			->setAttribute('class', 'dropdown-header highlight')
//			->setAttribute('dropdown-header', true);
//		$navbars->addChild('Fixed main navbar');
//		$navbars->addChild('Fixed secondary navbar');
//		$navbars->addChild('Both navbars fixed');
//
//		$starterKit->addChild('header2')
//			->setLabel('Optional Layouts')
//			->setAttribute('class', 'dropdown-header')
//			->setAttribute('dropdown-header', true);
//		$starterKit->addChild('Fixed with')->setLabelAttribute('icon', 'icon-align-center-horizontal');
//		$starterKit->addChild('Sticky sidebar')->setLabelAttribute('icon', 'icon-flip-vertical3');

		return $menu;
	}

	public function createSecondMenuRight() {
		return $this->factory->createItem('secondRight');
//		$menu->setChildrenAttribute('class', 'navbar-right');
//
//		$menu->addChild('Text Link', array(
//				'route' => 'homepage',
//			)
//		);
//		$cog = $menu->addChild('Cog');
//		$cog
//			->setLabel('Icon Link')
//			->setLabelAttribute('icon', 'icon-cog3')
//			->setLabelAttribute('class', 'visible-xs-inline-block position-right')
//			->setChildrenAttribute('class', 'dropdown-menu-right');
//
//		$cog->addChild('Action');
//		$cog->addChild('Another Action');
//		$cog->addChild('Something else here')->setAttribute('divider-after', true);
//
//		$cog->addChild('One more separated line');
//
//		return $menu;
	}

}