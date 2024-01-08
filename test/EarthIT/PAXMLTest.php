<?php
use PHPUnit\Framework\TestCase;

class EarthIT_PAXMLTest extends TestCase
{
	public function testEmit() {
		ob_start();
		EarthIT_PAXML::emit(array('p', 'Hello, world!'));
		$this->assertEquals("<p>Hello, world!</p>", ob_get_clean());
	}

	public function testEmitBlock() {
		ob_start();
		EarthIT_PAXML::emitBlock(array('p', array('span', 'Hello, world!')), "\t");
		$this->assertEquals(
			"\t<p>\n".
			"\t\t<span>Hello, world!</span>\n".
			"\t</p>\n",
			ob_get_clean());
	}
}
