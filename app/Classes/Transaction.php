<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Manage database transactions
 *
 * @author  PhyoNaing Htun
 * @create  2022/06/19
 */
class Transaction {

    /**
	 * Calling process method to wrap database transaction automatically
	 * 
	 * @return boolean
	 */
	public function executeProcess()
	{
		# get caller file name
		$callerFile = debug_backtrace()[0]['file'];
		# get error occur line number from caller file
		$errorLineNo = debug_backtrace()[0]['line'];
		
		DB::beginTransaction();
		try {
			$result = $this->process();
			# if $result is not array and `status` is not exists
			if (!is_array($result) || !isset($result['status'])) {
				DB::rollBack();
				Log::debug('process() method that instantiate from '.__CLASS__.' must be return array with format [\'status\' => boolean, \'error\'=>\'some error message\'] in file '.$callerFile.' at line '.$errorLineNo.' that instantiate the class '.get_called_class());
				return false;
			}
			# if result['status'] is true, then commit
			if ($result['status']) {
				DB::commit();
				return true;
			} else {
				# if result is false, some process error occur
				DB::rollBack();
				# writing log for strange conditions 
				Log::debug('Process Error: '.$result['error'].' in file '.$callerFile.' at line '.$errorLineNo.' that instantiate the class '.get_called_class());
				return false;
			}
		} catch (Exception $e) {
			DB::rollBack();
			Log::debug($e->getMessage().' in file '.$callerFile.' at line '.$errorLineNo.' that instantiate the class '.get_called_class());
			return false;
		}
	}

	/**
	 * Write your data access(insert/update/delete) without needing database transaction 
	 * This method is to be overide from inheritance class
	 * 
	 * @return  array
	 * @format	['status' => boolean, 'error'=>'some error message']
	 * Note: 'error' key can be omit if status is true in return array
	 */
	public function process()
    {
        # process...
    }
}
