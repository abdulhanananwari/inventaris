app
        .controller('InventoriIndexController', function (
                InventoriModel,
                ConfigModel, JwtValidator, LinkFactory,
                $state,
                $stateParams) {
            var vm = this;

            vm.filter = {};
            
                console.log(vm.filter)

            vm.get = function (page) {

                if (page) {
                    vm.filter.page = page;
                }

                InventoriModel.index(vm.filter)
                        .success(function (data) {

                            vm.inventories = _.map(data.data, function (data) {
                                data.name_pic = _.map(data.pic, 'name').join(',')
                                return data
                            });

                            vm.meta = data.meta;

                            if (vm.meta.pagination && vm.meta.pagination.total_pages > 0 && vm.meta.pagination.current_page > vm.meta.pagination.total_pages) {
                                vm.get(1)
                            }

                            assignKondisiToInventori()
                        })
            }
            vm.get();

            vm.download = function() {

                vm.filter.jwt = JwtValidator.encodedJwt
                window.open(LinkFactory.inventori.inventori.report + '?' + $.param(vm.filter))
            }


            function assignKondisiToInventori() {


                _.each(vm.inventories, function (inventori) {
                    inventori.object_kondisi = _.first(_.filter(vm.kondisi, function (kondisi) {
                        return kondisi.code == inventori.kondisi
                    }))
                })

            }
            ConfigModel.get('kondisi')
                    .success(function (data) {
                        vm.kondisi = data.data
                    })

        });