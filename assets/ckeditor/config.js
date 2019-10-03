/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

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
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
	config.extraPlugins = 'justify';
    //config.baseUrl = "http://www.yourdomain.com/assets/images/";
	//config.extraPlugins = '';
};

/*CKEDITOR.on('dialogDefinition', function (ev) {

    var dialogName = ev.data.name,
        dialogDefinition = ev.data.definition;

    if (dialogName == 'image') {
        var onOk = dialogDefinition.onOk;

        dialogDefinition.onOk = function (e) {
            var width = this.getContentElement('info', 'txtWidth');
            width.setValue('300');//Set Default Width

            var height = this.getContentElement('info', 'txtHeight');
            height.setValue('300');////Set Default height
            this.setStyle('display','block');
            this.setStyle('margin-left','auto');
            this.setStyle('margin-right','auto');
            onOk && onOk.apply(this, e);
        };


    }
});*/

/*CKEDITOR.on('instanceReady', function (ev) {
    var editor = ev.editor,
        dataProcessor = editor.dataProcessor,
        htmlFilter = dataProcessor && dataProcessor.htmlFilter;

    htmlFilter.addRules( {
        elements : {
            $ : function( element ) {
                // Output dimensions of images as width and height attributes on src
                if ( element.name == 'img' ) {
                    var style = element.attributes.style;
                    if (style) {
                        // Get the width from the style.
                        var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec( style ),
                            width = match && match[1];

                        // Get the height from the style.
                        match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec( style );
                        var height = match && match[1];

                        var imgsrc = element.attributes.src + "?width=" + width + "&height=" + height;

                        element.attributes.src = imgsrc;
                        element.attributes['data-cke-saved-src'] = imgsrc;
                    }
                }
            }
        }
    });
});
*/