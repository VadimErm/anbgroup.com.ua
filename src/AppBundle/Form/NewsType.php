<?php

namespace AppBundle\Form;

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
            ->add('title', null, array('label' => 'Заголовок'))
            ->add('link',  null, array('label' => 'Ссылка'))
            ->add('date', 'hidden', array('mapped' => false))
            ->add('category', 'choice', array(
            'choices' => array(
                 'Новини' => 'news',
                 'Думка експерта' => 'opinion',
                 'Публiкацiї' => 'public'
                             
            ),
            'choices_as_values' => true,
            'label' => 'Категория'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\News'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appbundle_news';
    }
}
