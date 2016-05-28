<?php

namespace App;

class Application
{
    private $elevator;
    private $isOff = false;

    public function showAvailableCommands()
    {
        echo "Type these commands to manipulate the elevator:".PHP_EOL;

        echo "checkStatus() - Check status of the elevator (example Floor: 5 People: 2).".PHP_EOL;
        echo "sendToFloor(numFloor) - Send the elevator to (1-9) floor.".PHP_EOL;
        echo "loadIntoElevator(quantity) - Add passenger(s) into the elevator. Max quantity of passenger - 4.".PHP_EOL;
        echo "unloadFromElevator(quantity) - Remove passenger(s) from the elevator.".PHP_EOL;
        echo "turnOff() - Turn off the elevator.".PHP_EOL.PHP_EOL;
    }

    private function checkInputCommand($command)
    {
        if ($command === 'checkStatus()') { return true; }
        if (preg_match('~sendToFloor\(-?\d+\)~', $command)) { return true; }
        if (preg_match('~loadIntoElevator\(-?\d+\)~', $command)) { return true; }
        if (preg_match('~unloadFromElevator\(-?\d+\)~', $command)) { return true; }
        if ($command === 'turnOff()') { return true; }

        return false;
    }

    private function getCommand()
    {
        do {
            echo "Enter your command: ".PHP_EOL;
            $command = fgets(STDIN);
            $command = trim($command);
        } while ($command === '');

        return $command;
    }

    private function processCommand($command)
    {
        if ($command === "turnOff()") {
            $this->isOff = true;
            return;
        }
        if (preg_match('~(.+)\((-?\d*)\)~', $command, $matches)) {
            $inputCommand = $matches[1];
            $param = $matches[2];

            try {
                $this->elevator->$inputCommand($param);
            } catch (\Exception $e) {
                echo $e->getMessage().PHP_EOL;
            }
        }
    }

    public function run(Elevator $elevator)
    {
        $this->elevator = $elevator;

        $this->showAvailableCommands();

        while (!$this->isOff) {
            do {
                $command = $this->getCommand();

                $checkInputCommand = $this->checkInputCommand($command);
                if (!$checkInputCommand) {
                    echo "Unknown command, check your input command".PHP_EOL;
                }
            } while (!$checkInputCommand);
            $this->processCommand($command);
        }
        echo "The elevator is turned off.".PHP_EOL;
    }
}