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
                        .success(function (data) {
                            vm.maintenance = data.data;
                        })
            }

            vm.store = function (maintenance) {
                if (!maintenance.id) {

                    vm.maintenance = {}

                    MaintenanceInventoriModel.store(maintenance)
                            .success(function (data) {
                                alert('Data Berhasil Disimpan. Silahkan upload foto sekarang.')
                                $state.go('maintenanceCreate', {id: data.data.id})
                            })
                } else {
                    MaintenanceInventoriModel.update(maintenance.id, maintenance)
                            .success(function (data) {
                                vm.maintenance = data.data;
                            })
                }
            }

            vm.fileManager = {
                displayedInput: JSON.stringify({
                    name: {label: "Keterangan", show: true},
                    file: {label: "Bukti Photo", show: true},
                    reset: {show: true}
                }),
                additionalData: JSON.stringify({
                    path: 'maintenance-inventori',
                    subpath: $state.params.id,
                    fileable_type: 'MaintenanceInventori',
                    fileable_id: $state.params.id
                })
            }
        });