<?php
// In a rotary switch with 3 pins the two outer pins connect to the middle pin 
// depending on the way it's being turned.
// 
// If we have outer pin A & B, we can represent their values as 0 or 1. We use
// 0 if there is an open (no) connection to the middle pin and 1 there is a
// closed connection.
// 
// Using this model we have 4 possible states are 00, 01, 10, 11. Where in the
// first state pin A & B are low, in state 01 only pin B is high, in 10 only
// A is high and in 11 both are high.
// 
// The way you can determine which way the switch is turned is as follows:
// Imagine an endless string of repeating 0011's. When turning clockwise we
// shift 1 position to the right, and counter clockwise we shifter 1 position
// to the left.
// 
// So if you have state 11, and you shift to the right, you'd get 10: as we
// went from 00(11)00 -> 01(10)01.  Counter clockwise is the exact same thing 
// but the other way around:
// 
// ```
// Current state: ..001100(11)001100..
// CCW would be:  ..00110(01)1001100..
// CW  would be:  ..0011001(10)01100..
// ```
// 
// In code (e.g. js) it would look like this:
// 
// ```js
// x = [0, 0, 1, 1]
// cw = (x) => x.unshift(x.pop())
// ccw = (x) => x.push(x.shift())
// ```
function algorithm(string $from, string $to) {
	if ($from == $to) {
		return 'nothing';
	}

	// If we have 00 or 11, check if the first pin has changed
	// if so, we are shifting left, and thus cw
	if ($from[0] == $from[1]) {
		return $from[0] == $to[0] ? 'cw' : 'ccw';
	} 

	// In the otherc ase we check which way the last character moved
	return $from[1] == $to[0] ? 'cw' : 'ccw';
}

// Just some simple script to (unit)test our algorithm for finding to
// way the rotary switch is being turned
$testData = [
	'cw' => [
		['from' => '01', 'to' => '11'],
		['from' => '11', 'to' => '10'],
		['from' => '10', 'to' => '00'],
		['from' => '00', 'to' => '01'],
	],
	'ccw' => [
		['from' => '10', 'to' => '11'],
		['from' => '11', 'to' => '01'],
		['from' => '01', 'to' => '00'],
		['from' => '00', 'to' => '10'],
	],
	'nothing' => [
		['from' => '00', 'to' => '00'],
		['from' => '01', 'to' => '01'],
		['from' => '10', 'to' => '10'],
		['from' => '11', 'to' => '11'],
	]
];

foreach ($testData as $expectedResult => $tests) {
	foreach ($tests as $test) {
		$result = algorithm($test['from'], $test['to']);
		if ($result == $expectedResult) {
			echo "OK: {$test['from']} => {$test['to']} = {$result}\n";
		} else {
			echo "ERROR: {$test['from']} => {$test['to']} expected {$expectedResult} but got {$result}\n";
		}
	}
}
