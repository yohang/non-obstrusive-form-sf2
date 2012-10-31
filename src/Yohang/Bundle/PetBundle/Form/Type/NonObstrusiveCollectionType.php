<?php

namespace Yohang\Bundle\PetBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Yohang\Bundle\PetBundle\Form\EventListener\NonObtrusiveResizeFormListener;

/**
 *
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class NonObstrusiveCollectionType extends CollectionType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->addEventSubscriber(new NonObtrusiveResizeFormListener(
            $builder->getFormFactory(),
            $options['delete_field'],
            $options['required_fields']
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setOptional(array('delete_field', 'required_fields'));
    }

}
