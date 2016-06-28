<?php
/**
 * Created by PhpStorm.
 * User: relmek
 * Date: 2016/6/28
 * Time: 上午 9:26
 */

interface CarService{
    public function getCost();
    public function getDescription();
}

class Basic implements CarService{
    public function getCost()
    {
        return 25;
    }
    public function getDescription()
    {
        return "Basic inspection ";
    }
}
class OilChange implements CarService{

    protected $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function getCost()
    {
        return 30 + $this->carService->getCost();
    }

    public function getDescription()
    {
        return $this->carService->getDescription()." , and oil change..";
    }
}

class tireRotation implements CarService{

    protected $carService;

    function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    public function getCost()
    {
        return 40  + $this->carService->getCost();
    }

    public function getDescription()
    {
        return $this->carService->getDescription() . ", and tire rotation .";
    }
}

//var_dump(new tireRotation(new OilChange(new Basic()) ) ) ;
$service = new OilChange( new tireRotation( new Basic ) );
var_dump($service);

echo $service->getDescription();
echo $service->getCost();
