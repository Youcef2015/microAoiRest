<?php
/**
 * User: ylezghed
 * Date: 21/10/17
 * Time: 02:03
 */
declare(strict_types=1);


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\RestBundle\Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
/**
 * @ORM\Entity()
 * @ORM\Table(name="country")
 * @ExclusionPolicy("all")
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @Expose
     */
    private  $id;

    /**
     * @ORM\Column(type="string", name="code")
     * @Expose
     */
    private $code;

    /**
     * @ORM\Column(type="string", name="label")
     * @Expose
     */
    private $label;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return $this
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }
    /**
     * @return int
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel(string $label)
    {
        $this->label = $label;

        return $this;
    }

}
