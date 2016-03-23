(function() {
	tinymce.PluginManager.add('my_mce_button', function( editor, url ) {
		editor.addButton( 'my_mce_button', {
			text: 'Add Elements',
			icon: false,
			type: 'menubutton',
			menu: [
				{
					text: 'Link Button',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Link Button',
							body: [
								{
									type: 	'textbox',
									name: 	'buttonText',
									label: 	'Button Text',
									value: 	'Click Me!'
								},
								
								{
									type: 	'textbox',
									name: 	'buttonLink',
									label: 	'Link Address',
									value: 	'http://'
								},
								
								{
									type: 	'listbox',
									name: 	'style',
									label: 	'Styles',
									'values': [
										{text: 'Default', 		value: 'btn-default'},
										{text: 'Primary', 		value: 'btn-primary'},
										{text: 'Success', 		value: 'btn-success'},
										{text: 'Info', 			value: 'btn-info'},
										{text: 'Warning', 		value: 'btn-warning'},
										{text: 'Danger', 		value: 'btn-danger'}
									]
								},
								
								{
									type: 'listbox',
									name: 'size',
									label: 'Size',
									'values': [
										{text: 'Large', 		value: 'btn-lg'},
										{text: 'Default', 		value: ''},
										{text: 'Small', 		value: 'btn-sm'},
										{text: 'Extra Small', 	value: 'btn-xs'}
									]
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '<a href="' + e.data.buttonLink + '" class="btn ' + e.data.style + ' ' + e.data.size + '" role="button">' + e.data.buttonText + '</a>');
							}
						});
					}
				},
				
				
				{
					text: 'Download Link',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Download Link',
							body: [
								{
									type: 	'textbox',
									name: 	'buttonText',
									label: 	'Button Text',
									value: 	'Click Me!'
								},
								
								{
									type: 	'textbox',
									name: 	'buttonLink',
									label: 	'Link Address',
									value: 	'http://'
								},
								
								{
									type: 	'listbox',
									name: 	'style',
									label: 	'Styles',
									'values': [
										{text: 'Default', 		value: 'btn-default'},
										{text: 'Primary', 		value: 'btn-primary'},
										{text: 'Success', 		value: 'btn-success'},
										{text: 'Info', 			value: 'btn-info'},
										{text: 'Warning', 		value: 'btn-warning'},
										{text: 'Danger', 		value: 'btn-danger'}
									]
								},
								
								{
									type: 'listbox',
									name: 'size',
									label: 'Size',
									'values': [
										{text: 'Large', 		value: 'btn-lg'},
										{text: 'Default', 		value: ''},
										{text: 'Small', 		value: 'btn-sm'},
										{text: 'Extra Small', 	value: 'btn-xs'}
									]
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( '<a href="' + e.data.buttonLink + '" class="btn download-link ' + e.data.style + ' ' + e.data.size + '" role="button"><i class="fa fa-cloud-download"></i> ' + e.data.buttonText + '</a>');
							}
						});
					}
				},
				
				
				{
					text: 'Alerts',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Alert Bar',
							body: [
								{
									type: 	'textbox',
									name: 	'headingText',
									label: 	'Heading Text',
									value: 	'Heads up!'
								},
								{
									type: 	'textbox',
									name: 	'infoText',
									label: 	'Info Text',
									value: 	'This alert needs your attention, but it\'s not super important.'
								},
								{
									type: 	'listbox',
									name: 	'style',
									label: 	'Styles',
									'values': [
										{text: 'Default', 		value: ''},
										{text: 'Success', 		value: 'alert-success'},
										{text: 'Info', 			value: 'alert-info'},
										{text: 'Warning', 		value: 'alert-warning'},
										{text: 'Danger', 		value: 'alert-danger'}
									]
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( 
								'<div class="alert ' + e.data.style + ' ' + e.data.dismissible + '" role="alert"> <strong>' + e.data.headingText + '</strong> ' + e.data.infoText + '</div>');
							}
						});
					}
				},
				
				{
					text: 'Progress bar',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Progress Bar',
							body: [
								{
									type: 	'textbox',
									name: 	'percent',
									label: 	'Percentage',
									value: 	'100'
								},

								{
									type: 	'listbox',
									name: 	'style',
									label: 	'Styles',
									'values': [
										{text: 'Default', 		value: ''},
										{text: 'Success', 		value: 'progress-bar-success'},
										{text: 'Info', 			value: 'progress-bar-info'},
										{text: 'Warning', 		value: 'progress-bar-warning'},
										{text: 'Danger', 		value: 'progress-bar-danger'}
									]
								},
								
								{
									type: 	'listbox',
									name: 	'striped',
									label: 	'Striped?',
									'values': [
										{text: 'no', 		value: ''},
										{text: 'Yes', 		value: 'progress-bar-striped'}
									]
								},
								
								{
									type: 	'listbox',
									name: 	'animated',
									label: 	'Animated?',
									'values': [
										{text: 'no', 		value: ''},
										{text: 'Yes', 		value: 'active'}
									]
								}
							],
							onsubmit: function( e ) {
								editor.insertContent( 
								'<div class="progress"><div class="progress-bar ' + e.data.style + ' ' + e.data.striped + ' ' + e.data.animated + '" role="progressbar" aria-valuenow="' + e.data.percent + '%" aria-valuemin="0" aria-valuemax="100" style="width: ' + e.data.percent + '%"><span class="sr-only">' + e.data.percent + '% Complete</span></div></div>');
							}
						});
					}
				},
				
				{
					text: 'Panel',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Panel',
							body: [
								{
									type: 	'textbox',
									name: 	'panelHeading',
									label: 	'Heading',
									value: 	'Panel Title Here'
								},
								
								{
									type: 	'textbox',
									name: 	'panelContent',
									label: 	'Panel Content',
									value: 	'Panel Content Here'
								},

								{
									type: 	'listbox',
									name: 	'style',
									label: 	'Styles',
									'values': [
										{text: 'Default', 		value: 'panel-default'},
										{text: 'Primary', 		value: 'panel-primary'},
										{text: 'Success', 		value: 'panel-success'},
										{text: 'Info', 			value: 'panel-info'},
										{text: 'Warning', 		value: 'panel-warning'},
										{text: 'Danger', 		value: 'panel-danger'}
									]
								}
								
							],
							onsubmit: function( e ) {
								editor.insertContent( 
								'<div class="panel ' + e.data.style + '"><div class="panel-heading"><h3 class="panel-title">' + e.data.panelHeading + '</h3></div><div class="panel-body">' + e.data.panelContent + '</div></div>');
							}
						});
					}	
				},
					
				{
					text: 'Well',
					onclick: function() {
						editor.windowManager.open( {
							title: 'Insert Well',
							body: [
								
								{
									type: 	'textbox',
									name: 	'wellContent',
									label: 	'Well Content',
									value: 	'Well Content Here'
								},

								{
									type: 'listbox',
									name: 'size',
									label: 'Size',
									'values': [
										{text: 'Large', 		value: 'well-lg'},
										{text: 'Default', 		value: ''},
										{text: 'Small', 		value: 'well-sm'}
									]
								}
								
							],
							onsubmit: function( e ) {
								editor.insertContent( 
								'<div class="well ' + e.data.size + '">' + e.data.wellContent + '</div>');
							}
						});
					}
				}/*,
				
				{
					text: 'Item 3',
					menu: [
						{
							text: 'Sub Item 1',
							onclick: function() {
								editor.insertContent('WPExplorer.com is awesome!');
							}
						},
						{
							text: 'Sub Item 2',
							onclick: function() {
								editor.insertContent('WPExplorer.com is awesome!');
							}
						}
					]
				}*/
				
			]
		});
	});
})();

