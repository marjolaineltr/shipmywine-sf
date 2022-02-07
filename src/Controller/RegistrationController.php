<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use App\Form\CompanyType;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{


    /**
     * @Route("/register/", name="register")
     */
    public function index(): Response
    {
        return $this->render('registration/register-choice.html.twig', [
            'controller_name' => 'RegistrationController',
        ]);
    }

    /**
     * @Route("/register/customer", name="user_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_CUSTOMER','ROLE_USER']);
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();


            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/register/seller", name="seller_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function registerSeller(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {


        $user = new User();
        $company = new Company();

        $user->setRoles(['ROLE_SELLER', 'ROLE_USER']);
//        $company->setValidated(0);

        $form = $this->createForm(RegistrationType::class, $user);
        $formCompany = $this->createForm(CompanyType::class, $company);

        $form->handleRequest($request);
        $formCompany->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setCompany($company);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($company);
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash("sucess","Merci pour votre incription, vous pouvez à présent vous connecter");

            return $this->redirectToRoute('app_login');

        }

        return $this->render('registration/seller-register.html.twig', [
            'company' => $company,
            'registrationForm' => $form->createView(),
            'companyForm' => $formCompany->createView()]);

    }
}