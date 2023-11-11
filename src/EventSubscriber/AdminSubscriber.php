<?php

namespace App\EventSubscriber;

use App\Entity\User;
use App\Entity\Orders;
use App\Entity\Product;
use App\Entity\Category;
use App\Service\SendMailService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class AdminSubscriber implements EventSubscriberInterface
{
    // private $mail;

    // public function __construct(SendMailService $mail)
    // {
    //     $this->mail = $mail;
    // }
    
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCreateAt'],
            BeforeEntityUpdatedEvent::class => [
                ['setUpdateAt', 0], 
                // ['sendEmail', 1]
            ]
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

    // public function sendEmail(BeforeEntityUpdatedEvent $event)
    // {
    // $entityInstance = $event->getEntityInstance();
    
    // if ($entityInstance instanceof Orders && $entityInstance->getPrepared() === true) {
    //     $user = $entityInstance->getUser();

    //     if($user instanceof User){
    //         $userEmail = $user->getEmail();
    //     }

    //     $mail->send(
    //         'no-reply@monsite.net',
    //         $user->getEmail(),
    //         'Votre commande est prête',
    //         'prepared_order',
    //         $context = [
    //              'user' => $user,
    //         ]
    //         );
    //     }
    // }
}