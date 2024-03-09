<?php

namespace App\Domain\Organization;

use App\Model\Database\Entity\TAdminautFields;
use App\Model\Database\Entity\TId;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Organization\OrganizationRepository")
 * @ORM\Table(name="`organizations`")
 * @ORM\HasLifecycleCallbacks
 */
class Organization
{
    use TId;
    use TAdminautFields;

    /** @ORM\Column(name="photo_main", type="integer", length=11, nullable=TRUE, unique=false) */
    private ?int $photoMainId;

    /** @ORM\Column(name="photo_1", type="integer", length=11, nullable=TRUE, unique=false) */
    private ?int $photo1Id;

    /** @ORM\Column(name="photo_2", type="integer", length=11, nullable=TRUE, unique=false) */
    private ?int $photo2Id;

    /** @ORM\Column(name="photo_3", type="integer", length=11, nullable=TRUE, unique=false) */
    private ?int $photo3Id;

    /** @ORM\Column(name="photo_4", type="integer", length=11, nullable=TRUE, unique=false) */
    private ?int $photo4Id;

    /** @ORM\Column(name="title", type="string", length=255, nullable=FALSE, unique=false) */
    private string $title;

    /** @ORM\Column(name="status", type="string", length=255, nullable=FALSE, unique=false) */
    private string $status;

    /** @ORM\Column(name="date_published", type="date", nullable=TRUE, unique=false) */
    private ?\DateTime $publishedDate;

    /** @ORM\Column(name="show_from", type="datetime", nullable=TRUE, unique=false) */
    private ?\DateTime $showFrom;

    /** @ORM\Column(name="show_to", type="datetime", nullable=TRUE, unique=false) */
    private ?\DateTime $showTo;

    /** @ORM\Column(name="show_on_homepage", type="boolean", nullable=FALSE, unique=false) */
    private bool $showOnHomepage;

    /** @ORM\Column(name="perex", type="string", nullable=FALSE, unique=false) */
    private string $perex;

    /** @ORM\Column(name="article", type="string", nullable=FALSE, unique=false) */
    private string $article;

    /** @ORM\Column(name="homepage", type="string", nullable=FALSE, unique=false) */
    private string $homepage;

    /** @ORM\Column(name="facebook", type="string", nullable=FALSE, unique=false) */
    private string $facebook;

    /** @ORM\Column(name="instagram", type="string", nullable=FALSE, unique=false) */
    private string $instagram;

    /** @ORM\Column(name="twitter", type="string", nullable=FALSE, unique=false) */
    private string $twitter;

    /** @ORM\Column(name="linkedin", type="string", nullable=FALSE, unique=false) */
    private string $linkedin;

    /** @ORM\Column(name="youtube", type="string", nullable=FALSE, unique=false) */
    private string $youtube;

    /** @ORM\Column(name="phone", type="string", nullable=FALSE, unique=false) */
    private string $phone;

    /** @ORM\Column(name="email", type="string", nullable=FALSE, unique=false) */
    private string $email;

    /** @ORM\Column(name="official_name", type="string", nullable=FALSE, unique=false) */
    private string $officialName;

    /** @ORM\Column(name="street", type="string", nullable=FALSE, unique=false) */
    private string $street;

    /** @ORM\Column(name="city", type="string", nullable=FALSE, unique=false) */
    private string $city;

    /** @ORM\Column(name="zip", type="string", nullable=FALSE, unique=false) */
    private string $zip;

    /** @ORM\Column(name="validation_status", type="string", nullable=FALSE, unique=false) */
    private string $validationStatus;

    /** @ORM\Column(name="active", type="boolean", nullable=FALSE, unique=false) */
    private bool $active;

    /** @ORM\Column(name="more_venues", type="boolean", nullable=FALSE, unique=false) */
    private bool $moreVenues;

    /** @ORM\Column(name="notes", type="string", nullable=FALSE, unique=false) */
    private bool $notes;

    /** @ORM\Column(name="location_lat", type="float", nullable=FALSE, unique=false) */
    private float $locationLat;

    /** @ORM\Column(name="location_lng", type="float", nullable=FALSE, unique=false) */
    private float $locationLng;

    /** @ORM\Column(name="company_id", type="string", nullable=FALSE, unique=false) */
    private string $companyId;

    /** @ORM\Column(name="operating_area", type="string", nullable=FALSE, unique=false) */
    private string $operatingArea;

    public function getPhotoMainId(): ?int
    {
        return $this->photoMainId;
    }

    public function setPhotoMainId(?int $photoMainId): void
    {
        $this->photoMainId = $photoMainId;
    }

    public function getPhoto1Id(): ?int
    {
        return $this->photo1Id;
    }

    public function setPhoto1Id(?int $photo1Id): void
    {
        $this->photo1Id = $photo1Id;
    }

    public function getPhoto2Id(): ?int
    {
        return $this->photo2Id;
    }

    public function setPhoto2Id(?int $photo2Id): void
    {
        $this->photo2Id = $photo2Id;
    }

    public function getPhoto3Id(): ?int
    {
        return $this->photo3Id;
    }

    public function setPhoto3Id(?int $photo3Id): void
    {
        $this->photo3Id = $photo3Id;
    }

    public function getPhoto4Id(): ?int
    {
        return $this->photo4Id;
    }

    public function setPhoto4Id(?int $photo4Id): void
    {
        $this->photo4Id = $photo4Id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getPublishedDate(): ?\DateTime
    {
        return $this->publishedDate;
    }

    public function setPublishedDate(?\DateTime $publishedDate): void
    {
        $this->publishedDate = $publishedDate;
    }

    public function getShowFrom(): ?\DateTime
    {
        return $this->showFrom;
    }

    public function setShowFrom(?\DateTime $showFrom): void
    {
        $this->showFrom = $showFrom;
    }

    public function getShowTo(): ?\DateTime
    {
        return $this->showTo;
    }

    public function setShowTo(?\DateTime $showTo): void
    {
        $this->showTo = $showTo;
    }

    public function isShowOnHomepage(): bool
    {
        return $this->showOnHomepage;
    }

    public function setShowOnHomepage(bool $showOnHomepage): void
    {
        $this->showOnHomepage = $showOnHomepage;
    }

    public function getPerex(): string
    {
        return $this->perex;
    }

    public function setPerex(string $perex): void
    {
        $this->perex = $perex;
    }

    public function getArticle(): string
    {
        return $this->article;
    }

    public function setArticle(string $article): void
    {
        $this->article = $article;
    }

    public function getHomepage(): string
    {
        return $this->homepage;
    }

    public function setHomepage(string $homepage): void
    {
        $this->homepage = $homepage;
    }

    public function getFacebook(): string
    {
        return $this->facebook;
    }

    public function setFacebook(string $facebook): void
    {
        $this->facebook = $facebook;
    }

    public function getInstagram(): string
    {
        return $this->instagram;
    }

    public function setInstagram(string $instagram): void
    {
        $this->instagram = $instagram;
    }

    public function getTwitter(): string
    {
        return $this->twitter;
    }

    public function setTwitter(string $twitter): void
    {
        $this->twitter = $twitter;
    }

    public function getLinkedin(): string
    {
        return $this->linkedin;
    }

    public function setLinkedin(string $linkedin): void
    {
        $this->linkedin = $linkedin;
    }

    public function getYoutube(): string
    {
        return $this->youtube;
    }

    public function setYoutube(string $youtube): void
    {
        $this->youtube = $youtube;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getOfficialName(): string
    {
        return $this->officialName;
    }

    public function setOfficialName(string $officialName): void
    {
        $this->officialName = $officialName;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

    public function getValidationStatus(): string
    {
        return $this->validationStatus;
    }

    public function setValidationStatus(string $validationStatus): void
    {
        $this->validationStatus = $validationStatus;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function isMoreVenues(): bool
    {
        return $this->moreVenues;
    }

    public function setMoreVenues(bool $moreVenues): void
    {
        $this->moreVenues = $moreVenues;
    }

    public function isNotes(): bool
    {
        return $this->notes;
    }

    public function setNotes(bool $notes): void
    {
        $this->notes = $notes;
    }


    public function getLocationLat(): float
    {
        return $this->locationLat;
    }

    public function setLocationLat(float $locationLat): void
    {
        $this->locationLat = $locationLat;
    }

    public function getLocationLng(): float
    {
        return $this->locationLng;
    }

    public function setLocationLng(float $locationLng): void
    {
        $this->locationLng = $locationLng;
    }

    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    public function setCompanyId(string $companyId): void
    {
        $this->companyId = $companyId;
    }

    public function getOperatingArea(): string
    {
        return $this->operatingArea;
    }

    public function setOperatingArea(string $operatingArea): void
    {
        $this->operatingArea = $operatingArea;
    }







}
