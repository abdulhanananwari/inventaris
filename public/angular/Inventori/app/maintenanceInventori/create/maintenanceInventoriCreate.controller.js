app
	.controller('MaintenanceInventoriCreateController', function (MaintenanceInventoriModel,$state) {
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
					$state.go('inventoriIndex', {id: data.id})
				})
			} else {
				MaintenanceInventoriModel.update(maintenance.id, maintenance)
				.success(function(data) {
					vm.maintenance = data
				})
			}
		}
		vm.reset = function() {
			$state.go('maintenanceCreate', {id: ''}, {reload: true})
		}
	});