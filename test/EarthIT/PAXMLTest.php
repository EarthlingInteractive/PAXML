<?php

class EarthIT_PAXMLTest
{
	public function testEmit() {
		ob_start();
		EarthIT_PAXML::emit(['p', 'Hello, world!']);
		$this->assertEquals("<p>Hello, world!</p>", ob_get_clean());
	}
}
