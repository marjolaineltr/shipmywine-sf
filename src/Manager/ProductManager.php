<?php


namespace App\Manager;


use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use App\Services\StripeService;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Exception\ApiErrorException;

class ProductManager
{

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;


    /**
     * @var StripeService
     */
    protected StripeService $stripeService;

    /**
     * @param EntityManagerInterface $entityManager
     * @param StripeService $stripeService
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        StripeService $stripeService
    ) {
        $this->em = $entityManager;
        $this->stripeService = $stripeService;
    }

    public function getProducts()
    {
        return $this->em->getRepository(Product::class)
            ->findAll();
    }


    public function getIntent(Product $product)
    {
        try {
            $intent = $this->stripeService->paymentIntent($product);
        } catch (ApiErrorException $e) {

        }
//attribution du client secret
        return $intent['client_secret'] ?? null;
    }


    /**
     * @param array $stripeParameter
     * @param Product $product
     * @return array|null
     */
    public function getStripe(array $stripeParameter, Product $product)
    {
        $resource = null;
        $data = $this->stripeService->stripe($stripeParameter, $product);

        if($data) {
            // La ressource du paiement nous fourni des informations
            $resource = [
                'stripeBrand' => $data['charges']['data'][0]['payment_method_details']['card']['brand'],
                'stripeLast4' => $data['charges']['data'][0]['payment_method_details']['card']['last4'],
                'stripeId' => $data['charges']['data'][0]['id'],
                'stripeStatus' => $data['charges']['data'][0]['status'],
                'stripeToken' => $data['client_secret']
            ];
        }

        return $resource;
    }

    // enregistrement en base de données

    /**
     * @param array $resource
     * @param Product $product
     * @param User $user
     */
    public function createOrder(array $resource, Product $product, User $user)
    {
        $order = new Order();
        $order->setUser($user);
        $order->setProduct($product);
        $order->setPrice($product->getPrice()); // Le prix peut évoluer à mesure de la commande donc stockage du prix
        $order->setReference(uniqid('', false));
        $order->setBrandStripe($resource['stripeBrand']);
        $order->setLast4Stripe($resource['stripeLast4']);
        $order->setIdChargeStripe($resource['stripeId']);
        $order->setStripeToken($resource['stripeToken']);
        $order->setStatusStripe($resource['stripeStatus']);
        $order->setUpdatedAt(new DateTimeImmutable());
        $order->setCreatedAt(new DateTimeImmutable());
        $this->em->persist($order);
        $this->em->flush();
    }
}

