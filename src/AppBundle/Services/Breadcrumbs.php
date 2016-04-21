<?php

namespace AppBundle\Services;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class Breadcrumbs extends Controller 
{
      public function getBreadcrumbs($categories, $id) 
      {
      	$bc_array = $this->formArr($categories);
         $breadcrumbs_array = $this->makeBreadcrumbsArray($bc_array, $id);
         $breadcrumbs = $this->makeBreadcrumbs($breadcrumbs_array, $id);
         
         return $breadcrumbs;
      	
      }
      public function getParentsUriArray($categories, $id) 
      {
      	$bc_array = $this->formArr($categories);
         $breadcrumbs_array = $this->makeBreadcrumbsArray($bc_array, $id);
         
         $breadcrumbs_array = array_values($breadcrumbs_array);
         $count = count($breadcrumbs_array);
         $parents_uri_array=[];
         
         for($i=0; $i<$count-1; $i++) 
         {
               $parents_uri_array[] = $breadcrumbs_array[$i]['uri'];	
         }
         
         return $parents_uri_array;
      }	
            
      public function formArr($arr) 
      {
    	   $arr_line = array();
    	
    	   foreach ($arr as $item)
    	   {
              $id = $item->getId();
              $name = $item->getName();  
              $uri = $item->getUri();
              
              if($item->getParent()!=NULL) 
              {
                    $parent = $item->getParent()->getId();               
                    $arr_line[$id] = array('name'=>$name, 'id'=>$id, 'parent'=>$parent, 'uri'=>$uri);                      
              }
              else 
              {             
                    $arr_line[$id] = array('name'=>$name, 'id'=>$id, 'parent'=>'0', 'uri'=>$uri);	
              }
           	
    	   }
    	   return $arr_line; 
      }
      
      public function makeBreadcrumbsArray($arr, $id) 
      {
      	      	
      	$breadcrumbs_array = array();
         $count = count($arr);
         
         for($i=0; $i < $count; $i++) 
         {
              if(isset($arr[$id])) 
              {
                    $breadcrumbs_array[$arr[$id]['id']] = array('id'=>$arr[$id]['id'], 'name'=>$arr[$id]['name'], 'uri'=>$arr[$id]['uri']);
                    $id = $arr[$id]['parent'];
              } else break;        
         }      	
      	
      	return array_reverse($breadcrumbs_array, true);
      	
      }
      public function makeBreadcrumbs($breadcrumbs_array, $id) {
      	
         $breadcrumbs = [];
         $home_url = $this->generateUrl('index');
         $breadcrumbs[0]="<a href=\"$home_url\">Главная</a><span>&nbsp;/</span>";
         $i=1;
         
         foreach ($breadcrumbs_array as $key => $value)          
         {
         	  $url = $this->generateUrl('show',array('uri' => $value['uri']));
              if($key==$id) {
              	
                  $breadcrumbs[$i]= $value['name'];
                                
              } else {
              	
              	   $breadcrumbs[$i] = "<a href=\"$url\">".$value['name']."</a><span>&nbsp;/</span>";
                  	 
              }  
              $i++;
         }
         
         return $breadcrumbs;
     } 
       
      
}
