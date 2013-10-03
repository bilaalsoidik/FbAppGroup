<?php

namespace FB\groupeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GroupeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id','text',array('attr'=> array('class'=> 'text_input')))
            ->add('nom','text',array('attr'=> array('class'=> 'text_input')))
            ->add('email','email',array('attr'=> array('class'=> 'text_input')))
            ->add('type','choice',array('choices'=> array( 'SECRET' => 'SECRET',
                                                                     'CLOSED' => 'FERME',
                                                                     'OPEN'   => 'OUVERT'),
                                     'multiple'=> false,
                                     'expanded'=> false,
           ))->add('description','textarea', array('attr'=> array('class'=> 'text_input txt_area')));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FB\groupeBundle\Entity\Groupe'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fb_groupebundle_groupe';
    }
}
