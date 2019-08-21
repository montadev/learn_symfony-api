<?php

namespace App\EventSubscriber;

use JMS\Serializer\EventDispatcher\Events;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;

class ApiSubscriber implements EventSubscriberInterface
{
    public function onPostSerialize(ObjectEvent $event)
    {
        $object = $event->getObject();

       //dd(get_class_methods ($event->getVisitor()));

        $date = new \Datetime();
        // Possibilité de modifier le tableau après sérialisation
        $event->getVisitor()->setData('delivered_at', $date->format('l jS \of F Y h:i:s A'));

        
    }

    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => Events::POST_SERIALIZE,
                'format' => 'json',
                'class' => 'App\Entity\Article',
                'method' => 'onPostSerialize',
            ]
        ];
    }
}
