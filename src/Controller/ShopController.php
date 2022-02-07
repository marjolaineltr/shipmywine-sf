<?php

namespace App\Controller;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    /**
     * @Route("/Company", name="shop")
     * @param CompanyRepository $companyRepository
     * @return Response
     */
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('shop/index.html.twig', [
            'companies' => $companyRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/Company/{id}", name="company_detail")
     * @param Company $company
     * @return Response
     */
    public function showCompany(Company $company): Response
    {
        return $this->render('shop/detail.html.twig', [
            'company' => $company
        ]);
    }

}
