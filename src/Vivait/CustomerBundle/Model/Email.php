<?php

namespace Vivait\CustomerBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Embeddable()
 */
class Email
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="email", type="string", nullable=true)
     */
    private $email;

    function __construct($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(sprintf('"%s" is not a valid email', $email));
        }

        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }

    public function equals(Email $address)
    {
        return strtolower((string) $this) === strtolower((string) $address);
    }
}