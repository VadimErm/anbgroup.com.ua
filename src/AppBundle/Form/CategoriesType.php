<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoriesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array('label'=>'Название'))
            ->add('uri', null, array('label'=>'URI'))
            ->add('parent', null, array('label'=>'Родительская категория'))
            ->add('htmlTitle', null, array('label'=>'HTML Title'))
            ->add('metaTitle', null, array('label'=>'META Title'))
            ->add('metaDescription', null, array('label'=>'META Description'))
            ->add('metaKeywords', null, array('label'=>'META Keywords'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Categories'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_categories';
    }
}
