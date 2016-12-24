<?php

namespace Inventori\App\Inventori\Managers\Emailers;

use Inventori\App\InventoriModel;

class CheckInventoriReminder {

	protected $inventori;

	public function __construct($inventori) {

		$this->inventori = $inventori;
	}

	public function email() {
		$pics = json_decode($this->inventori->pic, true);

		try {

			foreach ($pics as $pic) {
				
				try {

					\Mail::to($pic['email'])
						->send(new \Inventori\Mail\CheckInventoriReminder($this->inventori));
		
				} catch (\Swift_RftComplianceException $e) { }

			}

		} catch (\ErrorException $e) { }
	}
}