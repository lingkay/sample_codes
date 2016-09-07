<?php

namespace Carmudi\CarBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Carmudi\UserBundle\Entity\User;
use Carmudi\CarBundle\Entity\Registration;


class CarController extends FOSRestController
{
	/**
     * List all notes.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many notes to return.")
     *
     * @Annotations\View()
     */

    public function getCarRegAction()
    {
        $em = $this->getDoctrine()->getManager();
        $objects = $em->getRepository("CarmudiCarBundle:Registration")->findAll();
        
        return $objects;
    }

    public function postCarRegAction(Request $request) {
    
        
        $em = $this->getDoctrine()->getManager();
        $tokenManager = $this->get('fos_oauth_server.access_token_manager.default');
        $token = $this->get('security.token_storage')->getToken();
        $accessToken = $tokenManager->findTokenByToken($token->getToken());

        $client = $accessToken->getClient();
        $user= $accessToken->getUser();
        $userid = $user->getID();

        //$params = $this->getRequest()->request->all();
        $name = $request->request->get('name');
        $displacement_measure = $request->request->get('displacement_measure');
        $displacement_unit = $request->request->get('displacement_unit');
        $power = $request->request->get('power');

        $registration = new Registration();
        $registration->setUser($userid);
        $registration->setName($name);
        $registration->setMeasure($displacement_measure);
        $registration->setUnit($displacement_unit);
        $registration->setPower($power);

        $em->persist($registration); 
        $em->flush();
        //$arr_status = array("status"=>"200", "msg"=>"OK");
        //return new JsonResponse($arr_status);
  
        $em = $this->getDoctrine()->getManager();
        $objects = $em->getRepository("CarmudiCarBundle:Registration")->findAll();
        
        //var_dump($objects);
        $resp = serialize($objects);
        return new JsonResponse($resp);
              
    }
}