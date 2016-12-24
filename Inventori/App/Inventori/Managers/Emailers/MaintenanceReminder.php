<?php

namespace Inventori\App\Inventori\Managers\Emailers;

use Inventori\App\InventoriModel;

class MaintenanceReminder {

	protected $inventori;

	public function __construct($inventori) {

		$this->inventori = $inventori;
	}

	public function email() {
		$pics = json_decode($this->inventori->pic, true);

		try {
			foreach ($pics as $pic) {
				
				try{
			
					\Mail::to($pic['email'])
						->send(new \Inventori\Mail\MaintenanceReminder($this->inventori));
				
				} catch (\Swift_RfcComplianceException $e) { }
			
			}
		} catch (\ErrorException $e) { }

	}
}