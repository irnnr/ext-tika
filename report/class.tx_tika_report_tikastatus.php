<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Ingo Renner <ingo@typo3.org>
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


/**
 * Provides an status report about whether Tika is properly configured
 *
 * @author	Ingo Renner <ingo@typo3.org>
 * @package TYPO3
 * @subpackage tika
 */
class tx_tika_report_TikaStatus implements tx_reports_StatusProvider {

	/**
	 * Checks whether Tika is properly configured
	 *
	 * @see typo3/sysext/reports/interfaces/tx_reports_StatusProvider::getStatus()
	 */
	public function getStatus() {
		$reports = array();

		$registry = t3lib_div::makeInstance('t3lib_Registry');
		$tikaProperlyConfigured = $registry->get('tx_tika', 'availability.tika', FALSE);

		if (!$tikaProperlyConfigured) {
			$reports[] = t3lib_div::makeInstance('tx_reports_reports_status_Status',
				'Apache Tika',
				'Configuration Incomplete',
				'Please check your configuration for Apache Tika. Java, Tika or both are not configured properly yet.',
				tx_reports_reports_status_Status::ERROR
			);
		}

		return $reports;
	}
}


if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tika/report/class.tx_tika_report_tikastatus.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/tika/report/class.tx_tika_report_tikastatus.php']);
}

?>