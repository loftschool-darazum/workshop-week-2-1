<?php
interface AbilityInterface
{
    public function apply(HeroInterface $hero, int $curBossHp, int &$heroDamage, int &$bossDamage);

    public function isApplied(): bool;

    public function getAddLog(): string;
}