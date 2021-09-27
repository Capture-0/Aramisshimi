/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {

    // config.toolbarGroups = [
    //     { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
    //     { name: 'clipboard', groups: ['clipboard', 'undo'] },
    //     '/',
    //     { name: 'insert', groups: ['insert'] },
    //     { name: 'links', groups: ['links'] },
    //     { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph'] },
    //     '/',
	// 	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
	// 	{ name: 'forms', groups: [ 'forms' ] },
	// 	{ name: 'tools', groups: [ 'tools' ] },
	// 	{ name: 'document', groups: [ 'document', 'mode', 'doctools' ] },
	// 	{ name: 'styles', groups: [ 'styles' ] },
	// 	{ name: 'colors', groups: [ 'colors' ] },
	// 	{ name: 'others', groups: [ 'others' ] },
	// 	{ name: 'about', groups: [ 'about' ] }
    // ];

    // config.removeButtons = 'Italic,Strike,Subscript,NumberedList,Anchor,Unlink';

	config.removeDialogTabs = 'image:advanced;link:advanced';

    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';
};