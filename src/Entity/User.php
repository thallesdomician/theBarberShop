<?php
namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_base")
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
     * @ORM\Column(type="string", length=170, nullable=true)
     * @Assert\Length(
     *      min = 5,
     *      max = 75,
     *      minMessage= "assert.lenght.min",
     *      maxMessage= "assert.lenght.max"
     * )
     * @Assert\NotBlank
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

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('email', new Assert\NotBlank([
            'message' => 'assert.not_blank',
        ]));
        $metadata->addPropertyConstraint('email', new Assert\Email([
            'message' => 'assert.email',
        ]));
        $metadata->addPropertyConstraint('email', new Assert\Length(['max' => 180]));
        
        $metadata->addPropertyConstraint('username', new Assert\NotBlank([
            'message' => 'assert.not_blank',
        ]));
        $metadata->addPropertyConstraint('username', new Assert\Length([
            'max' => 180,
            'maxMessage' => 'assert.lenght.max',
            ]));

        $metadata->addPropertyConstraint('password', new Assert\NotBlank([
            'message' => 'assert.not_blank',
        ]));

        $metadata->addPropertyConstraint('password', new Assert\Regex([
            'pattern' => '/^(?=.*[a-z])/i',
            'message' => 'The string must contain at least 1 lowercase alphabetical character'
        ]));
        $metadata->addPropertyConstraint('password', new Assert\Regex([
            'pattern' => '/^(?=.*[A-Z])/i',
            'message' => 'The string must contain at least 1 uppercase alphabetical character'
        ]));
        $metadata->addPropertyConstraint('password', new Assert\Regex([
            'pattern' => '/^(?=.*[0-9])/i',
            'message' => 'The string must contain at least 1 numeric character'
        ]));
        $metadata->addPropertyConstraint('password', new Assert\Regex([
            'pattern' => '/^(?=.*[!_\-@#\$%\^&\*])/i',
            'message' => 'The string must contain at least one special character, but we are escaping reserved RegEx characters to avoid conflictage'
        ]));
        $metadata->addPropertyConstraint('password', new Assert\Regex([
            'pattern' => '/^(?=.{8,})/i',
            'message' => 'The string must be 8 characters or longer'
        ]));


        $metadata->addConstraint(new UniqueEntity(['fields' => 'email', 'message' => 'doctrine.assert.unique']));
        
        $metadata->addConstraint(new UniqueEntity(['fields' => 'username', 'message' => 'doctrine.assert.unique']));
    }
}
