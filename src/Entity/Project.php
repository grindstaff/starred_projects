<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->active = true;
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $modifiedAt;

    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

     /**
     * @ORM\PreUpdate
     */
    public function setModifiedAtValue()
    {
        $this->$modifiedAt = new \DateTime();
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $repositoryId;

    public function getRepositoryId()
    {
        return $this->repositoryId;
    }

    public function setRepositoryId($repositoryId)
    {
        $this->repositoryId = $repositoryId;
    }

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $url;

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $repository_creation_date;

    public function getRepositoryCreationDate()
    {
        return $this->repository_creation_date;
    }

    public function setRepositoryCreationDate($date)
    {
        $this->repository_creation_date = $date;
    }

    /**
     * @ORM\Column(type="datetime")
     */
    private $repository_last_push_date;

    public function getRepositoryLastPushDate()
    {
        return $this->repository_last_push_date;
    }

    public function setRepositoryLastPushDate($date)
    {
        $this->repository_last_push_date = $date;
    }

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $stars;

    public function getStars()
    {
        return $this->stars;
    }

    public function setStars($stars)
    {
        $this->stars = $stars;
    }
}
