<?php

namespace App;


interface Elevator
{
    function checkStatus();

    function sendToFloor($numFloor);

    public function loadIntoElevator($quantity);

    public function unloadFromElevator($quantity);
}