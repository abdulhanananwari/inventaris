<?php

namespace Inventori\App\Location\Managers\Validators;

use Inventori\App\Location\LocationModel;

/**
* 
*/
class OnCreate
{	
	protected $location;
	
	public function __construct(LocationModel $location)
	{
		$this->location = $location;
	}

	public function validate() {

		if ($this->location->id) {
			return ['nama sudah ada'];
		}

		return true;
	}
}