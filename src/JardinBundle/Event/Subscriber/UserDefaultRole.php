<?php


namespace JardinBundle\Event\Subscriber;


use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserDefaultRole implements EventSubscriberInterface
{
    private $logger;
    private $authorizationChecker;

    /**
     * UserDefaultRole constructor.
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param LoggerInterface $logger
     */
    public function __construct(AuthorizationCheckerInterface $authorizationChecker, LoggerInterface $logger)
    {
        $this->authorizationChecker = $authorizationChecker;
        $this->logger = $logger;
    }

    public static function getSubscribedEvents()
    {
        return [
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'
        ];
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $logger = $this->logger;
        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getForm()->getData();
            if ((!$this->authorizationChecker->isGranted('ROLE_ADMIN')) and
                !$this->authorizationChecker->isGranted('ROLE_SUPER_ADMIN') ) {

                $logger->info('old roles: : '.json_encode($user->getRoles()));
                $roles = ['ROLE_PARENT'];
                $user->setRoles($roles);
            }
        $logger->info(json_encode($user->getRoles()));
    }

}