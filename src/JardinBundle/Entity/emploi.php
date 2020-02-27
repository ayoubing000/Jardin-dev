<?php

namespace JardinBundle\Entity;

use AncaRebeca\FullCalendarBundle\Model\FullCalendarEvent;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JardinBundle\Repository\emploiRepository;



/**
 * emploi
 *
 * @ORM\Table(name="emploi")
 * @ORM\Entity(repositoryClass="JardinBundle\Repository\emploiRepository")
 */
class emploi
{
    /**
     * @return mixed
     */
    public function getEmployees()
    {
        return $this->employees;
    }

    /**
     * @param mixed $employees
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;
    }
    /**
     * @ORM\OneToOne(targetEntity="JardinBundle\Entity\employee", inversedBy="emplois")
     */
    private $employees;

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
     * @ORM\Column(name="jour", type="date")
     */
    private $jour;

    /**
     * @var \string
     *
     * @ORM\Column(name="description", type="string")
     */
    private $description;



    /**
     * @return \string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param \string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * Set jour
     *
     * @param \DateTime $jour
     *
     * @return emploi
     */
    public function setJour($jour)
    {
        $this->jour = $jour;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get jour
     *
     * @return \DateTime
     */
    public function getJour()
    {
        return $this->jour;
    }









    /**
     * @return array
     */
    public function toArray()
    {
        // TODO: Implement toArray() method.
    }
}

