<?php

namespace FB\groupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MembreGroupe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class MembreGroupe
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
    * @ORM\ManyToOne(targetEntity="Groupe",inversedBy="membres")
    * @ORM\JoinColumn(name="id_groupe", referencedColumnName="id")
    */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur",inversedBy="groupes")
     * @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id")
     */
    private $utilisateur;

    /** 
     * @var boolean
     *
     * @ORM\Column(name="estAdmin", type="boolean", nullable=true)
     */
    private $estAdmin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estCreateur", type="boolean", nullable=true)
     */
    private $estCreateur;

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
     * Set idGroupe
     *
     * @param integer $idGroupe
     * @return MembreGroupe
     */
    public function setGroupe(Groupe $groupe)
    {
        $this->groupe = $groupe;
       
        return $this;
    }

    /**
     * Get idGroupe
     *
     * @return integer 
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set idUtilisateur
     *
     * @param string $utilisateur
     * @return MembreGroupe
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    
        return $this;
    }

    /**
     * Get idUtilisateur
     *
     * @return string 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

  

    /**
     * Get estAdmin
     *
     * @return boolean 
     */
    
     
    public function __construct(){
        //par defaut
        $this->estAdmin=false;
        $this->estCreateur=false;
    }
    

    /**
     * Set estAdmin
     *
     * @param boolean $estAdmin
     * @return MembreGroupe
     */
    public function setEstAdmin($estAdmin)
    {
        $this->estAdmin = $estAdmin;
    
        return $this;
    }

    /**
     * Get estAdmin
     *
     * @return boolean 
     */
    public function getEstAdmin()
    {
        return $this->estAdmin;
    }

    /**
     * Set estCreateur
     *
     * @param boolean $estCreateur
     * @return MembreGroupe
     */
    public function setEstCreateur($estCreateur)
    {
        $this->estCreateur = $estCreateur;
    
        return $this;
    }

    /**
     * Get estCreateur
     *
     * @return boolean 
     */
    public function getEstCreateur()
    {
        return $this->estCreateur;
    }
}