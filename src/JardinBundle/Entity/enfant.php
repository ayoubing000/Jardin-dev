<?php

namespace JardinBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * enfant
 *
 * @ORM\Table(name="enfant")
 * @ORM\Entity(repositoryClass="JardinBundle\Repository\enfantRepository")
 */
class enfant
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
     * @Assert\File(maxSize="500k")
     */
    public $file;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $nomImage;
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_naissaince", type="date")
     */
    private $dateNaissaince;


    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @ORM\OneToOne(targetEntity="abonnement", inversedBy="enfant")
     * @ORM\JoinColumn(name="matricul_abn", referencedColumnName="id")
     */

    private  $abonnment;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="enfants")
     * @ORM\JoinColumn(name="matricul_prt", referencedColumnName="id")
     */

    private  $parent;

    /**
     * @ORM\ManyToOne(targetEntity="Repa")
     * @ORM\JoinColumn(name="id_repa",referencedColumnName="id")
     */
    private $repa;

    public function getWebPath()
    {
        return null === $this->nomImage ? null : $this->getUploadDir().'/'.$this->nomImage;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire dans lequel sauvegarder les photos de profil
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw when displaying uploaded doc/image in the view.
        return 'images';
    }

    public function uploadProfilePicture()
    {
        // Nous utilisons le nom de fichier original, donc il est dans la pratique
        // nécessaire de le nettoyer pour éviter les problèmes de sécurité

        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $this->file->getClientOriginalName());

        // On sauvegarde le nom de fichier
        $this->nomImage = $this->file->getClientOriginalName();

        // La propriété file ne servira plus
        $this->file = null;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return enfant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return enfant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateNaissaince
     *
     * @param \DateTime $dateNaissaince
     *
     * @return enfant
     */
    public function setDateNaissaince($dateNaissaince)
    {
        $this->dateNaissaince = $dateNaissaince;

        return $this;
    }

    /**
     * Get dateNaissaince
     *
     * @return \DateTime
     */
    public function getDateNaissaince()
    {
        return $this->dateNaissaince;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return enfant
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getAbonnment()
    {
        return $this->abonnment;
    }

    /**
     * @param mixed $abonnment
     */
    public function setAbonnment($abonnment)
    {
        $this->abonnment = $abonnment;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getNomImage()
    {
        return $this->nomImage;
    }

    /**
     * @param mixed $nomImage
     */
    public function setNomImage($nomImage)
    {
        $this->nomImage = $nomImage;
    }
    /**
     * @ORM\ManyToMany(targetEntity="InscriptionEvenement",inversedBy="enfants")
     */
    private $inscriptionEvenements;


    /**
     * @return mixed
     */
    public function getRepa()
    {
        return $this->repa;
    }

    /**
     * @param mixed $repa
     */
    public function setRepa($repa)
    {
        $this->repa = $repa;
    }

    /**
     * @return mixed
     */
    public function getInscriptionEvenements()
    {
        return $this->inscriptionEvenements;
    }

    /**
     * @param mixed $inscriptionEvenements
     */
    public function setInscriptionEvenements($inscriptionEvenements)
    {
        $this->inscriptionEvenements = $inscriptionEvenements;
    }

    /**
     * enfant constructor.
     */
    public function __construct()
    {
        $this->inscriptionEvenements = new ArrayCollection();
    }
}

