<?php

namespace AppBundle\Services;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserSecurity
{
    /**
     * Permet de récupérer l'encodeur qu'on a défini dans le security.yml
     * @var EncoderFactoryInterface
     */
    protected $encoderFactory;

    /**
     * Constructor
     *
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    protected function getEncoder(UserInterface $user)
    {
        return $this->encoderFactory->getEncoder($user);
    }

    /**
     * @param \AppBundle\Entity\User $user
     */
    protected function updatePassword(UserInterface $user)
    {
        if (0 !== strlen($password = $user->getPlainPassword())) {
            $encoder = $this->getEncoder($user);
            $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
            $user->eraseCredentials();
        }
    }

    /**
     * Nous permet, au moment d'insérer dans la BDD, de mettre à jour la BDD
     * On écoute les évenements Doctrine (cf doc doctrine)
     * @param LifecycleEventArgs $args
     *
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if ($object instanceof UserInterface) {
            $this->updatePassword($object);
        }
    }
}