<?php

namespace Tutorials\BaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NewsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('user')
            ->add('isDeleted')
            ->add('mediaId')
            ->add('isApproved')
            ->add('likes')
            ->add('shares')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tutorials\BaseBundle\Entity\News'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tutorials_basebundle_news';
    }
}
