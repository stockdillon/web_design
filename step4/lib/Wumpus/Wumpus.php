<?php
/**
 * Created by PhpStorm.
 * User: dillonstock
 * Date: 5/29/17
 * Time: 12:23 PM
 */

namespace Wumpus;


class Wumpus
{
    const NUM_ROOMS = 20;
    const NUM_PITS = 2;
    const NUM_ARROWS = 3;

    // The things that can be in a room
    const WUMPUS = 1;
    const BIRDS = 2;
    const PIT = 3;

    // Move return values
    const HAPPY = 0;    ///< Moved just fine
    const EATEN = 1;    ///< Eaten by Wumpus
    const FELL = 2;     ///< Fell into the pit


    /**
     * Constructor
     * @param $seed Random number seed
     */
    public function __construct($seed = null) {
        if($seed === null) {
            $seed = time();
        }

        srand($seed);

        $this->constructRooms();
        $this->populateRooms();
    }


    /** Construct the rooms */
    private function constructRooms()
    {
        // Construct 20 random room numbers
        $nums = array();
        for ($i = 1; $i <= self::NUM_ROOMS; $i++) {
            $nums[] = $i;
        }

        // And shuffle them
        shuffle($nums);

        // Construct 20 rooms
        for ($i = 1; $i <= self::NUM_ROOMS; $i++) {
            $this->rooms[$i] = new Room($i, $nums[$i-1]);
        }

        // Make the room connections
        $this->connect(1, 2, 5, 6);
        $this->connect(2, 1, 3, 8);
        $this->connect(3, 2, 4, 10);
        $this->connect(4, 3, 5, 12);
        $this->connect(5, 1, 4, 14);
        $this->connect(6, 1, 7, 15);
        $this->connect(7, 6, 8, 16);
        $this->connect(8, 2, 7, 9);
        $this->connect(9, 8, 10, 17);
        $this->connect(10, 3, 9, 11);
        $this->connect(11, 10, 12, 18);
        $this->connect(12, 4, 11, 13);
        $this->connect(13, 12, 14, 19);
        $this->connect(14, 5, 13, 15);
        $this->connect(15, 6, 14, 20);
        $this->connect(16, 7, 17, 20);
        $this->connect(17, 9, 16, 18);
        $this->connect(18, 11, 17, 19);
        $this->connect(19, 13, 18, 20);
        $this->connect(20, 15, 16, 19);
    }

    /** populate the rooms */
    private function populateRooms() {
        /*
         * Place the wumpus, birds, and pits
         */
        $this->randomEmptyRoom()->addContent(self::WUMPUS);
        $this->randomEmptyRoom()->addContent(self::BIRDS);
        for ($p = 0; $p < self::NUM_PITS; $p++) {
            $this->randomEmptyRoom()->addContent(self::PIT);
        }

        /*
         * Place the player
         */
        $this->current = $this->randomEmptyRoom();
        //echo "Player is in ndx " . $this->current->getNdx() . "\n";
    }


    /**
     * Find a random, empty room in the cave.
     * @return Room that is empty
     */
    private function randomEmptyRoom() {
        while(true) {
            $ndx = rand(1, count($this->rooms));
            $room = $this->getRoom($ndx);
            if($room->isEmpty()) {
                return $room;
            }
        }
    }

    /**
     * Connect a room to three other rooms
     * @param $r The room to connect (starting at 1)
     * @param $n1 Room to connect to (starting at 1)
     * @param $n2 Room to connect to (starting at 1)
     * @param $n3 Room to connect to (starting at 1)
     */
    private function connect($r, $n1, $n2, $n3)
    {
        $room = $this->rooms[$r];
        $room->addNeighbor($this->rooms[$n1]);
        $room->addNeighbor($this->rooms[$n2]);
        $room->addNeighbor($this->rooms[$n3]);
    }

    /**
     * Get reference to a room
     * @param $r Room number (starting at 1)
     * @return Room object
     */
    public function getRoom($r) {
        return $this->rooms[$r];
    }



    /**
     * *******************************************************************************
     * Move to another room
     *
     * The reason there is this function and an actual
     * move function moveActual is that this will
     * reset the carried by birds flag, which may
     * be set by moveActual if we are carried.
     *
     * @param $ndx Index of the room to move to
     */
    public function move($ndx) {
        $temp_room = $this->rooms[$ndx];
        $this->carried = false;
        if($temp_room->contains(self::WUMPUS, 0)){
            //$this->current = $ndx;
            return self::EATEN;
        }
        if($temp_room->contains(self::PIT, 0)){
            //$this->current = $ndx;
            return self::FELL;
        }
        if($temp_room->contains(self::BIRDS, 0)){
            $new_room = rand(1, self::NUM_ROOMS);
            $to_return = $this->move($new_room);
            $this->current = $this->rooms[$new_room];
            $this->carried = true;
            return $to_return;
        }
        $this->current = $this->rooms[$ndx];
        return self::HAPPY;
    }

    public function wasCarried(){
        return $this->carried;
    }

    /**
     * @param $ndx Index for room to shoot into
     * @return true if we shot the Wumpus
     */
    public function shoot($ndx) {
        $this->arrows--;
        $temp_room = $this->rooms[$ndx];
        if($temp_room->contains(self::WUMPUS, 0)){
            return true;
        }
        else{
            $sroom2 = $temp_room->getNeighbors()[rand(0, 2)];
            if($sroom2->contains(self::WUMPUS, 0)){
                return true;
            }
        }
        return false;
    }

    public function numArrows(){
        return $this->arrows;
    }


    public function getCurrent(){
        return $this->current;
    }


    public function smellWumpus() {
        if($this->getCurrent()->contains(self::WUMPUS, 2)){
            return true;
        }
        return false;
    }


    public function feelDraft(){
        if ($this->getCurrent()->contains(self::PIT, 1)) {
            return true;
        }
        return false;
    }

    public function hearBirds() {
        if ($this->getCurrent()->contains(self::BIRDS, 1)) {
            return true;
        }
        return false;
    }



    private $rooms = array();   // The rooms
    private $current = null;    // Room the user is in
    private $carried = false;   // We were carried by birds
    private $arrows = self::NUM_ARROWS; // Number of arrows we have
}