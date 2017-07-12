(function(){
	$(document).ready(function(){
		$('a.update-profile').click(function(event){
			event.preventDefault()
			$('.form-view').hide();
			$('.form-edit').show();
			$('.update-btn').show();
			$('.cancel-btn').show();
			$('.changepass-btn').show();
			$('.update-profile').hide();
			$('td.form-view').remove();
		});
		
		$('#edit-propic-btn').click(function(event){
			console.log('click');
			event.preventDefault();
			$('#UsersImage').click();
		});

		$('#UsersImage').change(function(){
			var fileName = $('#UsersImage').val();
			console.log(fileName);
			if(fileName !== null) {	
				$('button.btn.btn-success.update-btn-pro').show();	
				readURL(this);
			}
		});

		 function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.pic-container img').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

	});
})();