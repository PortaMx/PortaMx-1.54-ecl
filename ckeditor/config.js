/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
		{ name: 'styles' },
		{ name: 'colors' },
	];

	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Styles';

	// Se the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Make dialogs simpler.
	config.removeDialogTabs = 'link:advanced';

	// the smileys
	config.smiley_descriptions = [':))', ':)', ';)', ':D', ';D', '>:(', ':(', ':o', '8)', '???', '::)', ':P', ':-[', ':-X', ':-\\', ':-*', ':\'(', '>:D','^-^', 'O0'];
	config.smiley_images = ['laugh.gif', 'smiley.gif', 'wink.gif', 'cheesy.gif', 'grin.gif', 'angry.gif', 'sad.gif', 'shocked.gif', 'cool.gif', 'huh.gif', 'rolleyes.gif', 'tongue.gif', 'embarrassed.gif', 'lipsrsealed.gif', 'undecided.gif', 'kiss.gif', 'cry.gif', 'evil.gif', 'azn.gif', 'afro.gif'];
	config.smiley_path = CKEDITOR.basePath + '../Smileys/PortaMx/';
	config.smiley_columns = 10;

	// special setting .. don't change!
	config.enableTabKeyTools = false;
	config.fillEmptyBlocks = false;
	config.forceEnterMode = true;
	config.autoParagraph = false;
	config.enterMode = CKEDITOR.ENTER_BR;
	config.entities = false;
	config.allowedContent = true;
	config.extraAllowedContent = '*{*}';
};
