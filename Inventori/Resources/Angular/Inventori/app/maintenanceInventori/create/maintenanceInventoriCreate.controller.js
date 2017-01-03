app
	.controller('MaintenanceInventoriCreateController', function (MaintenanceInventoriModel,
		InventoriModel,
		$state) {
		var vm = this;

		vm.maintenance = {
			inventori_id: $state.params.inventoriId
		}

		if ($state.params.id) {

			MaintenanceInventoriModel.get($state.params.id)
			.success(function(data) {
				vm.maintenance = data.data;
			})
		} 
		vm.store = function(maintenance) {
			if (!maintenance.id) {

				vm.maintenance = {}

				MaintenanceInventoriModel.store(maintenance)
				.success(function(data) {
					alert('Data Berhasil Disimpan')
					$state.go('inventoriShow', {id: data.data.inventori_id})
				})
			} else {
				MaintenanceInventoriModel.update(maintenance.id, maintenance)
				.success(function(data) {
					vm.maintenance = data.data
				})
			}
		}
		vm.reset = function() {
			$state.go('maintenanceCreate', {id: ''}, {reload: true})
		}
	});