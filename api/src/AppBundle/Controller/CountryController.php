<?php
/**
 * User: ylezghed
 * Date: 21/10/17
 * Time: 14:55
 */
declare(strict_types=1);


namespace AppBundle\Controller;
use AppBundle\Entity\Country;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations

class CountryController extends Controller
{
    /**
     * @Get("/countries")
     */
    public function getCountriesAction()
    {
        $countries = $this->get('doctrine.orm.entity_manager')
                            ->getRepository('AppBundle:Country')
                            ->findAll();
        /* @var $country Country[] */

        $formatted = [];
        foreach ($countries as $country) {
            $formatted[] = [
                'id' => $country->getId(),
                'code' => $country->getCode(),
                'label' => $country->getLabel()
            ];
        }

        return new JsonResponse($formatted);
    }
}
