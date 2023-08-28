<?php

namespace App\EventSubscriber;

use App\Entity\Product;
use App\Entity\Category;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreateAt'],
            BeforeEntityUpdatedEvent::class => ['setUpdateAt']
        ];
    }

    public function setCreateAt(BeforeEntityPersistedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();

        if (!$entityInstance instanceof Product && !$entityInstance instanceof Category) return;

        $entityInstance->setCreateAt(new \DateTimeImmutable);
    }

    public function setUpdateAt(BeforeEntityUpdatedEvent $event)
    {
        $entityInstance = $event->getEntityInstance();

        if (!$entityInstance instanceof Product && !$entityInstance instanceof Category) return;

        $entityInstance->setUpdateAt(new \DateTimeImmutable);
    }
}