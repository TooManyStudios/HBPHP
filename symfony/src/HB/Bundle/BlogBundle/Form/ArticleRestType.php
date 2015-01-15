<?php

namespace HB\Bundle\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticleRestType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateCreation', 'datetime')
            ->add('auteur', 'entity', array(
					  'class'        => 'HBBlogBundle:Auteur',
					  'property'     => 'pseudo')
            		)
            ->add('titre', 'text')
            ->add('contenu', 'textarea')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HB\Bundle\BlogBundle\Entity\Article',
        	'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'hb_bundle_blogbundle_article_rest';
    }
}
