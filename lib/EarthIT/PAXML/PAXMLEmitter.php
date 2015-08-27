<?php

class EarthIT_PAXML_PAXMLEmitter
{
	public function emit( $thing, $indent, $indentDelta, callable $outputFunction ) {
		if( is_array($thing) ) {
			$tagName = array_shift($thing);
			$children = [];
			$attributes = [];
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
				$previousChildWasText = false;
				foreach( $children as $c ) {
					if( !is_scalar($c) and !$previousChildWasText ) {
						call_user_func( $outputFunction, "\n$childIndent" );
					}
					$this->emit($c, $indent, $indentDelta, $outputFunction);
					$previousChildWasText = is_scalar($c);
				}
				if( !$previousChildWasText ) call_user_func( $outputFunction, "\n$indent" );
				call_user_func( $outputFunction, "</$tagName>" );
			}
		} else if( is_scalar($thing) ) {
			call_user_func( $outputFunction, htmlspecialchars((string)$thing) );
		} else {
			throw new Exception("Don't know how to interpret ".var_export($thing,true)." as PAXML");
		}
	}
}
