<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Authentication;
use AppBundle\Form\AuthenticationType;
use GuzzleHttp\Client;
use JMS\SerializerBundle\JMSSerializerBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/authentication", name="authentication")
     */
    public function authenticationAction(Request $request)
    {
        $client = new Client();
        $authentication = new Authentication();
        $form = $this->createForm(AuthenticationType::class, $authentication, ['validation_groups'=>['Default', 'New']]);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {

                $requests = $request->request->get('authentication');

                $authenticationRequest = $client->post('http://127.0.0.1:8001/auth-tokens',
                    [
                        'json' =>  [
                            'login'    => $requests['login'],
                            'password' => $requests['password']
                        ]
                    ]
                );

                if ($authenticationRequest->getStatusCode() == Response::HTTP_CREATED) {
                    return $this->render('default/index.html.twig', [
                        'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
                    ]);
                }
            }
        }


        return $this->render('default/authentication.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/consultant", name="get_consultants")
     */
    public function getConsultants(Request $request)
    {
        $client = new Client();

        $res = $client->get('http://127.0.0.1:8001/consultant');

        var_dump($res->getStatusCode());exit;
    }
}
