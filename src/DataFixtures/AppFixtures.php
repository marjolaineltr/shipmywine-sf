<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Appellation;
use App\Entity\Color;
use App\Entity\Company;
use App\Entity\Destination;
use App\Entity\Product;
use App\Entity\ProductBrand;
use App\Entity\ProductCategory;
use App\Entity\Type;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


                // User fixtures

                $faker = Factory::create('fr_FR');

                for ($i = 1; $i <= 10; $i++) {
                    $seller = new User();
                    $seller->setPassword($faker->password);
                    $seller->setUsername($faker->userName);
                    $seller->setLastname($faker->lastName);
                    $seller->setFirstname($faker->firstName);
                    $seller->setGender('STATUS_MAN');
                    $seller->setEmail("vendeur@mail.fr");
                    $seller->setRoles((array)'ROLE_SELLER');
                    $company = new Company();
                    $company->setName($faker->company);
                    $company->setUser($seller);
                    $company->setSiret($faker->bankAccountNumber);
                    $company->setVatNumber("FR 00 12456789");
                    $company->setPresentation($faker->word);
                    $seller->setCompany($company);
                    $address = new Address();
                    $address->setStreet("43 rue Saint-Vivien");
                    $address->setZipCode("76000");
                    $address->setCity("Rouen");
                    $address->setIso("FR");
                    $address->setProvince("Seine-Maritime");
                    $address->setCountry("France");
                    $seller->getCompany()->setAddress($address);
                    $manager->persist($seller);
                    $manager->flush();
                }


                $brandList = ['La Romaneé Conti', 'Henri Ehrhart', 'Krug', 'Tiffon', 'Feun', 'La Brouette', 'Tati', 'Epic fail', 'Le Cep d’Argent', 'Damoiseau', 'Coureur des Bois'];
                $categoryList = ['AOP', 'IGP', 'Vin de France'];

                // ----------------------------------------------------------- ProductType Random -----------------------------------------------------------------

                $type_name = ['Tranquille', 'Effervescent', 'Liqueur', 'Spiritueux'];
                $typeList = [];
                for ($i = 0; $i < count($type_name); $i++) {
                    $type = new Type();
                    $type->setName($type_name[$i]);

                    // Tableau des objets ProductCategory
                    $typeList[] = $type;
                    $manager->persist($type);
                }

                // ----------------------------------------------------------- Color Random -----------------------------------------------------------------

                $color_name = ['Rouge', 'Blanc', 'Rosé'];
                $colorList = [];
                for ($i = 0; $i < count($color_name); $i++) {
                    $color = new Color();
                    $color->setName($color_name[$i]);

                    // Tableau des objets ProductCategory
                    $colorList[] = $color;
                    $manager->persist($color);
                }


                // ----------------------------------------------------------- Appellation Random -----------------------------------------------------------------

                $appellation_name = ['Échézeaux', 'La Tâche', 'Montrachet', 'Champagne', 'Crémant d\'Alsace', 'Alsace Riesling', 'Alsace Pinot Gris', 'Alsace Pinot Noir', 'Cognac', 'Saint-Pourçain', 'Côtes de Provence', 'Calvados', 'Muscat de Rivesaltes', 'Vin de glace', 'Rhum', 'Crème d\'érable'];
                $appellationList = [];
                for ($i = 0; $i < count($appellation_name); $i++) {
                    $appellation = new Appellation();
                    $appellation->setName($appellation_name[$i]);

                    // Tableau des objets appellation
                    $appellationList[] = $appellation;
                    $manager->persist($appellation);
                }

                $companies = $manager->getRepository(Company::class)->findAll();
                /**
                 * @Var Company $company
                 */
                foreach ($companies as $company) {

                    // PRODUCT FIXTURES
                    $product = new Product();
                    $product->setCompany($company);
                    $product->setAppellation($faker->randomElement($appellationList));
                    $product->setType($faker->randomElement($typeList));
                    $product->setColor($faker->randomElement($colorList));
                    $product->setArea($faker->country);
                    $product->setCuveeDomaine($faker->colorName);
                    $product->setCapacity($faker->word);
                    $product->setVintage($faker->numberBetween(1930, 2020));
                    $product->setAlcoholVolume($faker->randomFloat(1, 11, 18));
                    $product->setHsCode($faker->word);
                    $product->setDescription($faker->sentence(2));
                    $product->setBrand($faker->randomElement($brandList));
                    $product->setCategory($faker->randomElement($categoryList));
//                    $product->setImage($faker->imageUrl(200,200,['logo']));
                    $product->setPrice($faker->randomNumber(2));
                    $manager->persist($product);


                }
        // ----------------------------------------------------------- Destination -----------------------------------------------------------------

        $countryList= [
            'National' => [
                'France' => 'FR'
            ],
            'Europe' =>[
                'Allemagne' => 'DE',
                'Autriche' => 'AT',
                'Belgique' => 'BE',
                'Danemark' => 'DK',
                'Espagne' => 'ES',
                'Finlande' => 'FI',
                'Italie' => 'IT',
                'Pays-Bas' => 'NL',
                'Portugal' => 'PT',
                'Royaume-Uni' => 'GB',
                'Suède' => 'SE'
            ],
            'World' =>[
                'Australie' => 'AU',
                'Canada' => 'CA',
                'Chine' => 'CN',
                'Corée du Sud' => 'KR',
                'États-Unis' => 'US',
                'Israël' => 'IL',
                'Japon' => 'JP',
                'Norvège' => 'NO',
                'Russie' => 'RU',
                'Singapour' => 'SG',
                'Suisse' => 'CH',
                'Taïwan' => 'TW',
                'Vietnam' => 'VN'
            ]
        ];

        foreach($countryList as $region => $array) {

            foreach($array as $country => $iso) {

                $destination = new Destination();

                $destination->setZone($region);
                $destination->setCountry($country);
                $destination->setIso($iso);

                $destinationList[] = $destination;

                $manager->persist($destination);
                $manager->flush();
            }
        }


                $manager->flush();

            }

}
