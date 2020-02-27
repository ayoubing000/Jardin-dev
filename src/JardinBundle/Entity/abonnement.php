<?php

namespace JardinBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * abonnement
 *
 * @ORM\Table(name="abonnement")
 * @ORM\Entity(repositoryClass="JardinBundle\Repository\abonnementRepository")
 */
class abonnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_debut", type="date",nullable=true)
     */
    private $dataDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date",nullable=true)
     */
    private $dateFin;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="statu", type="string", length=255)
     */
    private $statu = "no valide";

    /**
     * @var string
     *
     * @ORM\Column(name="statu_paiment", type="string", length=255)
     */
    private $statu_paiment ="en attente";

    /**
     * @ORM\OneToOne(targetEntity="enfant" , mappedBy="abonnment")
     * @ORM\JoinColumn(name="enf_id",referencedColumnName="id")
     */

    private  $enfant;

    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getStatu()
    {
        return $this->statu;
    }

    /**
     * @param string $statu
     */
    public function setStatu($statu)
    {
        $this->statu = $statu;
    }

    /**
     * @return string
     */
    public function getStatuPaiment()
    {
        return $this->statu_paiment;
    }

    /**
     * @param string $statu_paiment
     */
    public function setStatuPaiment($statu_paiment)
    {
        $this->statu_paiment = $statu_paiment;
    }


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
     * Set dataDebut
     *
     * @param \DateTime $dataDebut
     *
     * @return abonnement
     */
    public function setDataDebut($dataDebut)
    {
        $this->dataDebut = $dataDebut;

        return $this;
    }

    /**
     * Get dataDebut
     *
     * @return \DateTime
     */
    public function getDataDebut()
    {
        return $this->dataDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return abonnement
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
     * Set type
     *
     * @param string $type
     *
     * @return abonnement
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
     * Set description
     *
     * @param string $description
     *
     * @return abonnement
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
     * @return mixed
     */
    public function getEnfant()
    {
        return $this->enfant;
    }

    /**
     * @param mixed $enfant
     */
    public function setEnfant($enfant)
    {
        $this->enfant = $enfant;
    }



}

