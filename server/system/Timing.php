<?php
 // Based on this handy script: http://www.if-not-true-then-false.com/2010/php-timing-class-class-for-measure-php-scripts-execution-time-and-php-web-page-load-time/

	class Timing {
		private $break;
		private $start_time;
		private $stop_time;
 
		// Constructor for Timing class
		//public function __construct($break = "<br />") {
		public function __construct($break = "\n") {
			$this->break = $break;
			// Set timezone
			date_default_timezone_set('Europe/Athens');
		}
 
		/**
                 *  Set start time
                 */
		public function start() {
			$this->start_time = microtime(true);
		}
 
		/**
                 *  Set stop/end time
                 */
		public function stop() {
			$this->stop_time = microtime(true);
		}
 
		/**
                 *  Returns time elapsed from start
                 * 
                 * @return float 
                 */
		public function getElapsedTime() {
			return $this->getExecutionTime(microtime(true));
		}
 
		/**
                 *  Returns total execution time
                 * 
                 * @return float
                 */
		public function getTotalExecutionTime() {
			if (!$this->stop_time) {
				return false;
			}
			return $this->getExecutionTime($this->stop_time);
		}
 
		/**
                 *  Returns start time, stop time and total execution time
                 * 
                 * @return array
                 */
		public function getFullStats() {
			if (!$this->stop_time) {
				return false;
			}
 
			$stats = array();
			$stats['start_time'] = $this->getDateTime($this->start_time);
			$stats['stop_time'] = $this->getDateTime($this->stop_time);
			$stats['total_execution_time'] = $this->getExecutionTime($this->stop_time);
 
			return $stats;
		}
 
		/**
                 *  Prints time elapsed from start
                 */
		public function printElapsedTime() {
			echo $this->break . $this->break;
			echo "Elapsed time: " . $this->getExecutionTime(microtime(true));
			echo $this->break . $this->break;
		}
 
		/**
                 *  Prints total execution time
                 */
		public function printTotalExecutionTime() {
			if (!$this->stop_time) {
				return false;
			}
 
			echo $this->break . $this->break;
			echo "Total execution time: " . $this->getExecutionTime($this->stop_time);
			echo $this->break . $this->break;
		}
 
		/**
                 *  Prints start time, stop time and total execution time
                 */
		public function printFullStats() {
			if (!$this->stop_time) {
				return false;
			}
 
			echo $this->break . $this->break;
			echo "Script start date and time: " . $this->getDateTime($this->start_time);
			echo $this->break;
			echo "Script stop end date and time: " . $this->getDateTime($this->stop_time);
			echo $this->break . $this->break;
			echo "Total execution time: " . $this->getExecutionTime($this->stop_time);
			echo $this->break . $this->break;
		}
 
		// Format time to date and time
		private function getDateTime($time) {
			return date("Y-m-d H:i:s", $time);
		}
 
		// Get execution time by timestamp
		private function getExecutionTime($time) {
			return $time - $this->start_time;
		}
                
                public function getTimeFileName($sync_table_name) {
                    global $Options; 
                    if (!$sync_table_name) {
				return null;
			}
                        
                    $filename = date('mdY_hias').'_sync_'.$sync_table_name.'.json';
                    
                    return $filename;
                }
                           
	}
 
?>