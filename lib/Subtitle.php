<?php


class Subtitle {


	public $content;
	public $from;
	public $to;

	public function __construct($from, $to, $content) {
		$this->from = $from;
		$this->to = $to;
		$this->content = $content;
	}

}