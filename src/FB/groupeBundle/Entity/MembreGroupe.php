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
    * @ORM\ManyToOne(targetEntity="Groupe",inversedBy="membres")
    * @ORM\Id
    * @ORM\JoinColumn(name="id_groupe", referencedColumnName="id")
    */
    private $groupe;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Utilisateur",inversedBy="groupes")
     * @ORM\Id
     * @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id")
     */
    private $utilisateur;

    public function __construct(Groupe $gp, Utilisateur $usr){
       $this->groupe=$gp;
       $this->utilisateur=$usr;
        //par defaut
        $this->estAdmin=false;
        
    }
    /** 
     * @var boolean
     *
     * @ORM\Column(name="estAdmin", type="boolean", nullable=true)
     */
    private $estAdmin;

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

    

}