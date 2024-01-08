<?php

class EarthIT_PAXML {
	public static function emit( $thing, $indent="", $indentDelta="\t" ) {
		$emitter = new EarthIT_PAXML_PAXMLEmitter();
		$emitter->emit($thing, $indent, $indentDelta, EarthIT_PAXML::getEchoFunction());
	}
	
	public static function emitBlock( $thing, $indent="", $indentDelta="\t" ) {
		echo $indent;
		self::emit($thing, $indent, $indentDelta);
		echo "\n";
	}

	/**
	 * Returns an output function that simply echoes whatever is fed to it.
	 * @api
	 */
	public static function getEchoFunction() {
		return array('EarthIT_PAXML','output');
	}

	public static function output( $thing ) {
		if( is_scalar($thing) ) {
			echo $thing;
		} else if( $item instanceof Nife_Blob || $thing instanceof EarthIT_JSON_PrettyPrintedJSONBlob ) {
			$thing->writeTo( array('EarthIT_PAXML','output') );
		} else {
			throw new Exception("Don't know how to write ".var_export($thing,true)." to output.");
		}
	}
}
