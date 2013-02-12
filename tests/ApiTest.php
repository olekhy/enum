<?php
/**
 * ------------------------------------------------------------------------------------
 * ApiTest.php
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
require('examples/Api.php');

class ApiTest extends \PHPUnit_Framework_TestCase {

    // Defining class constants (such as CHOCOLATE, STRAWBERRY and BLACKBERRY) automatically constructs enums for these constants with associated values
    // To use these enums call them directly
    public function testApiConstruct()
    {
        $chocolate = Topping::CHOCOLATE();

        $this->assertInstanceOf('Topping', $chocolate);
        print sprintf('Chocolate is instance: %s','Topping').PHP_EOL;
    }

    // Or use the static get() method
    public function testApiInstance()
    {
        $chocolate = Topping::get('CHOCOLATE');

        $this->assertInstanceOf('Topping', $chocolate);
        print sprintf('Chocolate is instance: %s','Topping').PHP_EOL;
    }

    // Every enum has a value, ordinal offset and binary flag
    // Values may overlap, ordinal offset will always be unique
    public function testApiStrawberry()
    {
        $strawberry = Topping::STRAWBERRY();
        $value = $strawberry->getValue();   // 'strawberry'
        $ordinal = $strawberry->getOrdinal(); // 1 (2nd constant in the zero-based list)
        $binary = $strawberry->getBinary();  // 2 (generating a unique flag for this enum, the 2nd bit is set, which results in 2)

        $this->assertEquals($value, 'strawberry');
        $this->assertEquals($ordinal, '1');
        $this->assertEquals($binary, '2');

        print sprintf('Strawberry equal: %s, ordinal as: %d and binary as: %d.',$value, $ordinal, $binary).PHP_EOL;
    }

    // Searching for a specific enum using these properties; All these calls fetch the Topping::BLACKBERRY enum 
    public function testApiBlackberry()
    {
        $byValue = Topping::byValue('blackberry'); // Topping::BLACKBERRY instance
        $byOrdinal = Topping::byOrdinal(2);   // exact same instance
        $byBinary = Topping::byBinary(0x04); // idem

        $this->assertInstanceOf('Topping', $byValue);
        $this->assertInstanceOf('Topping', $byOrdinal);
        $this->assertInstanceOf('Topping', $byBinary);

        print sprintf('Blackberry Instance: %s.', $byValue).PHP_EOL;
    }

    // Since Topping is an enum-type - and therefore a class, we can use it in type-hints
    public function testApiTypeHints()
    {
        function order(Topping $topping) {
            if($topping == Topping::BLACKBERRY()) {
                return 'Unfortunately, we are all out of '.$topping->getValue().' topping!';
            }
            return 'Here you go, an icecream with '.$topping->getValue().' topping!';
        }

        // Attempt to order an icecream with different toppings
        $icecream = order(Topping::STRAWBERRY());
        $blackberry = order(Topping::BLACKBERRY());

        try {
            order('test'); // Error, 'test' is no Topping instance
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
        
        
        $this->assertInternalType('string', $icecream);
        $this->assertInternalType('string', $blackberry);

        print sprintf('%s.', $icecream).PHP_EOL;
        print sprintf('%s.', $blackberry).PHP_EOL;
        print sprintf('%s.', $error).PHP_EOL;
    }

    // Comparing enum instances by using the comparison operators
    public function testApiComparison()
    {
        $true = (Topping::STRAWBERRY() == Topping::STRAWBERRY()); // true
        $false = (Topping::STRAWBERRY() == Topping::BLACKBERRY()); // false

        $this->assertTrue($true);
        $this->assertFalse($false);

        print sprintf('Comparing enum instances gives boolean type. Strawberry as %s.', $true).PHP_EOL;
    }

    public function testApiEnumComparison()
    {
        // Additionally, each enum has an equals() method to compare with various values
        $chocolate = Topping::CHOCOLATE();

        // When comparing with strings, it assumes those strings to be member names (such as CHOCOLATE and STRAWBERRY)
        $mc = $chocolate->equals('CHOCOLATE');  // true
        $ms = $chocolate->equals('STRAWBERRY'); // false

        // When comparing with any value (including strings), it assumes those to be the registered value for the enum (such as 'chocolate' and 'blackberry' in this case)
        $vc = $chocolate->equals('chocolate');  // true
        $vs = $chocolate->equals('strawberry'); // false

        $this->assertTrue($mc);
        $this->assertFalse($ms);
        $this->assertTrue($vc);
        $this->assertFalse($vs);

        print 'Comparing enum values gives boolean type.'.PHP_EOL;
    }
}
/** @end ApiTest.php **/