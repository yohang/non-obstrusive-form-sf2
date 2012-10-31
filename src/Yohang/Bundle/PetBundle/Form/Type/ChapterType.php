<?php

namespace Yohang\Bundle\PetBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class ChapterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Yohang\Bundle\PetBundle\Model\Chapter'
            )
        );
    }

    /**
     * @{inheritDoc}
     */
    public function getName()
    {
        return 'chapter';
    }
}
