<?php

namespace FB\groupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersistProgressPst
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PersistProgressPst
{
  
    /**
     * @var integer
     * 
     * @ORM\Column(name="id_groupe", type="bigint")
     * @ORM\Id
     */
    private $idGroupe;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrTotPost", type="integer", nullable=true)
     */
    private $nbrTotPost;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrPostImport", type="integer", nullable=true)
     */
    private $nbrPostImport;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrProgress", type="integer", nullable=true)
     */
    private $nbrProgress;
    /**
     * @var string
     *
     * @ORM\Column(name="id_post", type="string", length=255, nullable=true)
     */
    
    private $idPost;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrToJaime", type="integer", nullable=true)
     */
    private $nbrToJaime;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrJaimeImport", type="integer", nullable=true)
     */
    private $nbrJaimeImport;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrTotComment", type="integer", nullable=true)
     */
    private $nbrTotComment;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrComImport", type="integer", nullable=true)
     */
    private $nbrComImport;


    

    /**
     * Set idGroupe
     *
     * @param integer $idGroupe
     * @return PersistProgressPst
     */
    public function setIdGroupe($idGroupe)
    {
        $this->idGroupe = $idGroupe;
    
        return $this;
    }

    /**
     * Get idGroupe
     *
     * @return integer 
     */
    public function getIdGroupe()
    {
        return $this->idGroupe;
    }

    /**
     * Set nbrTotPost
     *
     * @param integer $nbrTotPost
     * @return PersistProgressPst
     */
    public function setNbrTotPost($nbrTotPost)
    {
        $this->nbrTotPost = $nbrTotPost;
    
        return $this;
    }

    /**
     * Get nbrTotPost
     *
     * @return integer 
     */
    public function getNbrTotPost()
    {
        return $this->nbrTotPost;
    }

    /**
     * Set idPost
     *
     * @param string $idPost
     * @return PersistProgressPst
     */
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;
    
        return $this;
    }

    /**
     * Get idPost
     *
     * @return string 
     */
    public function getIdPost()
    {
        return $this->idPost;
    }

    /**
     * Set nbrToJaime
     *
     * @param integer $nbrToJaime
     * @return PersistProgressPst
     */
    public function setNbrToJaime($nbrToJaime)
    {
        $this->nbrToJaime = $nbrToJaime;
    
        return $this;
    }

    /**
     * Get nbrToJaime
     *
     * @return integer 
     */
    public function getNbrToJaime()
    {
        return $this->nbrToJaime;
    }

    /**
     * Set nbrJaimeImport
     *
     * @param integer $nbrJaimeImport
     * @return PersistProgressPst
     */
    public function setNbrJaimeImport($nbrJaimeImport)
    {
        $this->nbrJaimeImport = $nbrJaimeImport;
    
        return $this;
    }

    /**
     * Get nbrJaimeImport
     *
     * @return integer 
     */
    public function getNbrJaimeImport()
    {
        return $this->nbrJaimeImport;
    }

    /**
     * Set nbrTotComment
     *
     * @param integer $nbrTotComment
     * @return PersistProgressPst
     */
    public function setNbrTotComment($nbrTotComment)
    {
        $this->nbrTotComment = $nbrTotComment;
    
        return $this;
    }

    /**
     * Get nbrTotComment
     *
     * @return integer 
     */
    public function getNbrTotComment()
    {
        return $this->nbrTotComment;
    }

    /**
     * Set nbrComImport
     *
     * @param integer $nbrComImport
     * @return PersistProgressPst
     */
    public function setNbrComImport($nbrComImport)
    {
        $this->nbrComImport = $nbrComImport;
    
        return $this;
    }

    /**
     * Get nbrComImport
     *
     * @return integer 
     */
    public function getNbrComImport()
    {
        return $this->nbrComImport;
    }

    /**
     * Set nbrPostImport
     *
     * @param integer $nbrPostImport
     * @return PersistProgressPst
     */
    public function setNbrPostImport($nbrPostImport)
    {
        $this->nbrPostImport = $nbrPostImport;
    
        return $this;
    }

    /**
     * Get nbrPostImport
     *
     * @return integer 
     */
    public function getNbrPostImport()
    {
        return $this->nbrPostImport;
    }

    /**
     * Set nbrProgress
     *
     * @param integer $nbrProgress
     * @return PersistProgressPst
     */
    public function setNbrProgress($nbrProgress)
    {
        $this->nbrProgress = $nbrProgress;
    
        return $this;
    }

    /**
     * Get nbrProgress
     *
     * @return integer 
     */
    public function getNbrProgress()
    {
        return $this->nbrProgress;
    }
}