<?php

namespace FB\groupeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Historique
{
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id_utilisateur", type="bigint")
     * @ORM\Id
     */
    private $idUtilisateur;

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
     * @ORM\Column(name="dernier_membre_import", type="integer")
     */
    private $dernierMembreImport;

    /**
     * @var string
     *
     * @ORM\Column(name="dernier_post_importe_selon_UT", type="string", length=255)
     */
    private $dernierPostImporteSelonUT;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_dernier_port_impot_UT", type="datetime")
     */
    private $dateDernierPostImpotUT;

    /**
     * @var string
     *
     * @ORM\Column(name="dernier_post_importe_selon_CT", type="string", length=255)
     */
    private $dernierPostImporteSelonCT;

    /**
     * @var string
     *
     * @ORM\Column(name="date_dernier_post_import_CT", type="string", length=255)
     */
    private $dateDernierPostImportCT;

function __construct($idUtilisateur, $idGroupe) {
        $this->idUtilisateur = $idUtilisateur;
        $this->idGroupe = $idGroupe;
    }
    
    
    /**
     * Set idUtilisateur
     *
     * @param integer $idUtilisateur
     * @return Historique
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
    
        return $this;
    }

    /**
     * Get idUtilisateur
     *
     * @return integer 
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set idGroupe
     *
     * @param integer $idGroupe
     * @return Historique
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
     * Set dernierMembreImport
     *
     * @param integer $dernierMembreImport
     * @return Historique
     */
    public function setDernierMembreImport($dernierMembreImport)
    {
        $this->dernierMembreImport = $dernierMembreImport;
    
        return $this;
    }

    /**
     * Get dernierMembreImport�
     *
     * @return integer 
     */
    public function getDernierMembreImport()
    {
        return $this->dernierMembreImport;
    }

    /**
     * Set dernierPostImporteSelonUT
     *
     * @param string $dernierPostImporteSelonUT
     * @return Historique
     */
    public function setDernierPostImporteSelonUT($dernierPostImporteSelonUT)
    {
        $this->dernierPostImporteSelonUT = $dernierPostImporteSelonUT;
    
        return $this;
    }

    /**
     * Get dernierPostImporteSelonUT
     *
     * @return string 
     */
    public function getDernierPostImporteSelonUT()
    {
        return $this->dernierPostImporteSelonUT;
    }

    /**
     * Set dateDernierPortImpotUT
     *
     * @param \DateTime $dateDernierPortImpotUT
     * @return Historique
     */
    public function setDateDernierPostImpotUT($dateDernierPortImpotUT)
    {
        $this->dateDernierPostImpotUT = $dateDernierPortImpotUT;
    
        return $this;
    }

    /**
     * Get dateDernierPortImpotUT
     *
     * @return \DateTime 
     */
    public function getDateDernierPostImpotUT()
    {
        return $this->dateDernierPostImpotUT;
    }

    /**
     * Set dernierPostImporteSelonCT
     *
     * @param string $dernierPostImporteSelonCT
     * @return Historique
     */
    public function setDernierPostImporteSelonCT($dernierPostImporteSelonCT)
    {
        $this->dernierPostImporteSelonCT = $dernierPostImporteSelonCT;
    
        return $this;
    }

    /**
     * Get dernierPostImporteSelonCT
     *
     * @return string 
     */
    public function getDernierPostImporteSelonCT()
    {
        return $this->dernierPostImporteSelonCT;
    }

    /**
     * Set dateDernierPostImportCT
     *
     * @param string $dateDernierPostImportCT
     * @return Historique
     */
    public function setDateDernierPostImportCT($dateDernierPostImportCT)
    {
        $this->dateDernierPostImportCT = $dateDernierPostImportCT;
    
        return $this;
    }

    /**
     * Get dateDernierPostImportCT
     *
     * @return string 
     */
    public function getDateDernierPostImportCT()
    {
        return $this->dateDernierPostImportCT;
    }
}
