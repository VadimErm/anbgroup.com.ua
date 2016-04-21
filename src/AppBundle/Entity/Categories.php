<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 */
class Categories
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var category
     */
    private $parent;


    /**
     * @var arrayCollection
     */
    private $children;

    /**
     * @var string
     */
    private $name;
    
    
    
    private $contents;
    

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }
    public function setChildren($children) 
    { 
        $this->children = $children;

        return $this;
    }
    public function getChildren() {
        return $this->children;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return Category
     */
    public function setParent(Categories $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    
    
    public function _construct() 
    {
        $this->contents = new ArrayCollection();   
    }
    


    /**
     * Add child
     *
     * @param \AppBundle\Entity\Categories $child
     *
     * @return Categories
     */
    public function addChild(\AppBundle\Entity\Categories $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\Categories $child
     */
    public function removeChild(\AppBundle\Entity\Categories $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Add content
     *
     * @param \AppBundle\Entity\Content $content
     *
     * @return Categories
     */
    public function addContent(\AppBundle\Entity\Content $content)
    {
        $this->contents[] = $content;

        return $this;
    }

    /**
     * Remove content
     *
     * @param \AppBundle\Entity\Content $content
     */
    public function removeContent(\AppBundle\Entity\Content $content)
    {
        $this->contents->removeElement($content);
    }

    /**
     * Get contents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContents()
    {
        return $this->contents;
    }
    
    function __toString()
    {
        return $this->getName();
    }

    

    
    
    /**
     * @var string
     */
    private $htmlTitle;

    /**
     * @var string
     */
    private $metaTitle;

    /**
     * @var string
     */
    private $metaDescription;

    /**
     * @var string
     */
    private $metaKeywords;


    /**
     * Set htmlTitle
     *
     * @param string $htmlTitle
     *
     * @return Categories
     */
    public function setHtmlTitle($htmlTitle)
    {
        $this->htmlTitle = $htmlTitle;

        return $this;
    }

    /**
     * Get htmlTitle
     *
     * @return string
     */
    public function getHtmlTitle()
    {
        return $this->htmlTitle;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     *
     * @return Categories
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Categories
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     *
     * @return Categories
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }
    /**
     * @var string
     */
    private $uri;


    /**
     * Set uri
     *
     * @param string $uri
     *
     * @return Categories
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }
}
