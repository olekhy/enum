<?php
/**
 * ------------------------------------------------------------------------------------
 * IterationTest.php
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
require('examples/Iteration.php');

class IterationTest extends \PHPUnit_Framework_TestCase {

    public function testCountryCodeList()
    {
        // To generate a list of all country entry codes we have defined, use every enum-type's enums() method
        $list = CountryEntryCode::enums();

        $this->assertInternalType('array', $list);

        // This list is an array of a name (say, NETHERLANDS) and the actual enum instance 
        foreach($list as $name=>$enum) {
            print $enum.PHP_EOL;
        }
    }

    public function testCountryCodeListAll()
    {
        // To generate a list of all enums we have used (globally), use Enum::enums()
        // Note, Enum::enums() only lists enums used previously. CountryExitCode has not been used in our script yet, so do so prior to generating the list
        //CountryExitCode::NETHERLANDS();
        $all = Websublime\Enum\Enum::enums();

        $this->assertInternalType('array', $all);

        // This list is an array of an enum-type (say, CountryEntryCode) and the list seen above
        foreach($all as $class=>$list) {
            foreach($list as $name=>$enum) {
                print $enum.PHP_EOL;
            }   
        }
    }
}

/** @end IterationTest.php **/