<?php

namespace JardinBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kommentaire
 *
 * @ORM\Table(name="kommentaire")
 * @ORM\Entity(repositoryClass="JardinBundle\Repository\KommentaireRepository")
 */
class Kommentaire
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
     * @var string
     *
     * @ORM\Column(name="contenue", type="text")
     */
    private $contenue;

    /**
     * @ORM\ManyToOne(targetEntity="Repaextra")
     * @ORM\JoinColumn(name="id_repaextra",referencedColumnName="id")
     */
    private $repaextra;
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
     * Set contenue
     *
     * @param string $contenue
     *
     * @return Kommentaire
     */
    public function setContenue($contenue)
    {
        $this->contenue = $contenue;

        return $this;
    }
        /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreate", type="datetime", nullable=true)
     */
    private $datecreate;
    /**
     * Get contenue
     *
     * @return string
     */
    public function getContenue()
    {
        return $this->contenue;
    }

 


            /**
     * @return \DateTime
     */
    public function getDatecreate()
    {
        return $this->datecreate;
    }

    /**
     * @param \DateTime $datecreate
     */
    public function setDatecreate($datecreate)
    {
        $this->datecreate = $datecreate;
    }

                /**
     * @return mixed
     */
    public function getRepaextra()
    {
        return $this->repaextra;
    }

    /**
     * @param mixed $repaextra
     */
    public function setRepaextra($repaextra)
    {
        $this->repaextra = $repaextra;
    }


    /**
     * @ORM\Column(type="integer",length=11)
     */
    private $rating;


        /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }
}

