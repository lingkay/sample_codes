<?php

namespace Carmudi\OrgBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Carmudi\BaseBundle\Template\Entity\HasGeneratedID;
use Carmudi\BaseBundle\Template\Entity\HasName;
//use Carmudi\BaseBundle\Template\Entity\HasOrg;
//use Carmudi\OrgBundle\Entity\Organisation;

/**
 * Config
 *
 * @ORM\Table("qalpha_company_cfg")
 * @ORM\Entity
 */
 
class Config
{
    use HasGeneratedID;
    //use HasOrg;

    /**
     * @ORM\Column(name="org_id", type="integer", nullable=true)
     */
    protected $org_id = null;

    /**
     * @ORM\Column(name="setting", type="string", nullable=true)
     */
    protected $setting = null;

    /**
     * @ORM\Column(name="value", type="string", nullable=true)
     */
    protected $value = null;

    public function setOrg($org_id)
    {
        $this->org_id = $org_id;
        return $this;
    }

    public function getOrg()
    {
        return $this->org_id;
    }

    public function setSetting($setting)
    {
        $this->setting = $setting;
        return $this;
    }

    public function getSetting()
    {
        return $this->setting;
    }

    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function toData()
    {
        $data = new stdClass();

        $this->dataHasGeneratedID($data);
        //$this->dataHasOrg($data);
        
    }
}
