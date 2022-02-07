<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use App\Form\AddProductType;
use App\Form\UpdateProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user",methods={"GET"})
     */
    public function index(): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UpdateProfileType::class, $user);
        return $this->render('user/index.html.twig', [
            'userForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/user/profile/update", name="user_profile_update")
     * @param Request $request
     * @return Response
     */
    public function updateProfile( Request $request ): Response
    {
        $user =$this->getUser();
        $form = $this->createForm(UpdateProfileType::class,$user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Votre profil a été mis à jour !');
            return $this->redirectToRoute('user');
        }
        return $this->render('user/detail.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/user/password/update", name="user_password_update")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse|Response
     */
    public function editPass(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        if($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            // On vérifie si les 2 mots de passe sont identiques
            if($request->request->get('pass') == $request->request->get('pass2')){
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('pass')));
                $em->flush();
                $this->addFlash('message', 'Mot de passe mis à jour avec succès');

                return $this->redirectToRoute('user');
            }else{
                $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques');
            }
        }

        return $this->render('user/editpassword.html.twig');
    }

    /**
     * @Route("/user/{id}", name="user_profile")
     * @param int|null $id
     * @return Response
     *
     */
    public function checkProfile(?int $id):Response
    {


        $user=  $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('/user/profile.html.twig',[
            'user'=>$user
        ]);

    }
    /**
     * @Route("/user/seller/product/add", name="seller_product_add")
     * @param Request $request
     * @return Response
     */
    public function addProduct( Request $request ): Response
    {
        $user = $this->getUser();
        $product = new Product();
        $form = $this->createForm(AddProductType::class,$product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $product->setUsers($user);


            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('user');
        }
        return $this->render('user/seller/product/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }


}