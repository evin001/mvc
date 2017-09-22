$(document).ready(function () {
	$('#preview').on('click', function () {
		$('#previewName').text( $('#name').val() );
		$('#previewEmail').text( $('#email').val() );
		$('#previewText').text( $('#text').val() );

		var complete = $('#complete');

		if (complete.length) {
			var previewStatusClass = (complete.prop('checked')) ?
				'glyphicon glyphicon-ok complete_yes' : 'glyphicon glyphicon-remove complete_no';

			$('#previewStatus').attr('class', previewStatusClass);
		}

		$('#previewModal').modal('show');
	});

	$('#image').on('change', function () {
		readURL(this);
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#previewImage').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
});