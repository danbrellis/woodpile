<?php
/**
 * Created by PhpStorm.
 * User: danbr
 * Date: 4/5/2019
 * Time: 12:58 PM
 */

namespace Woodpile\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PileRepository")
 * @ORM\Table(name="piles")
 */
class Pile
{
    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Stack", mappedBy="stack")
     * @var Stack[] An ArrayCollection of Stack objects.
     **/
    protected $stacks;

    public function __construct()
    {
        $this->stacks = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return ArrayCollection[]
     */
    public function getStacks(): array
    {
        return $this->stacks;
    }

    /**
     * @param Stack $stack
     */
    public function addStack(Stack $stack): void
    {
        $this->stacks[] = $stack;
    }




}