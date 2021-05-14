<?php 

include __dir__ . "/Subtitle.php";

class Srt {

	public $filename;
	public $subTitles = [];
	
	public function load($filename) {
	
		$this->filename = $filename;
		$this->subtitles = [];
		$content = trim(file_get_contents($filename));
		$entries = explode("\n\n", $content);
		foreach($entries as $entry) {
			$this->subTitles[] = $this->toSubtitle($entry);
		}
	
	}

	public function print() {

		$content = "";
		foreach($this->subTitles as $k => $sub) {
			
			/*echo "---------------" . PHP_EOL;
			echo $k . PHP_EOL;
			echo $sub->content . PHP_EOL;
			echo $this->toTimecode($sub->from) . PHP_EOL;
			echo $sub->to . PHP_EOL;*/
			$content .= ($k+1) . PHP_EOL . $this->toTimecode($sub->from) . " --> " . $this->toTimecode($sub->to) . PHP_EOL . $sub->content . PHP_EOL . PHP_EOL;
		}

		//echo PHP_EOL;

		echo $content;

	}

	public function offset($offset, $from = 0) {

		$from = $this->toMilli($from);

		foreach($this->subTitles as $subTitle) {
			if((int)$subTitle->from  >=  (int)$from) {	
				$subTitle->from += $offset;
				$subTitle->to += $offset;
			}
		}

	}

	public function toSubtitle($text) {
	
		list($id, $timestamp, $content) = explode("\n", $text, 3);
		list($from, $to) = explode(" --> ", $timestamp);
		$from = $this->toMilli($from);
		$to = $this->toMilli($to);
		return new Subtitle($from, $to, $content);
	
	}

	public function toTimecode($milli)
	{

		$hour = floor($milli / 3600000);
		$min = floor(($milli - $hour * 3600000) / 60000);
		$milli = str_pad($milli - $hour * 3600000 - $min * 60000, 5, "0", STR_PAD_LEFT);
		$milliComma = substr($milli, 0, 2) . "," . substr($milli, 2);

		return str_pad($hour,2, "0", STR_PAD_LEFT) . ":" . str_pad($min,2, "0", STR_PAD_LEFT) . ":" . $milliComma;

	}
	
	public function toMilli($timecode) 
	{

		if(strstr($timecode, ":")) {
			$timecode = str_replace(",", "", $timecode);
			list($hour, $min, $milli) = explode(":", $timecode);
			return (int)($hour * 3600 + $min * 60) * 1000 + $milli;
		}
		else {
			return (int)$timecode;
		}
	
	}

}