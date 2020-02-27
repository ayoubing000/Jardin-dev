<?php

namespace JardinBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * contrat
 *
 * @ORM\Table(name="contrat")
 * @ORM\Entity(repositoryClass="JardinBundle\Repository\contratRepository")
 */
class contrat
{
    /**
     * @return mixed
     */
    public function getEmploy()
    {
        return $this->employ;
    }

    /**
     * @param mixed $employ
     */
    public function setEmploy($employ)
    {
        $this->employ = $employ;
    }
    /**
     * @ORM\OneToOne(targetEntity="JardinBundle\Entity\employee", inversedBy="contrats")
     */
    private $employ;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_signature", type="date")
     */
    private $dateSignature;

    /**
     * @var DateTime
     * @Assert\DateTime()
     * @Assert\Type(type="DateTime")
     * @ORM\Column(name="date_debut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var DateTime
     * @Assert\DateTime()
     * @Assert\Type(type="DateTime")
     * @Assert\GreaterThan(propertyPath="dateDebut")
     * @ORM\Column(name="date_fin", type="datetime")
     */
    private $dateFin;

    /**
     * @var DateTime
     * @Assert\DateTime()
     *  @Assert\Type(type="DateTime")
     * @Assert\GreaterThan(propertyPath="dateDebut")
     * @Assert\LessThan(propertyPath="dateFin")
     * @ORM\Column(name="date_resiliation", type="datetime")
     */
    private $dateResiliation;


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
     * Set type
     *
     * @param string $type
     *
     * @return contrat
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set dateSignature
     *
     * @param \DateTime $dateSignature
     *
     * @return contrat
     */
    public function setDateSignature($dateSignature)
    {
        $this->dateSignature = $dateSignature;

        return $this;
    }

    /**
     * Get dateSignature
     *
     * @return \DateTime
     */
    public function getDateSignature()
    {
        return $this->dateSignature;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return contrat
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return contrat
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set dateResiliation
     *
     * @param \DateTime $dateResiliation
     *
     * @return contrat
     */
    public function setDateResiliation($dateResiliation)
    {
        $this->dateResiliation = $dateResiliation;

        return $this;
    }

    /**
     * Get dateResiliation
     *
     * @return \DateTime
     */
    public function getDateResiliation()
    {
        return $this->dateResiliation;
    }
}

