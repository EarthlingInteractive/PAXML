<?php

class EarthIT_PAXML_PAXMLBlob
{
	protected $value;
	protected $indent;
	protected $indentDelta;
	
	/**
	 * @param array $value array representation of XML to be emitted, e.g. ['p', 'style'=>'color:green', 'Hello, world!']
	 * @param string $indent prefix used to indent each line.  usually ''
	 * @param string $indentDelta will be appended to $indent to defined indentation for child elements
	 */
	public function __construct( $value, $indent="", $indentDelta="\t" ) {
		$this->value = $value;
		$this->indent = $indent;
		$this->indentDelta = $indentDelta;
	}
	
	public function getLength() { return null; }
	
	public function writeTo( $callback ) {
		$emitter = new EarthIT_PAXML_PAXMLEmitter();
		$emitter->emit( $this->value, $this->indent, $this->indentDelta, $callback );
	}

	public function __toString() { 
		$c = new EarthIT_PAXML_PAXMLCollector();
		$this->writeTo($c);
		return (string)$c;
	 }
}
