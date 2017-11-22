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

use Knp\Menu\Factory\ExtensionInterface;
use Knp\Menu\ItemInterface;

class TemplatingExtension implements ExtensionInterface {

	private $environment;

	public function __construct(\Twig_Environment $environment) {
		$this->environment = $environment;
	}

	/**
	 * Builds the full option array used to configure the item.
	 *
	 * @param array $options The options processed by the previous extensions
	 *
	 * @return array
	 * @throws \Twig_Error_Syntax
	 * @throws \Twig_Error_Runtime
	 * @throws \Twig_Error_Loader
	 */
	public function buildOptions(array $options) {
		if(!empty($options['contentTemplate'])) {
			$name = $options['contentTemplate'];
			$context = isset($options['contentTemplateParams']) ? $options['contentTemplateParams'] : array();
			$options['templateContent'] = $this->environment->render($name, $context);
		}
		return $options;
	}

	/**
	 * Configures the item with the passed options
	 *
	 * @param ItemInterface $item
	 * @param array         $options
	 */
	public function buildItem(ItemInterface $item, array $options) {
		if(isset($options['templateContent'])) {
			$item->setExtra('templateContent', $options['templateContent']);
		}
	}
}