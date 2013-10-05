<?php

namespace FB\groupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FB\groupeBundle\Entity\CommentaireRepository")
 */
class Commentaire
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
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrJaime", type="integer", nullable=true)
     */
    private $nbrJaime;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumn(name="id_commentateur", referencedColumnName="id")
     * 
     * 
     */
    private $commentateur;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumn(name="id_post", referencedColumnName="id")
     * 
     * 
     */
    private $post;
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
     * @return Commentaire
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
    }
    
    /**
     * Set message
     *
     * @param string $message
     * @return Commentaire
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Commentaire
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set nbrJaime
     *
     * @param integer $nbrJaime
     * @return Commentaire
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
    
    public function getCommentateur() {
        return $this->commentateur;
    }

    public function setCommentateur($commentateur) {
        $this->commentateur = $commentateur;
    }

    public function getPost() {
        return $this->post;
    }

    public function setPost($post) {
        $this->post = $post;
        return $this;
    }


}