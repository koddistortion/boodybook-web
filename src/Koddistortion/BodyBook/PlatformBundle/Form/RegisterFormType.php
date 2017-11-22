<?php
/*
 * This file is part of the Koddistortions BodyBook.
 *
 * (c) Oliver Kotte
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Koddistortion\BodyBook\PlatformBundle\Form;

use Koddistortion\BodyBook\PlatformBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterFormType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder->add('username', TextType::class, array(
			'label' => false,
			'attr' => array(
				'placeholder' => 'bb_platform.forms.security.register.username.placeholder',
				'maxlength' => 180
			)
		));
		$builder->add('firstName', TextType::class, array(
			'label' => false,
			'attr' => array(
				'placeholder' => 'bb_platform.forms.security.register.firstName.placeholder'
			)
		));
		$builder->add('lastName', TextType::class, array(
			'label' => false,
			'attr' => array(
				'placeholder' => 'bb_platform.forms.security.register.lastName.placeholder'
			)
		));
		$builder->add('email', RepeatedType::class, array(
			'type' => EmailType::class,
			'invalid_message' => 'bb_platform.forms.security.register.email.mismatch',
			'label' => false,
			'first_options' => array(
				'label' => false,
				'attr' => array(
					'placeholder' => 'bb_platform.forms.security.register.email.placeholder',
					'maxlength' => 180
				)
			),
			'second_options' => array(
				'label' => false,
				'attr' => array(
					'placeholder' => 'bb_platform.forms.security.register.email.placeholder_repeat',
					'maxlength' => 180
				)
			)
		));

		$builder->add('plainPassword', RepeatedType::class, array(
			'type' => PasswordType::class,
			'label' => false,
			'invalid_message' => 'fos_user.password.mismatch',
			'first_options' => array(
				'label' => false,
				'attr' => array(
					'placeholder' => 'bb_platform.forms.security.register.password.placeholder',
					'maxlength' => 4096
				),
			),
			'second_options' => array(
				'label' => false,
				'attr' => array(
					'placeholder' => 'bb_platform.forms.security.register.password.placeholder_repeat',
					'maxlength' => 4096
				)
			)
		));
	}

	public function configureOptions(OptionsResolver $resolver) {
		$resolver->setDefault('data_class', User::class);
		$resolver->setDefault('translation_domain', 'BodyBookPlatformBundle');
	}
}