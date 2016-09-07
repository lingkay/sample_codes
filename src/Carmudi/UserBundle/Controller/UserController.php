<?php

namespace Carmudi\UserBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
//use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Carmudi\UserBundle\Entity\User;


class UserController extends FOSRestController
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

    public function getUsersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $objects = $em->getRepository("CarmudiUserBundle:User")->findAll();

        return $objects;
    }

   
    public function userDetailsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tokenManager = $this->get('fos_oauth_server.access_token_manager.default');
        $token = $this->get('security.token_storage')->getToken();
        $accessToken = $tokenManager->findTokenByToken($token->getToken());

        $client = $accessToken->getClient();
        $user= $accessToken->getUser();
        $userid = $user->getID();
        
        $service = $this->get('qalpha_user');
        $user_data = $service->getUserData($userid);

        /*
        $user_objects = $em->getRepository("CarmudiUserBundle:User")->find($userid);
        $name = $user_objects->getUserName();
        $email = $user_objects->getEmail();
        $conf = $user_objects->getConf();
        $user_arr = array ('name'=>$name, 'email'=>$email, 'conf'=>$conf);
        */
        return new JsonResponse($user_data);

        /*$response = new Response();

        $response->setContent(json_encode($user_arr));
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');

        // prints the HTTP headers followed by the content
        $response->send();*/
    }


    public function userPatchDetailsAction(Request $request) {
    
        $em = $this->getDoctrine()->getManager();
        $tokenManager = $this->get('fos_oauth_server.access_token_manager.default');
        $token = $this->get('security.token_storage')->getToken();
        $accessToken = $tokenManager->findTokenByToken($token->getToken());

        $user= $accessToken->getUser();
        $userid = $user->getID();
        $user_object = $em->getRepository("CarmudiUserBundle:User")->find($userid);
        $flag = 0;
        $params = $this->getRequest()->request->all();

        $conf_request = $params['config'];
        
        $conf_json = json_decode($conf_request, true);
        $conf_ser = serialize($conf_json);
        $conf = $user_object->getConf();
        //$conf = json_decode($conf, true);
        $conf = unserialize($conf);
        
        
        
        if ($conf !=null) {
            //$conf_decode = json_decode($conf, true); 
            foreach ($conf_json as $key=>$val) {
                if (array_key_exists($key, $conf)) {
                    $conf = array_replace($conf, array($key=>$val));
                } else {
                    $conf[$key] = $val;
                }
            }
            $user_object->setConf(serialize($conf));
        } else {
            $user_object->setConf($conf_ser);
        }
        
        //$user_object->setConf($conf_ser);
        $em->persist($user_object);
        $em->flush();
        
        
        return new JsonResponse("Succesfully Updated The Records!");
    }

    public function userAddAction(Request $request) {

    }

    public function userEditAction(Request $request) {

    }

    public function userDeleteAction(Request $request) {
        try
        {
            $base_id = $request->get('id');
            $this->hookPreAction();
            $em = $this->getDoctrine()->getManager();

            $object = $em->getRepository($this->repo)->find($id);
            
            // actual delete
            $this->delete($object);

            // return success
        }
        catch (DBALException $e)
        {
            //return error 
        }
    }

    public function userShowAction(Request $request) {

    }
}