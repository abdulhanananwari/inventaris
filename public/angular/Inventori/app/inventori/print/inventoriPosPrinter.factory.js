app
	.factory('InventoriPosPrinterFactory', function(
		$q,
		InventoriModel, JwtValidator) {

		var inventoriPosPrinterFactory = {};

		var rawTags = {
			line: '$intro$',
			big: '$big$',
			big_double: '$bighw$',	
			big_double_underline: '$bighwu$',	
			small: '$small$',	
			small_underline: '$smallu$',
			normal: '',
		}

		var tags = function(type, text) {
			if (_.isUndefined(text)) {
				text = '';
			};
			return rawTags[type] + text;
		}

		var processor = function(inventori) {

			var string = '';
			
			
			// ID
			string += tags('small', ' (' + inventori.id + ')')  + tags('line') + tags('line');

		
			// Total
			
			// Thank you
			// string += tags('big', 'Terimakasih') + tags('line');
			// string += tags('small', 'Jika Anda mempunyai kritik / saran silahkan kirimkan via http://hondagelora.com/kritik-saran') + tags('line');

			string += tags('line');

			return string;

		}

		inventoriPosPrinterFactory.process = function(inventori) {

			return processor(inventori)
		}

		return inventoriPosPrinterFactory;
	});