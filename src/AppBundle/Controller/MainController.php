<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Categories;
use AppBundle\Entity\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\News;
use AppBundle\Services\Breadcrumbs;
use AppBundle\Services\Menu;

class MainController extends Controller 
{
      	
	   public function indexAction() 
	   {
         $em = $this->getDoctrine()->getManager();
         $news= $em->getRepository('AppBundle:News')->findBy(array(), array('id' => 'DESC'));      
         
         return $this->render('default/front.html.twig',
                               array('news'=>$news)                              
                               ); 
      }  	   
   	   	   
      public function menuAction( $parents_uri_array = null, $uri = null, $menu_type = null)
      {
      	$em = $this->getDoctrine()->getManager();  
      	$categories = $em->getRepository('AppBundle:Categories')->findAll();      	     	
      	$menu = $this->get('menu')->getMenu($categories,  $parents_uri_array, $uri, $menu_type); 
      	return new Response($menu);      
      }
      
      public function showAction($uri) 
      {  
         $em = $this->getDoctrine()->getManager();
        
         
         $category = $em->getRepository('AppBundle:Categories')->findOneBy(
                                                                 array('uri'=> $uri)        
                                                               );
            
         $id = $category->getId();
         
         if(!$category) {
             throw $this->createNotFoundException('Unable to find Category entity.');         
         }
        
         $contents  = $category->getContents();
         
         
         $categories = $em->getRepository('AppBundle:Categories')->findAll();
         if(!$categories) {
             throw $this->createNotFoundException('Unable to find Category entity.');         
         }
         
         $breadcrumbs = $this->get('breadcrumbs')->getBreadcrumbs($categories, $id);
         
         $parents_uri_array = $this->get('breadcrumbs')->getParentsUriArray($categories, $id);
         
         
         return $this->render('default/front.html.twig', 
                               array('contents'=>$contents,
                               'breadcrumbs' => $breadcrumbs,
                               'category' => $category,
                               
                               'parents_uri_array' => $parents_uri_array,
                               'uri' => $uri
                             ));
        
         
      }    
      
     
}


?>
