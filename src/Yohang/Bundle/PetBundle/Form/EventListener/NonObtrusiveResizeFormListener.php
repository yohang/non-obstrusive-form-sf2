<?php

namespace Yohang\Bundle\PetBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;

/**
 *
 *
 * @author Yohan Giarelli <yohan@frequence-web.fr>
 */
class NonObtrusiveResizeFormListener implements EventSubscriberInterface
{
    /**
     * @var FormFactoryInterface
     */
    protected $factory;

    /**
     * @var string
     */
    protected $deleteField;

    protected $requiredFields = array();

    /**
     * @param FormFactoryInterface $factory
     * @param null                 $deleteField
     * @param array                $requiredFields
     */
    public function __construct(FormFactoryInterface $factory, $deleteField = null, $requiredFields = array())
    {
        $this->factory        = $factory;
        $this->deleteField    = $deleteField;
        $this->requiredFields = $requiredFields;
    }

    public function onPreBind(FormEvent $event)
    {
        $data = $event->getData();
        foreach ($event->getData() as $key => $sub) {
            $this->processDeletions($data, $key);

            foreach ($this->requiredFields as $field) {
                if (!(isset($sub[$field]) && $sub[$field])) {
                    unset($data[$key]);

                    break;
                }
            }
        }

        $event->setData($data);
    }

    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        foreach ($form as $sub) {
            $sub->add($this->factory->createNamed($this->deleteField, 'checkbox', null, array('mapped' => false)));
        }
    }

    private function processDeletions(array &$data, $key)
    {
        if (null !== $this->deleteField && isset($data[$key][$this->deleteField]) && $data[$key][$this->deleteField]) {
            unset($data[$key]);
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_BIND     => array('onPreBind', 1024),
            FormEvents::PRE_SET_DATA => array('onPreSetData', -100),
        );
    }
}
