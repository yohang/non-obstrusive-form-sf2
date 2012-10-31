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
class BookType extends AbstractType
{
    /**
     * @{inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('author')
            ->add('chapters', new NonObstrusiveCollectionType, array(
                'allow_add'       => true,
                'allow_delete'    => true,
                'type'            => new ChapterType,
                'delete_field'    => 'delete',
                'required_fields' => array('name')
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Yohang\Bundle\PetBundle\Model\Book'
            )
        );
    }

    /**
     * @{inheritDoc}
     */
    public function getName()
    {
        return 'book';
    }
}
