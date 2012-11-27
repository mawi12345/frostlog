<?php

namespace Mawi\Bundle\FrostlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stock
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mawi\Bundle\FrostlogBundle\Entity\StockRepository")
 */
class Stock
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrival", type="datetime", nullable=false)
     */
    private $arrival;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure", type="datetime", nullable=true)
     */
    private $departure;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity = 1;
    
    /**
     * @var Product $product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;
    
    /**
     * @var Storage $storage
     *
     * @ORM\ManyToOne(targetEntity="Storage")
     * @ORM\JoinColumn(name="storage_id", referencedColumnName="id")
     */
    private $storage;
    
    
    public function __construct()
    {
    	$this->setArrival(new \DateTime('NOW'));
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
     * Set arrival
     *
     * @param \DateTime $arrival
     * @return Stock
     */
    public function setArrival($arrival)
    {
        $this->arrival = $arrival;
    
        return $this;
    }

    /**
     * Get arrival
     *
     * @return \DateTime 
     */
    public function getArrival()
    {
        return $this->arrival;
    }

    /**
     * Set departure
     *
     * @param \DateTime $departure
     * @return Stock
     */
    public function setDeparture($departure)
    {
        $this->departure = $departure;
    
        return $this;
    }

    /**
     * Get departure
     *
     * @return \DateTime 
     */
    public function getDeparture()
    {
        return $this->departure;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Stock
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set product
     *
     * @param \Mawi\Bundle\FrostlogBundle\Entity\Product $product
     * @return Stock
     */
    public function setProduct(\Mawi\Bundle\FrostlogBundle\Entity\Product $product = null)
    {
        $this->product = $product;
    
        return $this;
    }

    /**
     * Get product
     *
     * @return \Mawi\Bundle\FrostlogBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set storage
     *
     * @param \Mawi\Bundle\FrostlogBundle\Entity\Storage $storage
     * @return Stock
     */
    public function setStorage(\Mawi\Bundle\FrostlogBundle\Entity\Storage $storage = null)
    {
        $this->storage = $storage;
    
        return $this;
    }

    /**
     * Get storage
     *
     * @return \Mawi\Bundle\FrostlogBundle\Entity\Storage 
     */
    public function getStorage()
    {
        return $this->storage;
    }
}