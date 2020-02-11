<?php

namespace Api\Model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Table;

/**
 * @Entity
 * @Table(name="users")
 */
class User
{
    /**
     * @Id
     * @Column(type="integer")
     */
    private int $id;
    /**
     * @Column(type="string")
     */
    private string $name;
    /**
     * @Column(type="string")
     */
    private string $nameSecond;
    /**
     * @Column(type="integer")
     */
    private int $justTestTestTest;
}