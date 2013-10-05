<?php

namespace FB\groupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Utilisateur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FB\groupeBundle\Entity\UtilisateurRepository")
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
     * @ORM\OneToMany(targetEntity="Membre_Groupe", mappedBy="utilisateur" )
     **/
    private $groupes;
    
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="publicateur" )
     **/
    private $posts;
    
    /**
     * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="commentateur" )
     **/
    private $commentaires;
    
    
    
    
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
     * Add groupes
     *
     * @param \FB\groupeBundle\Entity\Membre_Groupe $groupes
     * @return Utilisateur
     */
    public function addGroupe(\FB\groupeBundle\Entity\Membre_Groupe $groupes)
    {
        $this->groupes[] = $groupes;
    
        return $this;
    }

    /**
     * Remove groupes
     *
     * @param \FB\groupeBundle\Entity\Membre_Groupe $groupes
     */
    public function removeGroupe(\FB\groupeBundle\Entity\Membre_Groupe $groupes)
    {
        $this->groupes->removeElement($groupes);
    }

    /**
     * Add posts
     *
     * @param \FB\groupeBundle\Entity\Post $posts
     * @return Utilisateur
     */
    public function addPost(\FB\groupeBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;
    
        return $this;
    }

    /**
     * Remove posts
     *
     * @param \FB\groupeBundle\Entity\Post $posts
     */
    public function removePost(\FB\groupeBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Add commentaires
     *
     * @param \FB\groupeBundle\Entity\Commentaire $commentaires
     * @return Utilisateur
     */
    public function addCommentaire(\FB\groupeBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires[] = $commentaires;
    
        return $this;
    }

    /**
     * Remove commentaires
     *
     * @param \FB\groupeBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(\FB\groupeBundle\Entity\Commentaire $commentaires)
    {
        $this->commentaires->removeElement($commentaires);
    }
}