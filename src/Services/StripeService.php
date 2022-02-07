<?php


namespace App\Services;


use App\Entity\Order;
use App\Entity\Product;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;


class StripeService
{

    private $privateKey;

    public function __construct()
    {
        if ($_ENV['APP_ENV'] === 'dev') {
            $this->privateKey = $_ENV['STRIPE_SECRET_KEY_TEST'];
        } else {
            $this->privateKey = $_ENV['STRIPE_SECRET_KEY_LIVE'];
        }
    }



   // Lorsque l'on effectue un paiement avec Stripe : Récupère le produit acheté
    /**
     * @param Product $product
     * @return PaymentIntent
     * @throws ApiErrorException
     */
    public function paymentIntent(Product $product): PaymentIntent
    {
        Stripe::setApiKey($this->privateKey); // sdk de stripe

        return PaymentIntent::create([
            'amount' => $product->getPrice() * 100, // *100 pour que stripe fasse la bonne conversion
            'currency' => Order::CURRENCY, //devise en constante
            'payment_method_types' => ['card'] //Paiement carte bancaire
        ]);
    }

    public function payment(
        $amount,
        $currency,
        $description,
        array $stripeParameter
    ): ?PaymentIntent
    {
        Stripe::setApiKey($this->privateKey);
        $payment_intent = null;

        // si cela existe
        if (isset($stripeParameter['stripeIntentId'])) {
            try {
                $payment_intent = PaymentIntent::retrieve($stripeParameter['stripeIntentId']);
            } catch (ApiErrorException $e) {
            }
        }

        if ($stripeParameter['stripeIntentStatus'] === 'succeeded') {

        } else {
            // cas d'annulation de paiement
            try {
                $payment_intent->cancel();
            } catch (ApiErrorException $e) {
            }
        }
// retourne le paiement validé
        return $payment_intent;
    }


    // Déclanche le paiement stripe dans sa globalité
    /**
     * @param array $stripeParameter
     * @param Product $product
     * @return PaymentIntent|null
     */
    public function stripe(array $stripeParameter, Product $product): ?PaymentIntent
    {
        return $this->payment(
            $product->getPrice() * 100,
            Order::CURRENCY,
            $product->getCuveeDomaine(),
            $stripeParameter
        );
    }

}