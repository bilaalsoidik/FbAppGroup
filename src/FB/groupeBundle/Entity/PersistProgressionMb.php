<?php

namespace FB\groupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SuiviProgression
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PersistProgressionMb
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
     * @ORM\Column(name="nbrMembre", type="integer", nullable=true)
     */
    private $nbrMembre;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrProgress", type="integer", nullable=true)
     */
    private $nbrProgress;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbrAdmin", type="integer", nullable=true)
     */
    private $nbrAdmin;


    /**
     * Set idGroupe
     *
     * @param integer $idGroupe
     * @return SuiviProgression
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
     * Set nbrMembre
     *
     * @param integer $nbrMembre
     * @return SuiviProgression
     */
    public function setNbrMembre($nbrMembre)
    {
        $this->nbrMembre = $nbrMembre;
    
        return $this;
    }

    /**
     * Get nbrMembre
     *
     * @return integer 
     */
    public function getNbrMembre()
    {
        return $this->nbrMembre;
    }

    /**
     * Set nnbProgress
     *
     * @param integer $nnbProgress
     * @return SuiviProgression
     */
    public function setNbrProgress($nnbProgress)
    {
        $this->nbrProgress = $nnbProgress;
    
        return $this;
    }

    /**
     * Get nnbProgress
     *
     * @return integer 
     */
    public function getNbrProgress()
    {
        return $this->nbrProgress;
    }

    /**
     * Set nbrAdmin
     *
     * @param integer $nbrAdmin
     * @return SuiviProgression
     */
    
    public function setNbrAdmin($nbrAdmin)
    {
        $this->nbrAdmin = $nbrAdmin;
        return $this;
    }

    /**
     * Get nbrAdmin
     *
     * @return integer 
     */
    public function getNbrAdmin()
    {
        return $this->nbrAdmin;
    }
}