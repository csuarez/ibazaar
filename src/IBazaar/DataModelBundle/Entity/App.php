<?php

namespace IBazaar\DataModelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * App
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class App
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
	 * @ORM\Column(type="string")
	 */
	protected $name;

	/**
	 * @ORM\Column(type="text")
	 */
	protected $description;

	/**
	 * @ORM\Column(type="float")
	 */
	protected $price;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $logoUrl;

	/**
	 * @ORM\Column(type="integer")
	 */
	protected $downloads;

	/**
	 * @ORM\Column(type="datetime")
	 */
	protected $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity="Category", inversedBy="apps", cascade={"all"})
     * @ORM\JoinTable(name="categories_apps",
     *      joinColumns={@ORM\JoinColumn(name="app_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
    protected $categories;


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
     * Set name
     *
     * @param string $name
     * @return App
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

    /**
     * Set description
     *
     * @param string $description
     * @return App
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return App
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set logoUrl
     *
     * @param string $logoUrl
     * @return App
     */
    public function setLogoUrl($logoUrl)
    {
        $this->logoUrl = $logoUrl;
    
        return $this;
    }

    /**
     * Get logoUrl
     *
     * @return string 
     */
    public function getLogoUrl()
    {
        return $this->logoUrl;
    }

    /**
     * Set downloads
     *
     * @param integer $downloads
     * @return App
     */
    public function setDownloads($downloads)
    {
        $this->downloads = $downloads;
    
        return $this;
    }

    /**
     * Get downloads
     *
     * @return integer 
     */
    public function getDownloads()
    {
        return $this->downloads;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return App
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add categories
     *
     * @param \IBazaar\DataModelBundle\Entity\Category $categories
     * @return App
     */
    public function addCategorie(\IBazaar\DataModelBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;
    
        return $this;
    }

    public function addCategory(\IBazaar\DataModelBundle\Entity\Category $categories)
    {
        return $this->addCategorie($categories);
    }

    /**
     * Remove categories
     *
     * @param \IBazaar\DataModelBundle\Entity\Category $categories
     */
    public function removeCategorie(\IBazaar\DataModelBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    public function removeCategory(\IBazaar\DataModelBundle\Entity\Category $categories)
    {
        $this->removeCategorie($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }
}