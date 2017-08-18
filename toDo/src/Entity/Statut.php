<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 12/06/2017
 * Time: 16:23
 */

namespace TODO\Entity;


class Statut
{
    private $id_statut;
    private $libelle;
    private $created_at;

    public function __toString(){ // Permet de faire echo d'une instance ailleurs

        // TODO : Implement __toString() method.
        return $this->getLibelle();
    }

    // à utiliser pour le cas où l'instance serait appelée dans le service FormFactory et la méthode Select()
    public function getValue(){
        return $this->getIdStatut();

    }


    /**
     * @return mixed
     */
    public function getIdStatut()
    {
        return $this->id_statut;
    }

    /**
     * @param mixed $id_statut
     */
    public function setIdStatut($id_statut)
    {
        $this->id_statut = $id_statut;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

}