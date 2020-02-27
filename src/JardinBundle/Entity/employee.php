<?php

namespace JardinBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use  Symfony\Component\Validator\Constraints as Assert;
use FOS\UserBundle\Model\User as FosUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * employee
 *
 * @ORM\Table(name="employee")
 * @ORM\Entity(repositoryClass="JardinBundle\Repository\employeeRepository")
 */
class employee extends FosUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     * @Assert\Regex("/^[0-9]{8}$/")
     * @ORM\Column(name="cin", type="integer")
     */
    private $cin;

    /**
     * @var string
     *
     * @ORM\Column(name="diplomes", type="string", length=255)
     */
    private $diplomes;

    /**
     * @ORM\OneToMany(targetEntity="JardinBundle\Entity\transport", mappedBy="employee")
     * @ORM\JoinColumn(name="transport_id", referencedColumnName="id")
     */
    private $transport;

    /**
     * @ORM\Column(name="disponible", type="boolean")
     */
    private $disponible = false;

    /**
     * @return mixed
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * @param mixed $disponible
     */
    public function setDisponible($disponible): void
    {
        $this->disponible = $disponible;
    }



    /**
     * @return mixed
     */
    public function getTransport()
    {
        return $this->transport;
    }

    /**
     * @param mixed $transport
     */
    public function setTransport($transport)
    {
        $this->transport = $transport;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="string", length=255)
     */
    private $cv;

    /**
     * @var string
     *
     * @ORM\Column(name="inf_sup", type="string", length=255)
     */
    private $infSup;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set cin
     *
     * @param integer $cin
     *
     * @return employee
     */
    public function setCin($cin)
    {
        $this->cin = $cin;

        return $this;
    }

    /**
     * Get cin
     *
     * @return int
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * Set diplomes
     *
     * @param string $diplomes
     *
     * @return employee
     */
    public function setDiplomes($diplomes)
    {
        $this->diplomes = $diplomes;

        return $this;
    }

    /**
     * Get diplomes
     *
     * @return string
     */
    public function getDiplomes()
    {
        return $this->diplomes;
    }

    /**
     * Set cv
     *
     * @param string $cv
     *
     * @return employee
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set infSup
     *
     * @param string $infSup
     *
     * @return employee
     */
    public function setInfSup($infSup)
    {
        $this->infSup = $infSup;

        return $this;
    }

    /**
     * Get infSup
     *
     * @return string
     */
    public function getInfSup()
    {
        return $this->infSup;
    }
    public function __construct()
    {
        $this->transport = new ArrayCollection();
    }

}

