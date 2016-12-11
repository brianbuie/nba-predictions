<?php

function display_difference($value, $inverted = false){
	if(!$inverted){
		if( $value < 0 ){
			return '<span class="negative"><i class="fa fa-caret-down"></i> ' . abs($value) . '</span>';
		} elseif( $value == 0){
			return '<span class="incorrect"> - </span>';
		} else {
			return '<span class="positive"><i class="fa fa-caret-up"></i> ' . abs($value) . '</span>';
		}
	} else {
		if( $value > 0 ){
			return '<span class="negative"><i class="fa fa-caret-down"></i> ' . abs($value) . '</span>';
		} elseif( $value == 0){
			return '<span class="incorrect"> - </span>';
		} else {
			return '<span class="positive"><i class="fa fa-caret-up"></i> ' . abs($value) . '</span>';
		}
	}
}