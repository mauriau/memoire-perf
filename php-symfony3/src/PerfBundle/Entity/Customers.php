<?php

namespace PerfBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customers
 *
 * @ORM\Table(name="customers", indexes={@ORM\Index(name="salesRepEmployeeNumber", columns={"salesRepEmployeeNumber"})})
 * @ORM\Entity
 */
class Customers
{
    /**
     * @var string
     *
     * @ORM\Column(name="customerName", type="string", length=50, nullable=false)
     */
    private $customername;

    /**
     * @var string
     *
     * @ORM\Column(name="contactLastName", type="string", length=50, nullable=false)
     */
    private $contactlastname;

    /**
     * @var string
     *
     * @ORM\Column(name="contactFirstName", type="string", length=50, nullable=false)
     */
    private $contactfirstname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="addressLine1", type="string", length=50, nullable=false)
     */
    private $addressline1;

    /**
     * @var string
     *
     * @ORM\Column(name="addressLine2", type="string", length=50, nullable=true)
     */
    private $addressline2;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50, nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="postalCode", type="string", length=15, nullable=true)
     */
    private $postalcode;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=50, nullable=false)
     */
    private $country;

    /**
     * @var float
     *
     * @ORM\Column(name="creditLimit", type="float", precision=10, scale=0, nullable=true)
     */
    private $creditlimit;

    /**
     * @var integer
     *
     * @ORM\Column(name="customerNumber", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $customernumber;

    /**
     * @var \PerfBundle\Entity\Employees
     *
     * @ORM\ManyToOne(targetEntity="PerfBundle\Entity\Employees")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="salesRepEmployeeNumber", referencedColumnName="employeeNumber")
     * })
     */
    private $salesrepemployeenumber;



    /**
     * Set customername
     *
     * @param string $customername
     *
     * @return Customers
     */
    public function setCustomername($customername)
    {
        $this->customername = $customername;

        return $this;
    }

    /**
     * Get customername
     *
     * @return string
     */
    public function getCustomername()
    {
        return $this->customername;
    }

    /**
     * Set contactlastname
     *
     * @param string $contactlastname
     *
     * @return Customers
     */
    public function setContactlastname($contactlastname)
    {
        $this->contactlastname = $contactlastname;

        return $this;
    }

    /**
     * Get contactlastname
     *
     * @return string
     */
    public function getContactlastname()
    {
        return $this->contactlastname;
    }

    /**
     * Set contactfirstname
     *
     * @param string $contactfirstname
     *
     * @return Customers
     */
    public function setContactfirstname($contactfirstname)
    {
        $this->contactfirstname = $contactfirstname;

        return $this;
    }

    /**
     * Get contactfirstname
     *
     * @return string
     */
    public function getContactfirstname()
    {
        return $this->contactfirstname;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Customers
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set addressline1
     *
     * @param string $addressline1
     *
     * @return Customers
     */
    public function setAddressline1($addressline1)
    {
        $this->addressline1 = $addressline1;

        return $this;
    }

    /**
     * Get addressline1
     *
     * @return string
     */
    public function getAddressline1()
    {
        return $this->addressline1;
    }

    /**
     * Set addressline2
     *
     * @param string $addressline2
     *
     * @return Customers
     */
    public function setAddressline2($addressline2)
    {
        $this->addressline2 = $addressline2;

        return $this;
    }

    /**
     * Get addressline2
     *
     * @return string
     */
    public function getAddressline2()
    {
        return $this->addressline2;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Customers
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Customers
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set postalcode
     *
     * @param string $postalcode
     *
     * @return Customers
     */
    public function setPostalcode($postalcode)
    {
        $this->postalcode = $postalcode;

        return $this;
    }

    /**
     * Get postalcode
     *
     * @return string
     */
    public function getPostalcode()
    {
        return $this->postalcode;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Customers
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set creditlimit
     *
     * @param float $creditlimit
     *
     * @return Customers
     */
    public function setCreditlimit($creditlimit)
    {
        $this->creditlimit = $creditlimit;

        return $this;
    }

    /**
     * Get creditlimit
     *
     * @return float
     */
    public function getCreditlimit()
    {
        return $this->creditlimit;
    }

    /**
     * Get customernumber
     *
     * @return integer
     */
    public function getCustomernumber()
    {
        return $this->customernumber;
    }

    /**
     * Set salesrepemployeenumber
     *
     * @param \PerfBundle\Entity\Employees $salesrepemployeenumber
     *
     * @return Customers
     */
    public function setSalesrepemployeenumber(\PerfBundle\Entity\Employees $salesrepemployeenumber = null)
    {
        $this->salesrepemployeenumber = $salesrepemployeenumber;

        return $this;
    }

    /**
     * Get salesrepemployeenumber
     *
     * @return \PerfBundle\Entity\Employees
     */
    public function getSalesrepemployeenumber()
    {
        return $this->salesrepemployeenumber;
    }
}
