<?php

namespace Inventori\App\Inventori\Managers\Calculators;

use Inventori\App\Inventori\InventoriModel;

/**
*
*/
class JumlahHariSejakMaintenanceTerakhir
{
	protected $inventori;

	public function __construct(InventoriModel $inventori)
	{
		$this->inventori = $inventori;
	}

	public function calculate() {
		
		$maintenanceInventoriTerakhir = $this->inventori->maintenanceInventori()
			->orderBy('created_at', 'desc')->first();//mengambil tanggal terakhir barang inventaris terakhir dilkukan pengecekan....


		// $pengecekanInventoriTerakhir = \Inventori\App\CheckInventori\CheckInventoriModel::
		// 	where('inventori_id', $this->inventori->id)
		// 	->orderBy('created_at', 'desc')->first();

		if (empty($maintenanceInventoriTerakhir)) {
			return $this->inventori->created_at->diffInDays();
		}

		return $maintenanceInventoriTerakhir->created_at->diffInDays();		
	}

}
