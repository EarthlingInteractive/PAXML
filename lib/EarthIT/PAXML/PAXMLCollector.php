<?php

/**
 * It collects all items applied to into an array.
 * 
 * Primary use: Pass as an output function when you want
 * to collect everything as one big string.
 */
class EarthIT_PAXML_PAXMLCollector
{
	protected $items;
	
	public function __invoke( $item ) {
		$this->items[] = $item;
	}
	
	public function getItems() {
		return $this->items;
	}
	
	public function __toString() {
		return implode('', $this->items);
	}
}
