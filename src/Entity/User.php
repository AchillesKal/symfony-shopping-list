<?php

namespace App\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_users")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true, length=191)
     */
    private $email;

    /**
     * @ORM\Column(type="string", unique=true, length=191)
     */
    private $facebookId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ShoppingList", mappedBy="owner")
     */
    private $shoppingLists;

    /**
     * User constructor.
     * @param $email
     * @param $facebookId
     */
    public function __construct($email, $facebookId)
    {
        $this->email = $email;
        $this->facebookId = $facebookId;
        $this->shoppingLists = new ArrayCollection();
    }

    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFacebookId()
    {
        return $this->facebookId;
    }

    /**
     * @param mixed $facebookId
     */
    public function setFacebookId($facebookId): void
    {
        $this->facebookId = $facebookId;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getShoppingLists(): Collection
    {
        return $this->shoppingLists;
    }

    public function addShippingList(ShoppingList $shoppingList): self
    {
        if (!$this->shoppingLists->contains($shoppingList)) {
            $this->shoppingLists[] = $shoppingList;
            $shoppingList->setOwner($this);
        }
        return $this;
    }

    public function removeShippingList(ShoppingList $shoppingList): self
    {
        if ($this->shoppingLists->contains($shoppingList)) {
            $this->shoppingLists->removeElement($shoppingList);
            // set the owning side to null (unless already changed)
            if ($shoppingList->getOwner() === $this) {
                $shoppingList->setOwner(null);
            }
        }
        return $this;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getPassword()
    {
    }
    public function getSalt()
    {
    }
    public function eraseCredentials()
    {
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            ) = unserialize($serialized, array('allowed_classes' => false));
    }
}