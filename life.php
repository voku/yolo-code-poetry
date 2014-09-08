<?php

class Clock
{
  protected static $years = 0;
  protected $date;
  protected $maxYears;

  public function __construct($maxYears)
  {
    $this->date = getdate();
    $this->maxYears = $maxYears;
  }

  public function ticking(&$tick = 0, $maxTick = 5)
  {
    // the death is always near, so live your life
    // and you can not trace this info in real life
    if (self::$years++ >= $this->maxYears) {
      echo "\n\n -- die() --\n\n";
      die();
    }

    if ($tick >= $maxTick) {
      return false;
    } else {
      ob_flush();
      flush();
    }
  }
}

function getRandomThing($array)
{
  shuffle($array);
  return $array[1];
}

$clock = new Clock(rand(0, 100));
$life = ['television', 'mobile phone', 'car', 'computer', 'memory', 'house', 'kitchen'];
$oldLife = [];
$s = "\n<br />";

do {
  echo "So much time is gone away" . $s;

  $tick = 0;
  while ($clock->ticking($tick) !== false) {
    echo "... days, weeks, years ..." . $s;
    $tick++;
  }
  echo "and there isn't a button for restart or replay," . $s;

  foreach ($life as $key => $x) {
    if ($x != 'memory') {
      $oldLife[] = $x;
      unset($life[$key]);
    }
  }
  $life = array_filter($life);

  if (count($life) == 1) {
    echo "everything will be lost in the room of time," . $s;
    echo "only memories will remain, for this runtime." . $s . $s;
  }

  echo "You will again feel the small pleasures of life ..." . $s;
  $pleasure = ['sunset', 'cold beer', 'good music', 'peace', 'love'];

  $tick = 0;
  while ($clock->ticking($tick, rand(0, count($pleasure) - 1)) !== false) {
    $pleasureTmp = getRandomThing($pleasure);

    $life[] = $pleasureTmp;
    echo " - " . $pleasureTmp . $s;

    $tick++;
  }
  $life = array_filter($life);

  if (count($life) == 1) {
    echo "... but the good parts are still hidden for your eyes." . $s . $s;
  } else {
    echo "... the good parts were never lost, they were only hidden for your eyes." . $s . $s;
  }

  echo "How much time will pass, how much time remain," . $s;
  echo "so much of what nobody understands," . $s;
  echo "so much what is not in our hands," . $s;

  $tick = 0;
  while ($clock->ticking($tick, count($oldLife) - 1) !== false) {
    echo "love, hope and pain, over and over again" . $s;

    $life[] = getRandomThing($oldLife);

    $tick++;
  }
  $life = array_filter($life);

  echo "then the stage of life goes by, what is left, what will lost in time: ";
  var_dump($life);

}
while ($life); // looks like a infinite loop, most of the time ...
