<?php
include __DIR__ . '/../src/game/HeroInterface.php';
include __DIR__ . '/../src/game/HeroAbstract.php';
include __DIR__ . '/../src/game/Spiderman.php';
include __DIR__ . '/../src/game/AbilityInterface.php';
include __DIR__ . '/../src/game/AbilityCriticalHit.php';
include __DIR__ . '/../src/game/EvadeAbility.php';
include __DIR__ . '/../src/game/DashAbility.php';

$hero = new Spiderman(1000, 100);
$hero->addAbility(new AbilityCriticalHit(30));
$hero->addAbility(new EvadeAbility(50));
$hero->addAbility(new DashAbility(100, 50, 50));

$hero->fight(3000);

echo '<div style="overflow-y: auto; height: 500px; width: 800px;">';
$hero->printLog();
echo '</div>';
echo '<br>';
echo '<br>';
echo '<b>';
$hero->printResult();
echo '</b>';
// Победил Spiderman | Победил босс

// лог битвы
// Spiderman атоквал босса на 150 (критический удар), хп босса = 850, босс атаковал Spiderman-а на 25, хп Spiderman = 975
// Spiderman атоквал босса на 75 , хп босса = 775, босс атаковал Spiderman-а но тот увернулся, хп Spiderman = 975

// ...

// Spiderman атаковал босса на 250 и победил!