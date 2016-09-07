<?php

namespace Carmudi\BaseBundle\Template\Entity;

use Doctrine\ORM\Mapping as ORM;

trait HasOrg
{

    /** 
     * @ORM\ManyToOne(targetEntity="\Carmudi\OrgBundle\Entity\Organisation")
     * @ORM\JoinColumn(name="org_id", referencedColumnName="id")
     */
    protected $org;

    public function getOrg()
    {
        return $this->org;
    }

    public function setOrgID(\Carmudi\OrgBundle\Entity\Organisation $org)
    {
        $this->org_id = $org;
        return $this;
    }

    public function dataHasOrg($data)
    {
        $data->org = $this->org->toData();
    }
}
