<?php namespace Websublime\Enum;
/**
* PHP Enums Library
* Copyright (c) 2011 Tim Kurvers <http://www.moonsphere.net>
* 
* This library provides enum functionality similar to the implementation
* found in Java. It differs from existing libraries by offering one-shot
* enum constructors through static initialization, enum iteration as well
* as equality support and value, ordinal and binary lookups.
* 
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

/**
 * Helper interface with constants required by this library
 */
interface EnumConstants {
    
    /**
     * Version of the PHP Enums Library
     */
    const VERSION = 'v1.0';
    
    /**
     * Enum constructor method name (differs from the regular PHP constructor by an additional underscore)
     */
    const CONSTRUCTOR = '___construct';
    
}

/** @end EnumConstants.php **/