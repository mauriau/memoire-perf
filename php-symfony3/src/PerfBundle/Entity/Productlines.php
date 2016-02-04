<?php

namespace PerfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Productlines
 *
 * @ORM\Table(name="productlines")
 * @ORM\Entity
 */
class Productlines
{
    /**
     * @var string
     *
     * @ORM\Column(name="textDescription", type="string", length=4000, nullable=true)
     */
    private $textdescription;

    /**
     * @var string
     *
     * @ORM\Column(name="htmlDescription", type="text", length=16777215, nullable=true)
     */
    private $htmldescription;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="blob", length=16777215, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="productLine", type="string", length=50)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $productline;



    /**
     * Set textdescription
     *
     * @param string $textdescription
     *
     * @return Productlines
     */
    public function setTextdescription($textdescription)
    {
        $this->textdescription = $textdescription;

        return $this;
    }

    /**
     * Get textdescription
     *
     * @return string
     */
    public function getTextdescription()
    {
        return $this->textdescription;
    }

    /**
     * Set htmldescription
     *
     * @param string $htmldescription
     *
     * @return Productlines
     */
    public function setHtmldescription($htmldescription)
    {
        $this->htmldescription = $htmldescription;

        return $this;
    }

    /**
     * Get htmldescription
     *
     * @return string
     */
    public function getHtmldescription()
    {
        return $this->htmldescription;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Productlines
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Get productline
     *
     * @return string
     */
    public function getProductline()
    {
        return $this->productline;
    }
}
