<?php
class EvadeAbility implements AbilityInterface
{
    private $applied = false;
    private $probability;

    public function __construct(int $probability)
    {
        $this->probability = $probability;
    }

    public function apply(HeroInterface $hero, int $curBossHp, int &$heroDamage, int &$bossDamage)
    {
        $this->applied = false;
        $rand = mt_rand(0, 99);
        if ($rand < $this->probability) {
            $bossDamage = 0;
            $this->applied = true;
        }
    }

    public function isApplied(): bool
    {
        return $this->applied;
    }

    public function getAddLog(): string
    {
        return '<span style="color: green">Персонаж увернулся!</span>';
    }
}