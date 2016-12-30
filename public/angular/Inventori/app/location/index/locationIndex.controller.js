
app
	.controller('LocationIndexController', function(
		LocationModel) {
		var vm = this

		vm.new = function() {

			vm.storagelocation = {}

			$('#edit-data').modal('show')

		}

		vm.store = function(storagelocation) {
			
				/*console.log(storagelocation);*/

			if (!storagelocation.id) {
					
					LocationModel.store(storagelocation)
					.success(function(data) {
						vm.get()

					})

			} else {

				LocationModel.update(storagelocation.id, storagelocation)
				.success(function(data) {
					vm.get()
					vm.storagelocation = data.data
					alert('Data Berhasil Di update')
				})
				
			}

		}

		vm.edit = function(storagelocation) {
			vm.storagelocation = storagelocation
			$('#edit-data').modal('show')
		}

		vm.filter = {};

		vm.get = function() {

			LocationModel.index(vm.filter)
			.success(function(data) {
				vm.locations = data.data;
			})
		} 

		vm.get();
	});