<?php

class Date{

	public $selected_day;
	public $compare_day;
	private $today;
	private $season_opener;
	private $next_day;
	private $prev_day;

	public function __construct($date){
		$this->selected_day = new DateTime($date);
		$this->compare_day = new DateTime($this->selected_day->format('Y-m-d'));
		$this->compare_day->modify('-2 days');
		$this->today = new DateTime();
		$this->season_opener = new DateTime('2016-10-01');
		$this->next_day = new DateTime($this->selected_day->format('Y-m-d'));
		$this->next_day->modify('+1 day');
		$this->prev_day = new DateTime($this->selected_day->format('Y-m-d'));
		$this->prev_day->modify('-1 day');
	}

	public function get_next_day(){
		if($this->next_day <= $this->today){
			return $this->next_day;
		}
	}

	public function get_prev_day(){
		if($this->prev_day >= $this->season_opener){
			return $this->prev_day;
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
		$this->__construct($this->selected_day->format('Y-m-d'));
	}
}