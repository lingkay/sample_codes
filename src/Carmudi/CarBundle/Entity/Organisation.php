<?php

namespace Carmudi\OrgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Carmudi\BaseBundle\Template\Entity\HasGeneratedID;
use Carmudi\BaseBundle\Template\Entity\HasName;
use \Carmudi\UserBundle\Entity\User;
/**
 * Organisation
 *
 * @ORM\Table("qalpha_organisation")
 * @ORM\Entity
 */
 
class Organisation
{
    use HasGeneratedID;
    use HasName;

    /**
    * @ORM\OneToMany(targetEntity="\Carmudi\UserBundle\Entity\User", mappedBy="org_id", cascade={"persist"})
    */
    protected $orgs;

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
