<?php

namespace App\EventSubscriber;

use App\Services\Recaptcha;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginSubscriber implements EventSubscriberInterface 
{
    private Recaptcha $recaptcha;

    public function __construct(Recaptcha $recaptcha)
    {
        $this->recaptcha = $recaptcha;
    }

    public static function getSubscribedEvents()
    {
        return [
            InteractiveLoginEvent::class => ['onInteractiveLogin', -10]
        ];
    }

    public function onInteractiveLogin (InteractiveLoginEvent $event)
    {
        $request = $event->getRequest();
    
        if (!$this->recaptcha->validateRecaptcha($request->request->get('g-recaptcha-response'))) {
            //throw new CustomUserMessageAuthenticationException(
            throw new CustomUserMessageAccountStatusException( 
                'Failed to pass captcha test'
            );
        }
    }
}