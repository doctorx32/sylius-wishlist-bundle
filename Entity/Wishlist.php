<?php

namespace Webburza\Sylius\WishlistBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\User\Model\CustomerInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Webburza\Sylius\WishlistBundle\Model\WishlistInterface;
use Webburza\Sylius\WishlistBundle\Model\WishlistItemInterface;

/**
 * Wishlist
 *
 * @ORM\Table(name="webburza_sylius_wishlist")
 * @ORM\Entity(repositoryClass="Webburza\Sylius\WishlistBundle\Model\WishlistRepositoryInterface")
 */
class Wishlist implements ResourceInterface, WishlistInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     * @Gedmo\Slug(fields={"title"})
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="public", type="boolean")
     */
    private $public;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @var CustomerInterface
     * @ORM\ManyToOne(targetEntity="\Sylius\Component\User\Model\CustomerInterface")
     * @ORM\JoinColumn(name="customer_id", nullable=false, onDelete="cascade")
     */
    private $customer;

    /**
     * @var WishlistItemInterface
     * @ORM\OneToMany(targetEntity="\Webburza\Sylius\WishlistBundle\Model\WishlistItemInterface", mappedBy="wishlist")
     */
    private $items;

    /**
     * Wishlist constructor.
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return WishlistInterface
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     * @return WishlistInterface
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return WishlistInterface
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return boolean
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @param boolean $public
     * @return WishlistInterface
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return WishlistInterface
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     * @return WishlistInterface
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return CustomerInterface
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param CustomerInterface $customer
     * @return WishlistInterface
     */
    public function setCustomer(CustomerInterface $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return WishlistItemInterface[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param ArrayCollection $items
     * @return WishlistInterface
     */
    public function setItems(ArrayCollection $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @param WishlistItemInterface $item
     * @return WishlistInterface
     */
    public function addItem(WishlistItemInterface $item)
    {
        $this->items->add($item);
        $item->setWishlist($this);

        return $this;
    }
}
