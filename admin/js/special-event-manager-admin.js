jQuery(document).ready(function($) {
	'use strict';

	/**
	 * All of the code for your admin-specific JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

// assign a Pikaday object to the start date field
	var startPicker = new Pikaday(
	{
			numberOfMonths: 2,
			field: document.getElementById('startPicker'),
			firstDay: 1,
			format: 'ddd, MMM Do, YYYY',
			minDate: new Date('2000-01-01'),
			maxDate: new Date('2020-12-31'),
			yearRange: [2000, 2020]
	});

// assign a Pikaday object to the end date field
	var endPicker = new Pikaday(
	{
			numberOfMonths: 2,
			field: document.getElementById('endPicker'),
			firstDay: 1,
			format: 'ddd, MMM Do, YYYY',
			minDate: new Date('2000-01-01'),
			maxDate: new Date('2020-12-31'),
			yearRange: [2000, 2020]
	});



});
