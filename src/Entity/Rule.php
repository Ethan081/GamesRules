<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RuleRepository")
 * @Vich\Uploadable
 */
class Rule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $rule;


    /**
     * @var File|null
     * @Vich\UploadableField(mapping="game_rule", fileNameProperty="rule")
     */
    private $ruleFile;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Game", cascade={"persist", "remove"})
     */
    private $games;

//    ----------Getter--Setter-----------------

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getRule(): ?string
    {
        return $this->rule;
    }

    /**
     * @param string|null $rule
     */
    public function setRule(?string $rule): void
    {
        $this->rule = $rule;
    }

    /**
     * @return File|null
     */
    public function getRuleFile(): ?File
    {
        return $this->ruleFile;
    }

    /**
     * @param File|null $ruleFile
     */
    public function setRuleFile(?File $ruleFile): void
    {
        $this->ruleFile = $ruleFile;
    }

    public function getGames(): ?Game
    {
        return $this->games;
    }

    public function setGames(?Game $games): self
    {
        $this->games = $games;

        return $this;
    }
}
