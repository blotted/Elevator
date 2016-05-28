<?php

namespace App;


class PassengerElevator implements Elevator
{
    private $floor;
    private $numPassenger;

    public function __construct( $floor = 1, $numPassenger = 0)
    {
        if ($floor >= 1 && $floor < 10) {
            $this->floor = $floor;
        } else {
            $this->floor = 1;
        }
        if ($numPassenger >= 0 && $numPassenger < 5) {
            $this->numPassenger = $numPassenger;
        } else {
            $this->numPassenger = 0;
        }
    }

    public function checkStatus()
    {
        echo 'Current status of elevator'.PHP_EOL;
        echo 'Floor: '.$this->floor.' People: '.$this->numPassenger.PHP_EOL.PHP_EOL;
    }

    public function sendToFloor($numFloor)
    {
        $numFloor = abs((int)$numFloor);

        if ($numFloor < 1 || $numFloor > 9) {
            throw new \Exception('Incorrect number of floor! Must be between 1 and 9!');
        }
        if ($this->numPassenger > 4) {
            throw new \Exception('Warning! The elevator is overloaded. Limit is 4 passengers!');
        }

        $this->floor = $numFloor;
        echo 'You send elevator to '.$numFloor.' floor'.PHP_EOL.PHP_EOL;
    }

    public function loadIntoElevator($quantity)
    {
        $quantity = abs((int) $quantity);
        $this->numPassenger += $quantity;
        echo 'Now '.$this->numPassenger.' passengers in elevator' . PHP_EOL . PHP_EOL;
    }

    public function unloadFromElevator($quantity)
    {
        $quantity = abs((int) $quantity);
        $newNumPassenger = $this->numPassenger - $quantity;

        if ($newNumPassenger < 0) {
            throw new \Exception('Incorrect number of passenger!');
        }
        $this->numPassenger = $newNumPassenger;
        echo $newNumPassenger . ' left the elevator'.PHP_EOL;
        echo 'Now '.$this->numPassenger.' passengers in elevator'.PHP_EOL.PHP_EOL;
    }
}