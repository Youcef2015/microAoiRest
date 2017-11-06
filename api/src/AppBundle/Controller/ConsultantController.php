<?php
/**
 * User: ylezghed
 * Date: 21/10/17
 * Time: 02:15
 */
declare(strict_types=1);


namespace AppBundle\Controller;


use AppBundle\Entity\Consultant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations

class ConsultantController extends Controller
{
    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"auth-token"})
     * @Rest\Post("/consultant")
     */
    public function addConsultantAction(Request $request)
    {
        $country = $this->get('doctrine.orm.entity_manager')
               ->getRepository('AppBundle:Country')
               ->find($request->get('country'));


        $consultant = new Consultant();

        $consultant->setFirstName($request->get('firstName'))
            ->setLastName($request->get('lastName'))
            ->setEmail($request->get('email'))
            ->setAddress($request->get('address'))
            ->setCity($request->get('city'))
            ->setZipCode($request->get('zipCode'))
            ->setCountry($country);


        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($consultant);
        $em->flush();

        return $consultant;

    }

    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"auth-token"})
     * @Rest\Put("/consultant/{id}")
     */
    public function editConsultantAction(Request $request)
    {
        $consultant = $this->get('doctrine.orm.entity_manager')
                      ->getRepository('AppBundle:Consultant')
                      ->find($request->get('id'));

        $consultant->setFirstName($request->get('firstName'))
           ->setLastName($request->get('lastName'))
           ->setEmail($request->get('email'))
           ->setAddress($request->get('address'))
           ->setCity($request->get('city'))
           ->setZipCode($request->get('zipCode'))
           ->setCountry($request->get('country'));

        $em = $this->get('doctrine.orm.entity_manager');
        $em->persist($consultant);
        $em->flush();

        return $consultant;
    }

    /**
     * @Get("/consultant")
     */
    public function getConsultantAction(Request $request)
    {
        $consultants = $this->get('doctrine.orm.entity_manager')
                      ->getRepository('AppBundle:Consultant')
                      ->findAll();
        /* @var $consultant Consultant[] */

        $formatted = [];
        foreach ($consultants as $consultant) {
            $formatted[] = [
                'id' => $consultant->getId(),
                'firstName' => $consultant->getFirstName(),
                'lastName' => $consultant->getLastName(),
                'country' => $consultant->getCountry()->getId(),
                'email' => $consultant->getEmail()
            ];
        }

        return new JsonResponse($formatted);
    }
}
