<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\MessageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;

    /**
     * @var MessageService
     */
    protected MessageService $messageService;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param UserRepository $userRepository
     * @param MessageService $messageService
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        MessageService $messageService
    )
    {
        $this->em = $entityManager;
        $this->userRepository = $userRepository;
        $this->messageService = $messageService;
    }
}