<?php
/**
 * ------------------------------------------------------------------------------------
 * BinaryTest.php
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
require('examples/Binary.php');

class BinaryTest extends \PHPUnit_Framework_TestCase {

    // For every enum member a unique binary flag is generated
    // This is what the CarFeature binary flags look like in hex as well as binary form
    public function testBinaryUnique()
    {
        $convertible = CarFeature::CONVERTIBLE()->getBinary();     // 0x00000001 - 00000000 00000000 00000000 00000001
        $central= CarFeature::CENTRAL_LOCKING()->getBinary(); // 0x00000002 - 00000000 00000000 00000000 00000010
        $spoilers = CarFeature::SPOILERS()->getBinary();        // 0x00000004 - 00000000 00000000 00000000 00000100
        $alarm = CarFeature::ALARM()->getBinary();           // 0x00000008 - 00000000 00000000 00000000 00001000
        $seat = CarFeature::SEAT_HEATING()->getBinary();    // 0x00000010 - 00000000 00000000 00000000 00010000

        $this->assertEquals($convertible, '1');
        $this->assertEquals($central, '2');
        $this->assertEquals($spoilers, '4');
        $this->assertEquals($alarm, '8');
        $this->assertEquals($seat, '16');

        print sprintf('A unique flag like: %s',$convertible).PHP_EOL;
    }

    // As seen above, with 32-bit integers, this results in 32 unique flags. Collisions may occur depending on the amount of members and/or PHP's integer size (PHP_INT_SIZE)
    // Looking up a single CarFeature with the byBinary() method as follows
    public function testByBinary()
    {
        $spoiler = CarFeature::byBinary(4); // Since SPOILERS is the only member with the third bit set (see above) this results in CarFeature::SPOILERS
        $same = CarFeature::byBinary(CarFeature::SPOILERS()->getBinary()); // idem

        $this->assertInstanceOf('CarFeature', $spoiler);

        print sprintf('A unique flag by binary like: %s',$spoiler->getValue()).PHP_EOL;
    }

    // When a customer orders several features, it's convenient to group these together; Use the bitwise OR-operator
    public function testOrder()
    {
        $order = CarFeature::CONVERTIBLE()->getBinary() | CarFeature::SEAT_HEATING()->getBinary();

        $this->assertEquals($order, '17');
        // Order now contains a combination of the CONVERTIBLE and SEAT_HEATING binary flags
        print sprintf('An order: %s',$order).PHP_EOL; // Results in 17 (0x00000011 in hex or 00000000 00000000 00000000 00010001 in binary)
    }

    // To figure out which features the customer wanted, use the byBinary() method yet again
    public function testOrderWhich()
    {
        $order = CarFeature::CONVERTIBLE()->getBinary() | CarFeature::SEAT_HEATING()->getBinary();
        $array = CarFeature::byBinary($order); // Will result in an array with both CarFeature::CONVERTIBLE and CarFeature::SEAT_HEATING

        $this->assertInternalType('array', $array);
    }

    // Depending on the binary flag passed in, the byBinary() method has three possible return types: a single enum member, an array of members or null.
    public function testBinaryNull()
    {
        $null = CarFeature::byBinary(0); // There is no binary flag matching 0, so this will result in null

        $this->assertNull($null);

        print 'Feature not found, null is given.'.PHP_EOL;
    }

    // To force the method to always return an array (even empty), set the singular parameter to false
    public function testBinaryFalse()
    {
        $false = CarFeature::byBinary(0, false); // Will result in an empty array instead

        $this->assertEmpty($false);

        print 'Feature not found, force an empty array.'.PHP_EOL;
    }

    // Ensure the list is always an array, loop through it and print each feature
    public function testBinaryAsArray()
    {
        $order = CarFeature::CONVERTIBLE()->getBinary() | CarFeature::SEAT_HEATING()->getBinary();

        foreach(CarFeature::byBinary($order, false) as $feature) {
            echo $feature;
        }

        $this->assertInstanceOf('CarFeature', $feature);
    }
}
/** @end BinaryTest.php **/