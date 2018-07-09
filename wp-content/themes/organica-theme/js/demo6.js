/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2016, Codrops
 * http://www.codrops.com
 */
$(function(){
	   
        

document.documentElement.className = 'js';
'use strict';

	var mainContainer = document.querySelector('body'),
		openCtrl = document.getElementById('btn-search'),
		closeCtrl = document.getElementById('btn-search-close'),
		searchContainer = document.querySelector('.search-win'),
		inputSearch = searchContainer.querySelector('.search-form-input');

	function init() {
		initEvents();	
	}

	function initEvents() {
		openCtrl.addEventListener('click', openSearch);
		closeCtrl.addEventListener('click', closeSearch);
		document.addEventListener('keyup', function(ev) {
			// escape key.
			if( ev.keyCode == 27 ) {
				closeSearch();
			}
		});
	}

	function openSearch() {

		
			document.querySelector('body').classList.add('no-scroll');
		
		
		if (document.querySelector('.wrap-page') != null) {
			document.querySelector('.wrap-page').classList.add('no-scroll');
		}

		mainContainer.classList.add('main-wrap--overlay');
		closeCtrl.classList.remove('btn--hidden');
		searchContainer.classList.add('search--open');
		$('.search-win-wrap').css('visibility', 'visible');
		setTimeout(function() {
			inputSearch.focus();
		}, 500);
	}

	function closeSearch() {
		
			document.querySelector('body').classList.remove('no-scroll');
		

		if (document.querySelector('.wrap-page') != null) {
			document.querySelector('.wrap-page').classList.remove('no-scroll');
		}
		


		mainContainer.classList.remove('main-wrap--overlay');
		closeCtrl.classList.add('btn--hidden');
		searchContainer.classList.remove('search--open');
		setTimeout(function() {
			$('.search-win-wrap').css('visibility', 'hidden');
		}, 700);
		inputSearch.blur();
		inputSearch.value = '';
	}

	init();

})