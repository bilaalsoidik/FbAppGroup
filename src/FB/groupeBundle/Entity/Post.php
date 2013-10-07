<?php

namespace FB\groupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FB\groupeBundle\Entity\PostRepository")
 */
class Post
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="string", length=50)
     * @ORM\Id
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=15)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable = true)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255,nullable = true)
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255,nullable = true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255 , nullable = true)
     */
    private $source;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable = true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable = true)
     */
    private $description;

    /**
     * @var \DateTime  
     *
     * @ORM\Column(name="date_heur_creation", type="datetime")
     */
    private $dateHeurCreation;

     /**
     * @var integer
     *
     * @ORM\Column(name="nbrJaime", type="integer", nullable = true)
     */
    private $nbrJaime;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrComment", type="integer", nullable = true)
     */
    private $nbrComment;
    
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
     * 
     * @ORM\ManyToOne(targetEntity="Utilisateur", inversedBy="posts")
     * @ORM\JoinColumn(name="id_publicateur", referencedColumnName="id") 
     */
    private $publicateur;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Groupe", inversedBy="posts")
     * @ORM\JoinColumn(name="id_groupe", referencedColumnName="id") 
     */
    private $groupe;
    
    /**
    * @ORM\ManyToMany(targetEntity="Utilisateur")
    * @ORM\JoinTable(name="Jaimes",
    * joinColumns={@ORM\JoinColumn(name="id_post", 
    * referencedColumnName="id")},
    * inverseJoinColumns={@ORM\JoinColumn(name="id_aimant",
    * referencedColumnName="id")}
    * )
    */
    private $jaimes;
    
    /**
     * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="post", cascade={"persist", "remove"} )
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
     * Set type
     *
     * @param string $type
     * @return Post
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
     * Set message
     *
     * @param string $message
     * @return Post
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Post
     */
    public function setLien($lien)
    {
        $this->lien = $lien;
    
        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Post
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    
        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Post
     */
    public function setSource($source)
    {
        $this->source = $source;
    
        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Post
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
     * Set description
     *
     * @param string $description
     * @return Post
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

    /**
     * Set dateHeurCreation
     *
     * @param \DateTime $dateHeurCreation
     * @return Post
     */
    public function setDateHeurCreation($dateHeurCreation)
    {
        $this->dateHeurCreation = $dateHeurCreation;
    
        return $this;
    }

    /**
     * Get dateHeurCreation
     *
     * @return \DateTime 
     */
    public function getDateHeurCreation()
    {
        return $this->dateHeurCreation;
    }
    /**
     * Set nbrJaime
     *
     * @param integer $nbrJaime
     * @return Post
     */
    public function setNbrJaime($nbrJaime)
    {
        $this->nbrJaime = $nbrJaime;
    
        return $this;
    }

    /**
     * Get nbrJaime
     *
     * @return integer 
     */
    public function getNbrJaime()
    {
        return $this->nbrJaime;
 
        }
/**
     * Set nbrComment
     *
     * @param integer $nbrComment
     * @return Post
     */ 
        
         public function setNbrComment($nbrComment)
    {
        $this->nbrComment = $nbrComment;
    
        return $this;
    }

    /**
     * Get nbrJaime
     *
     * @return integer 
     */
    public function getNbrComment()
    {
        return $this->nbrComment;
 
        }
    public function getPublicateur() {
        return $this->publicateur;
    }

    public function getJaimes() {
        return $this->jaimes;
    }
    
    public function setPublicateur($publicateur) {
        $this->publicateur = $publicateur;
    }
    
    function __construct() {
        
        $this->jaimes=new ArrayCollection();
        $this->commentaires=new ArrayCollection();
        //par defaut
        $this->nbrComment=0;
        $this->nbrJaime=0;
        
    }
    public function getCommentaires() {
        return $this->commentaires;
    }

  public function addCommentaire(Commentaire $comment){
    $this->commentaires[]=$comment;
    $comment->setPost($this);
  }

    /**
     * Add jaimes
     *
     * @param \FB\groupeBundle\Entity\Utilisateur $jaimes
     * @return Post
     */
    public function addJaime(Utilisateur $User_aime)
    {
        $this->jaimes[] = $User_aime;
    
        return $this;
    }

    /**
     * Remove jaimes
     *
     * @param \FB\groupeBundle\Entity\Utilisateur $jaimes
     */
    public function removeJaime(Utilisateur $User_aime)
    {
        $this->jaimes->removeElement($User_aime);
    }

    /**
     * Remove commentaires
     *
     * @param \FB\groupeBundle\Entity\Commentaire $commentaires
     */
    public function removeCommentaire(Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Set groupe
     *
     * @param \FB\groupeBundle\Entity\Groupe $groupe
     * @return Post
     */
    public function setGroupe(\FB\groupeBundle\Entity\Groupe $groupe = null)
    {
        $this->groupe = $groupe;
    
        return $this;
    }

    /**
     * Get groupe
     *
     * @return \FB\groupeBundle\Entity\Groupe 
     */
    public function getGroupe()
    {
        return $this->groupe;
    }
}