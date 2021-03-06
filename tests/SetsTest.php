<?php
/**
 * ------------------------------------------------------------------------------------
 * SetsTest.php
 * ------------------------------------------------------------------------------------
 *
 * @package Websublime
 * @author  Miguel Ramos <miguel.marques.ramos@gmail.com>
 * @link    https://www.websublime.com
 * @version 0.1
 *
 * This file is part of Websublime Project.
 *
 * Copyright (c) 2012 
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

require('examples/Sets.php');

class SetsTest extends \PHPUnit_Framework_TestCase {

    public function testSetsScheduleInstance()
    {
        // To create an empty set use the create() method with the name of the enum-type you want to create the set for
        // Let's create a jogging schedule, indicating on which days one will be out for a jog in the park
        $schedule = Websublime\Enum\EnumSet::create('Day');

        $this->assertInstanceOf('Websublime\Enum\EnumSet', $schedule );

        print sprintf('Class Enum Day instance empty created.').PHP_EOL;
    }

    public function testSetsSchedule()
    {
        $schedule = Websublime\Enum\EnumSet::create('Day');

        // EnumSet provides a set of instance methods to add and remove enums
        // Adds given day(s) to collection
        $days = $schedule->add(Day::MONDAY(), Day::FRIDAY(), Day::SATURDAY());

        // Removes given day(s) from collection
        $schedule->remove(Day::FRIDAY()); // Schedule now contains MONDAY and SATURDAY

        // Unfortunately, the park is only open on monday and sunday
        $park = Websublime\Enum\EnumSet::create('Day')->add(Day::MONDAY())->add(Day::SUNDAY());

        // Using the retain() method we can force our schedule to conform to the park's opening days
        // Since SATURDAY - contained in schedule - is not a valid enum in the park, it is removed
        $schedule->retain($park); // Schedule now only contains MONDAY

        // Querying the collection for information
        count($schedule); // 1 (only MONDAY is left)
        $schedule->isEmpty(); // false
        $schedule->contains(Day::MONDAY()); // true

        $this->assertInstanceOf('Websublime\Enum\EnumSet', $schedule );

        print sprintf('Class Day verbose: %s',$schedule).PHP_EOL;
        // Clearing the collection of any enums
        $schedule->clear();

    }

    public function testSetsScheduleWeekend()
    {
        // Instead of starting out with an empty collection, EnumSet comes with a couple of convenient initialization methods
        // The of() static method will create a new collection and initialize it with the given enums
        $weekend = Websublime\Enum\EnumSet::of(Day::SATURDAY(), Day::SUNDAY());

        // Since we already have the weekend definition above, we can complement it, ending up with a collection of week days
        // This effectively generates a collection with all enums NOT present in the given set
        $weekdays = Websublime\Enum\EnumSet::complement($weekend);

        // An alternative way of generating the collection of week days is through a range using the range() static method
        $weekdays = Websublime\Enum\EnumSet::range(Day::MONDAY(), Day::FRIDAY());
        $weekdays = Websublime\Enum\EnumSet::range(Day::FRIDAY(), Day::MONDAY()); // The order is insignificant

        // Lastly, it's possibly to fetch all enums by using the all() static method
        $all = Websublime\Enum\EnumSet::all('Day');

        // EnumSet too, supports binary flag/mask support
        $weekdays->getBinary(); // Results in 31 (0x0000001F in hex or 00000000 00000000 00000000 00011111 in binary)

        // And alternatively, constructing an EnumSet using a binary mask
        $weekend = Websublime\Enum\EnumSet::byBinary('Day', 96);

        $this->assertInstanceOf('Websublime\Enum\EnumSet', $weekend );
        $this->assertInstanceOf('Websublime\Enum\EnumSet', $weekdays );
        $this->assertInstanceOf('Websublime\Enum\EnumSet', $all );

        // Iterating over a set
        foreach($weekdays as $enum) {
            print 'Verbose testSetsScheduleWeekend: '.$enum.PHP_EOL;
        }
    }
}
/** @end SetsTest.php **/