<?php 

include __DIR__ . "/../lib/Srt.php";

try {

	$srt = new Srt();


	$milli = $srt->toMilli("00:00:01,000");

	equal($srt->toMilli("00:00:00,000"), 0);
	equal($srt->toMilli("125:54:42,124"), tomilli(125,54,42,124));

	$sub = $srt->toSubtitle("2\n01:02:34,567 --> 89:54:32,101\nHello World!");
	equal($sub->content, "Hello World!");
	equal($sub->from, tomilli(1,2,34,567));
	equal($sub->to, tomilli(89,54,32,101));

	$srt->load(__DIR__ . "/test.srt");

	equal(count($srt->subTitles), 2);

	$sub = $srt->subTitles[0];
	equal($sub->content, "We left Saint Lucia for Panama 4 days ago");
	equal($sub->from, 0);
	equal($sub->to, tomilli(0,0,3,577));	

	equal($srt->toTimecode(453282124), "125:54:42,124", 1);
	equal($srt->toTimecode(tomilli(1,2,3,7)), "01:02:03,007", 1);
	equal($srt->toTimecode(0), "00:00:00,000", 1);

}
catch(\Exception $e) {
	throw $e;
}
echo "OK" . PHP_EOL;


function tomilli($h, $min, $sec, $mill) {

	return ($h*3600+60*$min+$sec)*1000+$mill;

}

function equal($a, $b, $strict = 0) {


	if(!$strict && $a == $b) {
		return true;
	}
	else if($strict && $a === $b) {
		return true;
	}
	else {

		throw new \Exception($a . " not equal to " . $b);
	}

}