jQuery( document ).ready(
	function() {

		jQuery('.color-field').wpColorPicker(
			{
				defaultColor: false,
				color: false,
				hide: true, // hide the color picker by default
				border: true, // draw a border around the collection of UI elements
				target: false, // a DOM element / jQuery selector that the element will be appended within. Only used when called on an input.
				width: 200, // the width of the collection of UI elements
				palettes: ['#57A83E','#EA2323','#000000','#353535','#585858','#EEEEEE','#FFFFFF'] // show a palette of basic colors beneath the square.
			}
		);

	}
);
