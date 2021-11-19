/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';


    // config.extraPlugins = 'floatpanel';
    // config.extraPlugins = 'panelbutton';
    // config.extraPlugins = 'button';
    config.extraPlugins = 'floatpanel,panelbutton,button,colorbutton,youtube,preview,print, exportpdf';

    //config.extraPlugins = '';

	config.colorButton_colors = 'ff4040,37c8ae,ffd700,CCC,DDD,CCEAEE,66AB16';


    // config.extraPlugins = 'preview';
    // config.extraPlugins = 'print';



};

CKEDITOR.on('instanceReady', function(ev) {
	//catch ctrl+clicks on <a>'s in edit mode to open hrefs in new tab/window
	$('iframe').contents().click(function(e) {
		if(typeof e.target.href != 'undefined' && e.ctrlKey == true) {
			window.open(e.target.href, 'new' + e.screenX);
		}
	});
});
