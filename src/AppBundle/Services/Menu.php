<?php

namespace AppBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Categories;

class Menu extends Controller
{



     public function getMenu($categories,  $parents_uri_array = null, $uri = null, $menu_type = null) 
     {
	    $category = $this->formTree($categories);
	    
	    if(!$uri) 
	    {
	    	  $parent_uri = null;
	    }else {
	    
           $parent_uri = $this->getRoot($uri);	    
	    }
	    
	    return $this->printMenu($category, $parent_uri, $parents_uri_array, $uri, $menu_type);
     }

     public function printMenu($arr, $parent_uri = null, $parents_uri_array = null, $uri = null, $menu_type = null) 
     {  
         if($menu_type == 'menu') 
         {
    	           foreach ($arr as $value)
	              {   
	                      if($value['uri']==$parent_uri) {
	         	
	                           $url = $this->generateUrl('show',array('uri' => $value['uri']));
	            	            
                              echo  "<li ><a href=\"$url\" class='current_parent'>" .$value['name']. "</a>";
               
                              if(isset($value['child'])) 
                              {
                                    echo '<ul>';
                                    $this->printMenu($value['child'], $value['uri'], null, null, 'menu');   
                                    echo '</ul>';      
                              } 
                              echo '</li>';	
                         } else {
           	
                              $url = $this->generateUrl('show',array('uri' => $value['uri']));
	            	            
                              echo  "<li><a href=\"$url\">" .$value['name']. "</a>";
               
                              if(isset($value['child'])) 
                              {
                                    echo '<ul>';
                                    $this->printMenu($value['child'], $value['uri'], null, null, 'menu');   
                                    echo '</ul>';      
                              } 
                              echo '</li>';	           
                        }	      
	             } 
	       }elseif($menu_type == 'accordion' && $parents_uri_array !== null) 
	       {
                foreach ($arr as $value)
	             {   
	                                      	                     
	                      if(in_array($value['uri'], $parents_uri_array)) {
	         	
	                           $url = $this->generateUrl('show',array('uri' => $value['uri']));
	            	            
                              echo  "<li class='selected'><a href=\"$url\">" .$value['name']. "</a>";
                              
                              if(isset($value['child'])) 
                              {
                                    echo '<ul>';
                                    $this->printMenu($value['child'], null, $parents_uri_array, $uri, 'accordion');   
                                    echo '</ul>';      
                              } 
                              echo '</li>';	
                         } else {
           	
                              if($uri == $value['uri']) {   	
                            	
                                       $url = $this->generateUrl('show',array('uri' => $value['uri']));
	            	            
                                       echo  "<li class='current_link'><a  href=\"$url\">" .$value['name']. "</a>";
               
                                       if(isset($value['child'])) 
                                       {
                                            echo '<ul>';
                                            $this->printMenu($value['child'],null, $parents_uri_array, $uri, 'accordion');   
                                            echo '</ul>';      
                                       } 
                                       echo '</li>';	
                             }else {                                                                             
                                       $url = $this->generateUrl('show',array('uri' => $value['uri']));
	            	            
                                       echo  "<li><a  href=\"$url\">" .$value['name']. "</a>";
               
                                       if(isset($value['child'])) 
                                       {
                                            echo '<ul>';
                                            $this->printMenu($value['child'],null, $parents_uri_array, $uri, 'accordion');   
                                            echo '</ul>';      
                                       } 
                                       echo '</li>';	
                             }           
                        }	
                             
	             } 	       
	       }else {
	       	foreach ($arr as $value)
	         { 
	       	  $url = $this->generateUrl('show',array('uri' => $value['uri']));
	            	            
              echo  "<li><a href=\"$url\">" .$value['name']. "</a>";
               
              if(isset($value['child'])) 
              {
                    echo '<ul>';
                    $this->printMenu($value['child']);   
                    echo '</ul>';      
              } 
              echo '</li>';
            }	       
	       }	
      }
      
     public function formTree($arr)
     {
           $tree = array(); 
           $sub = array( null => &$tree ); 

           foreach ($arr as $item) 
           {    
               $id = $item->getId();
               $name = $item->getName();
               $uri = $item->getUri();
               
               if($item->getParent()!=NULL) {
                     
                     $parent = $item->getParent()->getId();
                     
                     $child = &$sub[$parent];
                     $child['child'][$id] = array('name'=>$name, 'id'=>$id, 'parent' =>$parent, 'uri'=>$uri); 
                     $sub[$id] = &$child['child'][$id];  
                     
               } else {
                     $parent = $item->getParent();
                     
                     $child = &$sub[$parent];
                     $child[$id] = array('name'=>$name, 'id'=>$id, 'uri'=>$uri); 
                     $sub[$id] = &$child[$id]; 
               }                  
          } 
       
          return $tree;
 
      }
      public function getRoot($uri) 
      {
         $em = $this->getDoctrine()->getManager();
         $category = $em->getRepository('AppBundle:Categories')->findOneBy(
                                                                 array('uri'=> $uri)); 
         if(!$category) {
             throw $this->createNotFoundException('Unable to find Category entity.');         
         }
         
         if($category->getParent() != NULL ) 
         { 
              $uri =  $category->getParent()->getUri();
              $parent_uri = $this->getRoot($uri);                                        
         } else {
         
              $parent_uri = $category->getUri();         
         }
         
         return $parent_uri;
      }
      
      
      
}
