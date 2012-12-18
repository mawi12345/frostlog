<?php
namespace Mawi\Bundle\FrostlogBundle\Entity;


/**
 * StockGroup
 *
 */
class StockGroup
{

    /**
     * @var \DateTime
     */
    private $arrival;

    /**
     * @var integer
     */
    private $quantity = 1;
    
    /**
     * @var integer
     */
    private $count = 1;
    
    /**
     * @var Product $product
     */
    private $product;

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
     * Set count
     *
     * @param integer $count
     * @return Stock
     */
    public function setCount($count)
    {
        $this->count = $count;
    
        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
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
     * Get age in days
     *
     * @return integer
     */
    public function getAge()
    {
        $now = new \DateTime();
        $interval = $now->diff($this->getArrival());
        return $interval->format('%a');
    }
}