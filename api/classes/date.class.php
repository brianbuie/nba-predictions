<?php

class Date{

	public $selected_day;
	private $today;
	private $season_opener;

	public function __construct($date){
		$this->selected_day = new DateTime($date);
		$this->today = new DateTime();
		$this->season_opener = new DateTime('2016-10-01');
		
		if(!$this->is_valid()){
			if($this->selected_day < $this->season_opener){
				$this->selected_day = $this->season_opener;
			}elseif($this->selected_day > $this->today){
				$this->selected_day = $this->today;
			}
		}
	}

	public function format($date_object, $format){
		return $date_object->format($format);
	}

	public function is_valid(){
		if($this->selected_day >= $this->season_opener && $this->selected_day <= $this->today){
			return true;
		}
	}

	public function modify($string){
		$this->selected_day->modify($string);
	}
}