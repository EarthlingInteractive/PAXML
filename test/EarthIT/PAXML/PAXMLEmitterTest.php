<?php
use PHPUnit\Framework\TestCase;

class EarthIT_PAXML_PAXMLEmitterTest extends TestCase
{
	public function setUp() : void {
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
		$this->assertEncodesAs("<hi/>", array('hi'));
	}
	
	public function testEmitTagWithAttributes() {
		$this->assertEncodesAs("<hi name=\"People &amp; friends\"/>", array('hi', 'name'=>'People & friends'));
	}
	
	public function testEmitTagWithAttributesAndChild() {
		$this->assertEncodesAs("<hi name=\"People &amp; friends\">Bill</hi>", array('hi', 'name'=>'People & friends', 'Bill'));
	}
	
	public function testEmitTagWitChildTag() {
		$this->assertEncodesAs(
			"<hi>\n".
			"\t<bye/>\n".
			"</hi>", array('hi', array('bye')));
	}
	
	public function testEmitTagWitChrildens() {
		$this->assertEncodesAs(
			"<p><br/>OH &lt; HELLO<br/></p>",
			array('p', array('br'), 'OH < HELLO', array('br')));
	}
	
	public function testEmitParagraphWithSpan() {
		$this->assertEncodesAs(
			'<p style="color: green">I like <span style="color: red">food</span>.</p>',
			array('p', 'style'=>'color: green', 'I like ', array('span', 'style'=>'color: red', 'food'), '.')
		);
	}
	
	public function testEmitNestedStuff() {
		$this->assertEncodesAs(
			"<tr>\n".
			"\t<td>\n".
			"\t\t<label>Thing <input type=\"checkbox\"/></label>\n".
			"\t</td>\n".
			"</tr>",
			array('tr', array('td', array('label', 'Thing ', array('input', 'type'=>'checkbox'))))
		);
	}
}
