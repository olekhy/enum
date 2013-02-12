<?php
/**
 * PHP Enums Library
 * Copyright (c) 2011 Tim Kurvers <http://www.moonsphere.net>
 * 
 * This library provides enum functionality similar to the implementation
 * found in Java. It differs from existing libraries by offering one-shot
 * enum constructors through static initialization, enum iteration as well
 * as equality support and value, ordinal and binary lookups.
 * The contents of this file are subject to the MIT License, under which 
 * this library is licensed. See the LICENSE file for the full license.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, 
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY 
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 * 
 * @author  Tim Kurvers <tim@moonsphere.net>
 */
use Websublime\Enum\Enum;

/**
 * This example shows how to iterate over defined enumerations
 */

// Each country has a unique entry calling code 
class CountryEntryCode extends Enum {

    const NETHERLANDS       = 31;
    const NORWAY            = 47;
    const UNITED_KINGDOM    = 44;

}

// As well as an optional exit code (note that enum members can have non-unique values!)
class CountryExitCode extends Enum {

    const NETHERLANDS       = 00;
    const NORWAY            = 00;

}

/** @end Iteration.php **/