<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Ingo Renner <ingo@typo3.org>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

namespace ApacheSolrForTypo3\Tika;

use ApacheSolrForTypo3\Tika\Tests\Unit\ExecRecorder;

/**
 * exec() mock to capture invocation parameters for the actual \exec() function
 *
 * @param $command
 * @param array $output
 */
function exec($command, array &$output = array()) {
	$output = ExecRecorder::$execOutput[ExecRecorder::$execCalled];
	ExecRecorder::$execCalled++;
	ExecRecorder::$execCommand = $command;
}

/**
 * shell_exec() mock to capture invocation parameters for the actual \shell_exec() function
 *
 * @param $command
 * @return string
 */
function shell_exec($command) {
	$output = ExecRecorder::$execOutput[ExecRecorder::$execCalled];
	ExecRecorder::$execCalled++;
	ExecRecorder::$execCommand = $command;

	return $output;
}


// ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- ----- -----


namespace ApacheSolrForTypo3\Tika\Tests\Unit;


/**
 * Class ExecRecorder, holds exec() results
 *
 */
class ExecRecorder {

	/**
	 * Allows to capture exec() parameters
	 *
	 * @var string
	 */
	public static $execCommand = '';

	/**
	 * Output to return to exec() calls
	 *
	 * @var array
	 */
	public static $execOutput = array();

	/**
	 * Indicator whether/how many times the exec() mock was called.
	 *
	 * @var int
	 */
	public static $execCalled = 0;


	/**
	 * Resets the exec() mock
	 */
	public static function reset() {
		self::$execCalled = 0;
		self::$execCommand = '';
		self::$execOutput = array();
	}

	/**
	 * Adds output for an exec() call.
	 *
	 * @param array $lines One line of returned output per element in $lines
	 */
	public static function setReturnExecOutput(array $lines) {
		self::$execOutput[] = $lines;
	}
}