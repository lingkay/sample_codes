<?php

namespace Carmudi\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Carmudi\BaseBundle\Template\Entity\HasName;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 *
 * @ORM\Table("user_users")
 * @ORM\Entity
 */
 
class User extends BaseUser
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="conf", type="string", nullable=True)
     */
    protected $conf = null;

    /**
     * @ORM\Column(name="name", type="string", nullable=True)
     */
    protected $name = null;

    


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function addConfig($config)
    {    
        if (!in_array($config, $this->conf, true)) {
            $this->conf[] = $config;
        }
        return $this;
    }

    public function setConf($conf)
    {
        $this->conf = $conf;
        return $this;
    }

    public function getConf()
    {
        return $this->conf;
    }

    public function toData()
    {
        $data = new \stdClass();
        $data->id = $this->id;
        $data->username = $this->username;
        $data->name = $this->name;
        $data->email = $this->email;
        $data->conf = $this->conf;

        return $data;
    }    
}