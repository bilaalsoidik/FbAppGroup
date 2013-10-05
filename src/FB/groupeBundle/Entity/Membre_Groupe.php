<?php

namespace FB\groupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Membre_Groupe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FB\groupeBundle\Entity\Membre_GroupeRepository")
 */
class Membre_Groupe
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
    * @ORM\ManyToOne(targetEntity="Groupe")
    * @ORM\JoinColumn(name="id_groupe", referencedColumnName="id")
    */
    private $groupe;

    /**
     * @ORM\ManyToOne(targetEntity="Utilisateur")
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
     * @return Membre_Groupe
     */
    public function setGroupe($groupe)
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
     * @param string $idUtilisateur
     * @return Membre_Groupe
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
     * @return Membre_Groupe
     */
    public function setEstAdnin($estAdmin)
    {
        $this->estAdmin = $estAdmin;
    
        return $this;
    }

    /**
     * Get estAdmin
     *
     * @return boolean 
     */
    public function getEstAdnin()
    {
        return $this->estAdmin;
    }
     
    public function __construct(){
        //par defaut
        $this->estAdmin=false;
    }
}