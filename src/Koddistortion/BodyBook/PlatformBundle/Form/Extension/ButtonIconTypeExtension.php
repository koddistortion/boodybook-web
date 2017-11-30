<?php
/*
 * This file is part of the PEC Platform StreetScooterApp.
 *
 * (c) PEC project engineers &amp; consultants
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\PlatformBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ButtonIconTypeExtension extends AbstractTypeExtension {

	public function configureOptions(OptionsResolver $resolver) {
		// makes it legal for ButtonType fields to have an image_property option
		$resolver->setDefined(array('icon_before'));
		$resolver->setDefined(array('icon_after'));
		$resolver->setDefault('icon_before', null);
		$resolver->setDefault('icon_after', null);
		$resolver->setAllowedTypes('icon_before', array('string', 'null'));
		$resolver->setAllowedTypes('icon_after', array('string', 'null'));
	}

	public function buildView(FormView $view, FormInterface $form, array $options) {
		$view->vars['icon_before'] = isset($options['icon_before']) ? $options['icon_before'] : null;
		$view->vars['icon_after'] = isset($options['icon_after']) ? $options['icon_after'] : null;
	}

	/**
	 * Returns the name of the type being extended.
	 *
	 * @return string The name of the type being extended
	 */
	public function getExtendedType() {
		return ButtonType::class;
	}
}