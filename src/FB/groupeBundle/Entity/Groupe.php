<?php

namespace FB\groupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Groupe
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Groupe
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
     * @ORM\Column(name="Nom", type="string", length=200)
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
     * @ORM\Column(name="Type", type="string", length=20)
     */
    
    private $type;

    /**
     * @var text
     *
     * @ORM\Column(name="Description", type="text")
     */
    private $description;
 
    /**
     * @ORM\OneToMany(targetEntity="MembreGroupe", mappedBy="groupe", cascade={"persist", "remove"})
     * 
     **/
    
    private $membres;
   
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="groupe", cascade={"persist", "remove"})
     * 
     **/
    
    private $posts;
    
    /**
     * Set id
     *
     * @param string $id
     * @return Groupe
     */
    
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
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
     * Set nom
     *
     * @param string $nom
     * @return Groupe
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
     * @return Groupe
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
     * Set type
     *
     * @param string $type
     * @return Groupe
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
     * @param text $description
     * @return Groupe
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
   
    
    public function getMembres() {
        return $this->membres;
    }

   public function addMembre(MembreGroupe $membre){
       $this->membres[]=$membre;
       $membre->setGroupe($this);
   }
    
     

    /**
     * Remove membres
     *
     * @param MembreGroupe $membres
     */
    public function removeMembre(MembreGroupe $membre)
    {
        $this->membres->removeElement($membre);
    }

    /**
     * Add posts
     *
     * @param Post $posts
     * @return Groupe
     */
    public function addPost(Post $post)
    {
        $this->posts[] = $post;
    
        return $this;
    }

    /**
     * Remove posts
     *
     * @param Post $posts
     */
    public function removePost(Post $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->membres = new ArrayCollection();
        $this->posts = new ArrayCollection();
    }
    
}