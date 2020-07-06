function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            $('#Myform + img').remove();
            $('#test').html('<img class="img-fluid img-thumbnail" src="'+e.target.result+'" width="150" height="150"/>');
        }
        reader.readAsDataURL(input.files[0]);
        }
        }
        $("#file").change(function () {
            filePreview(this);
        });