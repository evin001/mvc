$(document).ready(function () {
	$('#preview').on('click', function () {
		$('#previewName').text( $('#name').val() );
		$('#previewEmail').text( $('#email').val() );
		$('#previewText').text( $('#text').val() );

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