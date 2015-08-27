<?php

class EarthIT_PAXMLTest extends PHPUnit_Framework_TestCase
{
	public function testEmit() {
		ob_start();
		EarthIT_PAXML::emit(['p', 'Hello, world!']);
		$this->assertEquals("<p>Hello, world!</p>", ob_get_clean());
	}

	public function testEmitBlock() {
		ob_start();
		EarthIT_PAXML::emitBlock(['p', ['span', 'Hello, world!']], "\t");
		$this->assertEquals(
			"\t<p>\n".
			"\t\t<span>Hello, world!</span>\n".
			"\t</p>\n",
			ob_get_clean());
	}
}
