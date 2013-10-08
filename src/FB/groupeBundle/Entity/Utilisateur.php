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
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=100, nullable=true)
     */
    private $genre;
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
     * Set genre
     *
     * @param string $genre
     * @return Utilisateur
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    
        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
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
    
}