<?php

namespace Tutorials\BaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Sonata\UserBundle\Model\UserInterface;
class EditProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', 'sonata_user_gender', array(
                'label'    => 'form.label_gender',
                'required' => true,
                'translation_domain' => 'SonataUserBundle',
                'choices' => array(
                    UserInterface::GENDER_FEMALE => 'gender_female',
                    UserInterface::GENDER_MALE   => 'gender_male',
                )
            ))
            ->add('firstname', null, array(
                'label'    => 'label_firstname',
                'required' => false
            ))
            ->add('lastname', null, array(
                'label'    => 'form.label_lastname',
                'required' => false
            ))
            ->add('dateOfBirth', 'birthday', array(
                'label'    => 'form.label_date_of_birth',
                'required' => false,
                'widget'   => 'single_text'
            ))
            ->add('website', 'url', array(
                'label'    => 'form.label_website',
                'required' => false,
            ))
            ->add('biography', 'textarea', array(
                'label'    => 'form.label_biography',
                'required' => false
            ))
            ->add('locale', 'locale', array(
                'label'    => 'form.label_locale',
                'required' => false
            ))
            ->add('timezone', 'timezone', array(
                'label'    => 'form.label_timezone',
                'required' => false
            ))
            ->add('phone', null, array(
                'label'    => 'form.label_phone',
                'required' => false
            ))
        ;
    }

    public function getParent()
    {
        return 'sonata_user_profile';
    }

    public function getName()
    {
        return 'tutorials_user_edit_profile';
    }
}
