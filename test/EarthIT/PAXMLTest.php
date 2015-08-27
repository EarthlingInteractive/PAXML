<?php

class EarthIT_PAXMLTest extends PHPUnit_Framework_TestCase
{
	public function testEmit() {
		ob_start();
		EarthIT_PAXML::emit(['p', 'Hello, world!']);
		$this->assertEquals("<p>Hello, world!</p>\n", ob_get_clean());
	}
}
