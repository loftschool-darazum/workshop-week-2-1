<?php
class DashAbility implements AbilityInterface
{
    private $applied = false;
    private $probability;
    private $startHeroHpPercent;
    private $bossDamageReducePercent;

    public function __construct(int $probability, int $startHeroHpPercent, int $bossDamageReducePercent)
    {
        $this->probability = $probability;
        $this->startHeroHpPercent = $startHeroHpPercent;
        $this->bossDamageReducePercent = $bossDamageReducePercent;
    }

    public function apply(HeroInterface $hero, int $curBossHp, int &$heroDamage, int &$bossDamage)
    {
        $this->applied = false;
        $rand = mt_rand(0, 99);
        if ($hero->getCurrentHp() < ($this->startHeroHpPercent / 100) * $hero->getStartHp() && $rand < $this->probability) {
            $bossDamage = $bossDamage * (1 - $this->bossDamageReducePercent / 100);
            $this->applied = true;
        }
    }

    public function isApplied(): bool
    {
        return $this->applied;
    }

    public function getAddLog(): string
    {
        return '<span style="color: purple">Урон уменьшен на ' . $this->bossDamageReducePercent . '%!</span>';
    }
}