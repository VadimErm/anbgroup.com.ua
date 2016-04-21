<?php

namespace AppBundle\Entity;

/**
 * Content
 */
class Content
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $field;

    /**
     * @var \DateTime
     */
    private $createdDate;

    private $categories;
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
     * Set title
     *
     * @param string $title
     *
     * @return Content
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Content
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Content
     */
    public function setCreatedDate($createdDate)
    {
        if(!$this->createdDate) {        
            $this->createdDate = new \DateTime();
        }

        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set categories
     *
     * @param \AppBundle\Entity\Categories $categories
     *
     * @return Content
     */
    public function setCategories(\AppBundle\Entity\Categories $categories = null)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return \AppBundle\Entity\Categories
     */
    public function getCategories()
    {
        return $this->categories;
    }
}
