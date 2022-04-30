<?php

namespace App\Entity;

use App\Repository\BacRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BacRepository::class)
 */
class Bac
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nombac;

    /**
     * @ORM\OneToMany(targetEntity=Inscription::class, mappedBy="lebac")
     */
    private $lesinscriptions;

    public function __construct()
    {
        $this->lesinscriptions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombac(): ?string
    {
        return $this->nombac;
    }

    public function setNombac(string $nombac): self
    {
        $this->nombac = $nombac;

        return $this;
    }

    /**
     * @return Collection|Inscription[]
     */
    public function getLesinscriptions(): Collection
    {
        return $this->lesinscriptions;
    }

    public function addLesinscription(Inscription $lesinscription): self
    {
        if (!$this->lesinscriptions->contains($lesinscription)) {
            $this->lesinscriptions[] = $lesinscription;
            $lesinscription->setLebac($this);
        }

        return $this;
    }

    public function removeLesinscription(Inscription $lesinscription): self
    {
        if ($this->lesinscriptions->removeElement($lesinscription)) {
            // set the owning side to null (unless already changed)
            if ($lesinscription->getLebac() === $this) {
                $lesinscription->setLebac(null);
            }
        }

        return $this;
    }
}
