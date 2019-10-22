<?php
namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=170)
     */
    private $name;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Barber", mappedBy="user", cascade={"persist", "remove"})
     */
    private $barber;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Customer", mappedBy="user", cascade={"persist", "remove"})
     */
    private $customer;

    public function __construct()
    {
        parent::__construct();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBarber(): ?Barber
    {
        return $this->barber;
    }

    public function setBarber(?Barber $barber): self
    {
        $this->barber = $barber;

        // set (or unset) the owning side of the relation if necessary
        $newUser = $barber === null ? null : $this;
        if ($newUser !== $barber->getUser()) {
            $barber->setUser($newUser);
        }

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        // set the owning side of the relation if necessary
        if ($this !== $customer->getUser()) {
            $customer->setUser($this);
        }

        return $this;
    }
}
