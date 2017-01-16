app
    .controller('InventoriScanController', function (
        InventoriModel, $state) {

            var vm = this;

            InventoriModel.index({uuid: $state.params.uuid })
            .success(function(data) {

                if (data.data.length >= 1) {

                    $state.go('inventoriShow', {id: data.data[0].id})

                } else {

                    alert('Inventori tidak ditemukan')
                    $state.go('inventoriIndex')
                    
                }

            })
        })
            

           