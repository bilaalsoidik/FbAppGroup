<?php

namespace FB\groupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Utilisateur
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=100)
     */
    private $username;
    /**
     * @var string
     *
     * @ORM\Column(name="nomEntier", type="string", length=100)
     */
    private $nomEntier;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;
    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100)
     */
    private $prenom;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=100, nullable=true)
     */
    private $sexe;
    /**
     * @ORM\OneToMany(targetEntity="MembreGroupe", mappedBy="utilisateur" )
     **/
    private $groupes;
    
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="publicateur" )
     **/
    private $posts;
    
    function __construct() {
        $this->commentaires=new ArrayCollection();
        $this->groupes  =new ArrayCollection();
        $this->posts    =new ArrayCollection();
        
    }

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
     * Set id
     *
     * @param string $id
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }
    
    /**
     * Set nom
     *
     * @param string $nom
     * @return Utilisateur
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
     * Set email
     *
     * @param string $email
     * @return Utilisateur
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     * @return Utilisateur
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;
    
        return $this;
    }

    /**
     * Get sexe
     *
     * @return string 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    public function getGroupes() {
        return $this->groupes;
    }

    public function getPosts() {
        return $this->posts;
    }

    public function getCommentaires() {
        return $this->commentaires;
    }

    /**
     * Add posts
     *
     * @param Post $posts
     * @return Utilisateur
     */
    public function addPost(Post $posts)
    {
        $this->posts[] = $posts;
    
        return $this;
    }

    /**
     * Remove posts
     *
     * @param Post $posts
     */
    public function removePost(Post $posts)
    {
        $this->posts->removeElement($posts);
    }


    /**
     * Add groupes
     *
     * @param  MembreGroupe $membreGroupes
     * @return Utilisateur
     */
    public function addGroupe(MembreGroupe $groupe)
    {
        $this->groupes[] = $groupe;
    
        return $this;
    }

    /**
     * Remove groupes
     *
     * @param $membreGroupes
     */
    public function removeGroupe(MembreGroupe $groupe)
    {
        $this->groupes->removeElement($groupe);
    }

    /**
     * Get groupes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    

    /**
     * Set username
     *
     * @param string $username
     * @return Utilisateur
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set nomEntier
     *
     * @param string $nomEntier
     * @return Utilisateur
     */
    public function setNomEntier($nomEntier)
    {
        $this->nomEntier = $nomEntier;
    
        return $this;
    }

    /**
     * Get nomEntier
     *
     * @return string 
     */
    public function getNomEntier()
    {
        return $this->nomEntier;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Utilisateur
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
}