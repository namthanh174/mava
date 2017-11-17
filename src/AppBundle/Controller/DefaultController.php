<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use AppBundle\Entity\User;

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
    * @Route("/about/{name}", name="aboutpage", defaults={"name":null})
    */
    public function aboutAction($name)
    {
        $user = null;
        if ($name) {
            $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->findOneBy(array('name'=>$name));
            if (false === $user instanceof User) {
                // throw $this->createNotFoundException( 'No user named '.$name.' found!');
                throw $this->createNotFoundException();
                // var_dump("yest");
            }
        }
        return $this->render('about/index.html.twig', array('user' => $user));
    }

}
