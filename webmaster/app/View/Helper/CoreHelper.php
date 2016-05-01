<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class CoreHelper extends AppHelper {
	
	function render($content){
		return str_replace('{SITE_URL}',$this->webroot,$content);
	}
	
	function formatDataRechargeByOperators($arrData){
		
		$arrFData=array();
		if($arrData){
			foreach($arrData as $row){
				$arrFData[$row[0]['month']][$row['Operator']['code']]+=floatval($row[0]['tamount']);
			}
		}
		return $arrFData;
	}
	
	function formatDataRechargeByServices($arrData){
		
		$arrFData=array();
		if($arrData){
			foreach($arrData as $row){
				
				$arrFData[$row[0]['month']][$row['RechargeType']['recharge_type']]+=floatval($row[0]['tamount']);
			}
		}
		return $arrFData;
	}
	
	function formatDataRechargesAndCustomersByMonth($arrRechData){
		
		$arrFData=array();
		if($arrRechData){
			foreach($arrRechData as $row){
				
				$arrFData[$row[0]['month']]['tamount']+=floatval($row[0]['tamount']);
			}
		}
		
		return $arrFData;
	}
}
