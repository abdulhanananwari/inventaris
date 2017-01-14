app
        .controller('InventoriShowController', function (InventoriModel,
                MaintenanceInventoriModel,
                CheckInventoriModel,
                LocationModel,
                ConfigModel,
                $state) {
            var vm = this;

            vm.storagelocation = {}

            vm.inventori = {
                tanggal_pembelian: moment().format("YYYY-MM-DD"),
                rencana_tanggal_peremajaan: moment().format("YYYY-MM-DD"),
                pic: []
            }

            $("#rencana_tanggal_peremajaan").datepicker({dateFormat: "yy-mm-dd"});
            $("#tanggal_pembelian").datepicker({dateFormat: "yy-mm-dd"});

            vm.printData = {
                template: 'app/inventori/print/thermal.html'
            }
            vm.print = function() {
                
                var w = window.open();
                    w.document.write($('#printarea').html());

                window.setTimeout(function() {

                    
                    w.print();
                    w.close();
                }, 2000);
            }
            
            vm.store = function (inventori) {
                if (!inventori.id) {

                    InventoriModel.store(inventori)
                            .success(function (data) {
                                alert('Data Berhasil Di Simpan')
                                $state.go('inventoriShow', {id: data.data.id})

                            })
                } else {
                    InventoriModel.update(inventori.id, inventori)
                            .success(function (data) {
                                vm.inventori = data.data
                                alert('Data Berhasil Di Update')
                            })
                }
            }
            vm.reset = function () {
                $state.go('inventoriShow', {id: ''}, {reload: true})
            }

            vm.addPic = function (pic) {

                if (_.isEmpty(pic.email)) {

                    alert('Email Diperlukan')
                    return;
                }

                vm.inventori.pic.push(_.pick(pic, ['user_id', 'name', 'email']));
            }


            vm.remove = function (pic) {
                _.remove(vm.inventori.pic, pic);
            }


            vm.filter = {
                inventori_id: $state.params.id
            }

            vm.getmaintenance = function (page) {
                if (page) {
                    vm.filter.page = page;
                }

                MaintenanceInventoriModel.index(vm.filter)
                        .success(function (data) {
                            vm.maintenance_inventories = data.data;
                            vm.meta = data.meta;
                        })

            }


            vm.getcheck = function (page) {
                if (page) {
                    vm.filter.page = page;
                }

                CheckInventoriModel.index(vm.filter)
                        .success(function (data) {
                            vm.check_inventories = data.data;
                            vm.metaCheckInventori = data.meta;
                        })
            }

            if ($state.params.id) {

                InventoriModel.get($state.params.id)
                .success(function (data) {
                    vm.inventori = data.data;
                })

                vm.getcheck()

                vm.getmaintenance()
            }

            ConfigModel.get('kondisi')
                    .success(function (data) {
                        vm.kondisi = data.data
                    })

            LocationModel.index()
                    .success(function (data) {
                        vm.locations = data.data;
                    })

            vm.fileManager = {
                displayedInput: JSON.stringify({
                    name: {label: "Keterangan", show: true},
                    file: {label: "Bukti Photo", show: true},
                    reset: {show: true}
                }),
                additionalData: JSON.stringify({
                    path: 'inventori',
                    subpath: $state.params.id,
                    fileable_type: 'Inventori',
                    fileable_id: $state.params.id
                })
            }

        });