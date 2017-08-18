<?php
/**
 * Created by PhpStorm.
 * User: stagiaire
 * Date: 12/06/2017
 * Time: 16:23
 */

namespace TODO\Entity;


class Task
{
    private $id_task;
    private $titre;
    private $resume;
    private $content;
    private $created_at;
    private $id_user;
    private $id_statut;


    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());  //pas liées au formulaire, ajout auto
    }

    /**
     * @return mixed
     */
    public function getIdTask()
    {
        return $this->id_task;
    }

    /**
     * @param mixed $id_task
     */
    public function setIdTask($id_task)
    {
        $this->id_task = $id_task;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * @param mixed $resume
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt($str = false)
    {
        if($str == false){
            return $this->created_at;
        }else{
            return $this->created_at->format('Y-m-d\TH:i:s-u');
        }

    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt(\DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
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


}