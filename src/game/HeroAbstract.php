<?php
class HeroAbstract implements HeroInterface
{
    const BOSS_DAMAGE = 100;

    protected $hp;
    protected $startHp;
    protected $baseDamage;

    protected $log = [];
    protected $result = '';

    protected $abilities;

    public function __construct($hp, $baseDamage)
    {
        $this->hp = $hp;
        $this->startHp = $hp;
        $this->baseDamage = $baseDamage;
    }

    public function fight(int $bossHp)
    {
        $curBossHp = $bossHp;
        while ($this->hp > 0 && $curBossHp > 0) {
            $curBossHp = $this->hit($curBossHp);
        }

        if ($this->hp > 0) {
            $this->result = 'Персонаж победил';
        } else {
            $this->result = 'Босс победил';
        }
    }

    protected function hit(int &$curBossHp)
    {
        $heroDamage = $this->getDamage();
        $bossDamage = self::BOSS_DAMAGE;

        $logString = '';

        $addLog = [];
        foreach ($this->abilities as $ability) {
            $ability->apply($this, $curBossHp, $heroDamage, $bossDamage);
            if ($ability->isApplied()) {
                $addLog[] = $ability->getAddLog();
            }
        }

        $addLogStr = $addLog ? implode(' ', $addLog) : '';
        $curBossHp -= $heroDamage;
        $logString .= $addLogStr . " Персонаж поразил босса на $heroDamage (осталось $curBossHp).";
        if ($curBossHp > 0) {
            $this->hp -= $bossDamage;
            $logString .= ' Босс поразил персонажа на ' . $bossDamage . ' (осталось ' . $this->hp . ')';
        }

        $this->log[] = $logString;

        return $curBossHp;
    }

    protected function getDamage()
    {
        return mt_rand(ceil(0.9 * $this->baseDamage), ceil(1.1 * $this->baseDamage));
    }

    public function printLog()
    {
        foreach ($this->log as $str) {
            echo $str . '<br>';
        }
    }

    public function printResult()
    {
        echo $this->result;
    }

    public function addAbility(AbilityInterface $ability)
    {
        $this->abilities[] = $ability;
    }

    public function getCurrentHp()
    {
        return $this->hp;
    }

    public function getStartHp()
    {
        return $this->startHp;
    }
}