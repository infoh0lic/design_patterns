<?php
/**
 *                      PHP Project Patterns:
 *
 *                            # Builder #
 *
 *          Bring your helmet, you are now entering the construction site.
 *
 *============================================================================
 *
 *                          Pattern scheme:
 *          1) Instantiate Director and Building type classes;
 *          2) Director chooses type of building by chooseBuilder(),
 *          3) Director builds building by Build(),
 *          4) Returns building to a variable - returnBuilding(),
 *          5) We describe building from a variable, to confirm if it was builded.
 *
 *
 *
 *                                                                          by PA
 */

//Abstract class for building
class Building {

    public static $window = "" ;
    public static $door = "" ;
    public static $elevationColor = "";

    public function insertWindow($type) {
        $this->window = $type;
    }

    public function insertDoor($type) {
        $this->door = $type;
    }

    public function paintElevation($color) {
        $this->elevationColor = $color;
    }

    public function describeBuilding() {
        if (isset($this->window)) {echo "Windows are " . $this->window . "\n";}
        if (isset($this->door)) {echo "Doors are " . $this->door . "\n";}
        if (isset($this->elevationColor)) {echo "Elevation color is " . $this->elevationColor . "\n";}
    }
}

//Abstract class for builder
class Builder {

    public $building;

    public function newBuilding() {
        $this->building = new Building();
    }

    public function returnBuilding() {
        return $this->building;
    }

    public function insertWindow() {
    }

    public function insertDoor() {
    }

    public function paintElevation() {
    }

}

//Bulding type classes
//House class
class House extends Builder {

    public function insertWindow()
    {
        $this->building->insertWindow('wooden');
    }

    public function insertDoor()
    {
        $this->building->insertDoor('burglary');
    }

    public function paintElevation()
    {
        $this->building->paintElevation('grey');
    }
}

//Skyscrapper class
class Skyscrapper extends Builder {

    public function insertWindow()
    {
        $this->building->insertWindow('plastic');
    }

    public function insertDoor()
    {
        $this->building->insertDoor('revolving');
    }

    public function paintElevation()
    {
        //Glass elevation
    }
}

//
class Director {

    public $builder;

    public function chooseBuilder($b) {
        $this->builder = $b;
    }

    public function returnBuilding(){
        return $this->builder->returnBuilding();
    }

    public function Build() {
        $this->builder->newBuilding();
        $this->builder->insertWindow();
        $this->builder->insertDoor();
        $this->builder->paintElevation();
    }
}


/// Building site ///
/// Helmets are obligatory beyond this point ///

//Director and builders definitions
$buildingDirector = new Director;
$houseBuilder = new House;
$skyscrapperBuilder = new Skyscrapper;


//Building a lovely home
$buildingDirector->chooseBuilder($houseBuilder);
$buildingDirector->Build();
$lovely_home = $buildingDirector->returnBuilding();

$newBuilder = $buildingDirector->newBuilder();
var_dump($newBuilder);


//Building Empire State Building
$buildingDirector->chooseBuilder($skyscrapperBuilder);
$buildingDirector->Build();
$empire_state_building = $buildingDirector->returnBuilding();

//Checking out the buildings
echo "Checking lovely, cozy home: \n";
$lovely_home->describeBuilding();
echo "\nChecking Empire State Building: \n";
$empire_state_building->describeBuilding();

//Object checking
//var_dump($lovely_home);
//var_dump($empire_state_building);


