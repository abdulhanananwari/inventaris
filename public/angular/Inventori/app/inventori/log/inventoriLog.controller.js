app
	.controller('InventoriLogController', function(
		LogModel,
		$state) {
		var vm = this;

		vm.filter = {
			loggable_type:'Inventori',
			loggable_id: $state.params.id
		};

			LogModel.index(vm.filter)
			.success(function(data) {
				
				vm.logs = data.data;
				
			});

});
		