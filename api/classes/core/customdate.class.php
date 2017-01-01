<?php

class CustomDate{

	public $date;
	private $max;
	private $min;

	public function __construct($date_string){
		$this->date = new DateTime($date_string);
		// max today
		$this->max = new DateTime();
		// min season opener
		$this->min = new DateTime('2016-10-25');
		
		if(!$this->is_valid()){
			// if date is less than min, set it to min, otherwise set it to max 
			$this->date = $this->date < $this->min ? $this->min : $this->max;
			// only checks if less than min and sets to max if it isn't, 
			// because if it's invalid and not less than min, it must be higher than max
		}
	}

	public function format($format){
		// standard DateTime method
		return $this->date->format($format);
	}

	public function is_valid(){
		// if date is more than min (season opener) and less than max (today), it is valid
		if($this->date >= $this->min && $this->date <= $this->max){
			return true;
		}
	}

	public function modify($string){
		// standard DateTime method
		$this->date->modify($string);
	}
}