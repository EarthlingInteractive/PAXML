<?php

class EarthIT_PAXML {
	public static function emit( $thing, $indent="", $indentDelta="\t" ) {
		$emitter = new EarthIT_PAXML_PAXMLEmitter();
		$emitter->emit($thing, $indent, $indentDelta, Nife_Util::getEchoFunction());
	}
}