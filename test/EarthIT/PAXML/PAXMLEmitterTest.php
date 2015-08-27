<?php

class EarthIT_PAXML_PAXMLEmitterTest extends PHPUnit_Framework_TestCase
{
	public function setUp() {
		$this->e = new EarthIT_PAXML_PAXMLEmitter();
	}
	
	protected function assertEncodesAs($expectedOutput, $thing) {
		$blob = new EarthIT_PAXML_PAXMLBlob($thing);
		$this->assertEquals( $expectedOutput, (string)$blob );
	}
	
	public function testEmitText() {
		$this->assertEncodesAs("Hi", "Hi");
	}
	
	public function testEmitSimpleTag() {
		$this->assertEncodesAs("<hi/>", ['hi']);
	}
	
	public function testEmitTagWithAttributes() {
		$this->assertEncodesAs("<hi name=\"People &amp; friends\"/>", ['hi', 'name'=>'People & friends']);
	}
	
	public function testEmitTagWithAttributesAndChild() {
		$this->assertEncodesAs("<hi name=\"People &amp; friends\">Bill</hi>", ['hi', 'name'=>'People & friends', 'Bill']);
	}
	
	public function testEmitTagWitChildTag() {
		$this->assertEncodesAs(
			"<hi>\n".
			"\t<bye/>\n".
			"</hi>", ['hi', ['bye']]);
	}
	
	public function testEmitTagWitChrildens() {
		$this->assertEncodesAs(
			"<p>\n".
			"\t<br/>OH &lt; HELLO<br/>\n".
			"</p>", ['p', ['br'], 'OH < HELLO', ['br']]);
	}
	
	public function testEmitParagraphWithSpan() {
		$this->assertEncodesAs(
			'<p style="color: green">I like <span style="color: red">food</span>.</p>',
			['p', 'style'=>'color: green', 'I like ', ['span', 'style'=>'color: red', 'food'], '.']
		);
	}
}
