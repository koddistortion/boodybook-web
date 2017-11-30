<?php
/*
 * This file is part of the PEC Platform BodyBook.
 *
 * (c) PEC project engineers &amp; consultants
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\FrontEndBundle\Form;

use Koddistortion\BodyBook\PlatformBundle\Entity\BodyStat;
use Koddistortion\BodyBook\PlatformBundle\Form\WeightType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BodyStatType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('weight', WeightType::class, array(
			'label' => 'bb_frontend.forms.body_stat.weight.label',
			'attr' => array('placeholder' => 'bb_frontend.forms.body_stat.weight.placeholder'),
			'required' => false,
			'scale' => 2
		));
		$builder->add('fat', PercentType::class, array(
			'label' => 'bb_frontend.forms.body_stat.fat.label',
			'attr' => array('placeholder' => 'bb_frontend.forms.body_stat.fat.placeholder'),
			'required' => false,
			'scale' => 2
		));
		$builder->add('measureDate', DateTimeType::class, array(
			'label' => 'bb_frontend.forms.body_stat.measureDate',
			'date_widget' => 'single_text',
			'time_widget' => 'single_text'
		));
		$builder->add('submit', SubmitType::class, array(
			'icon_after' => 'icon-arrow-right14 position-right',
			'label' => 'bb_frontend.forms.body_stat.submit'
		));
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefault('translation_domain', 'BodyBookFrontEndBundle');
		$resolver->setDefault('data_class', BodyStat::class);
	}

}