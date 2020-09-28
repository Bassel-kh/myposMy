// image preview
// $(".image").change(function () {
//
//     if (this.files && this.files[0]) {
//         var reader = new FileReader();
//
//         reader.onload = function (e) {
//             $('.image-preview').attr('src', e.target.result);
//         }
//
//         reader.readAsDataURL(this.files[0]);
//     }
//
// });

// image preview
$('.image_class').change(function (){

    if(this.files && this.files[0]){
        var reader = new FileReader();

        reader.onload = function (e){
            $('.img_preview_class').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]); // convert to base64 string
    }
});
