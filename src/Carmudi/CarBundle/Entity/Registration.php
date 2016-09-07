<?php

namespace Carmudi\CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Carmudi\BaseBundle\Template\Entity\HasGeneratedID;
use Carmudi\BaseBundle\Template\Entity\HasName;
use \Carmudi\UserBundle\Entity\User;
/**
 * Registration
 *
 * @ORM\Table("carmudi_registration")
 * @ORM\Entity
 */
 
class Registration
{
    use HasGeneratedID;
    use HasName;

    /**
     * @ORM\Column(name="user_id", type="integer")
     */
    protected $user_id;

    /**
     * @ORM\Column(name="displacement_measure", type="string")
     */
    protected $displacement_measure;

    /**
     * @ORM\Column(name="displacement_unit", type="string")
     */
    protected $displacement_unit;

    /**
     * @ORM\Column(name="power", type="string")
     */
    protected $power;

    public function setUser($user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getUser()
    {
        return $this->user_id;
    }

    public function setMeasure($displacement_measure)
    {
        $this->displacement_measure = $displacement_measure;
        return $this;
    }

    public function getMeasure()
    {
        return $this->displacement_measure;
    }

    public function setUnit($displacement_unit)
    {
        $this->displacement_unit = $displacement_unit;
        return $this;
    }

    public function getUnit()
    {
        return $this->displacement_unit;
    } 

    public function setPower($power)
    {
        $this->power = $power;
        return $this;
    }

    public function getPower()
    {
        return $this->power;
    }

    /*public function __toString() {
        return $this->name;
    }*/

    public function toData()
    {
        $data = new stdClass();

        $this->dataHasGeneratedID($data);
        $this->dataHasName($data);
    }
}
