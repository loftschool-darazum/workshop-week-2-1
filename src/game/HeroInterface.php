<?php
interface HeroInterface
{
    public function fight(int $bossHp);

    public function getCurrentHp();

    public function getStartHp();
}