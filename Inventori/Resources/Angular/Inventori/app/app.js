 var app = angular 
 	.module('InventoriApp', ['ui.router',
 		'Solumax.ErrorInterceptor','Solumax.JwtManager','Solumax.TenantDatabaseConnection',
 		'Solumax.EntityFinder', 'Solumax.FileManager','Solumax.Logger'])

 	.factory('AppFactory', function() {

		var appFactory = {};

		appFactory.moduleId = '20035';

		return appFactory;
	})
	.config(['$compileProvider', function( $compileProvider )
		{   
	        $compileProvider.aHrefSanitizationWhitelist(/^\s*(https?|ftp|mailto|whatsapp|zxing|chrome-extension):/);
	        // Angular before v1.2 uses $compileProvider.urlSanitizationWhitelist(...)
	    }
	]);