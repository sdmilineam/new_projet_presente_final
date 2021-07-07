<?php

namespace App\Entity;

use App\Repository\ProfilRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfilRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Profil
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Titre;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $media;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="profils")
     */
    private $author;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $CreatAt;

    /**
     * @ORM\Column(type="datetime_immutable",nullable=true)
     */
    private $updateAt;

    /**
     * @ORM\Column(type="text")
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity=user::class, mappedBy="profil")
     */
    private $comment;

    public function __construct()
    {
        $this->comment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(?string $media): self
    {
        $this->media = $media;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCreatAt(): ?\DateTimeImmutable
    {
        return $this->CreatAt;
    }

    public function setCreatAt(\DateTimeImmutable $CreatAt): self
    {
        $this->CreatAt = new \DateTimeImmutable();

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(user $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment[] = $comment;
            $comment->setProfil($this);
        }

        return $this;
    }

    public function removeComment(user $comment): self
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getProfil() === $this) {
                $comment->setProfil(null);
            }
        }

        return $this;
    }
}
