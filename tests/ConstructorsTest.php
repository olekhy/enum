<?php
/**
 * ------------------------------------------------------------------------------------
 * ConstructorsTest.php
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
require('examples/Constructors.php');

class ConstructorsTest extends \PHPUnit_Framework_TestCase {

    public function testVenus()
    {
        // Now that VENUS has data attached we can use her public properties
        $venus = Planet::VENUS();

        $this->assertInstanceOf('Planet', $venus );

        print sprintf('Venus is also a %s.',$venus->related).PHP_EOL;
    }

    // Verifying the value assignment for these countries
    public function testCountry()
    {
        $enum = Country::byValue('NOR'); // Country::NORWAY enum
        $true = Country::byValue('IRL')->isIsland(); // true

        $this->assertInstanceOf('Country', $enum );
        $this->assertTrue($true);
    }

    public function testAirliner()
    {
        $true = Airliner::RYANAIR()->country->isIsland(); // true

        $this->assertTrue($true);
    }
}

/** @end ConstructorsTest.php **/