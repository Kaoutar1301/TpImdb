<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $nom;

    #[ORM\Column(type: 'string', length: 100)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
    private $portrait;

    #[ORM\OneToMany(mappedBy: 'realisateur', targetEntity: Film::class)]
    private $film_realise;

    public function __construct()
    {
        $this->film_realise = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPortrait(): ?string
    {
        return $this->portrait;
    }

    public function setPortrait(string $portrait): self
    {
        $this->portrait = $portrait;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilmRealise(): Collection
    {
        return $this->film_realise;
    }

    public function addFilmRealise(Film $filmRealise): self
    {
        if (!$this->film_realise->contains($filmRealise)) {
            $this->film_realise[] = $filmRealise;
            $filmRealise->setRealisateur($this);
        }

        return $this;
    }

    public function removeFilmRealise(Film $filmRealise): self
    {
        if ($this->film_realise->removeElement($filmRealise)) {
            // set the owning side to null (unless already changed)
            if ($filmRealise->getRealisateur() === $this) {
                $filmRealise->setRealisateur(null);
            }
        }

        return $this;
    }
}
