<?php

class EarthIT_PAXML_PAXMLEmitter
{
	public function emit( $thing, $indent, $indentDelta, $outputFunction ) {
		if( is_array($thing) ) {
			$tagName = array_shift($thing);
			$children = array();
			$attributes = array();
			foreach( $thing as $k=>$v ) {
				if( is_numeric($k) ) {
					$children[] = $v;
				} else {
					$attributes[$k] = $v;
				}
			}
			
			$stuff = "<$tagName";
			foreach( $attributes as $k=>$v ) {
				$stuff .= " $k=\"".htmlspecialchars($v)."\"";
			}
			if( count($children) === 0 ) {
				$stuff .= "/>";
				call_user_func( $outputFunction, $stuff );
			} else {
				$stuff .= ">";
				call_user_func( $outputFunction, $stuff );
				$childIndent = $indent.$indentDelta;
				$containsText = false;
				foreach( $children as $c ) {
					if( is_scalar($c) ) $containsText = true;
				}
				foreach( $children as $c ) {
					if( !$containsText ) {
						call_user_func( $outputFunction, "\n$childIndent" );
					}
					$this->emit($c, $childIndent, $indentDelta, $outputFunction);
				}
				if( !$containsText ) call_user_func( $outputFunction, "\n$indent" );
				call_user_func( $outputFunction, "</$tagName>" );
			}
		} else if( is_scalar($thing) ) {
			call_user_func( $outputFunction, htmlspecialchars((string)$thing) );
		} else {
			throw new Exception("Don't know how to interpret ".var_export($thing,true)." as PAXML");
		}
	}
}
