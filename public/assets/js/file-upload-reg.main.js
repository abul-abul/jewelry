$(document).ready(function(){
    $('input[type=file]').on('change', submit);
    $('input[type=file]').on('change', function(){
    });

    $('#crop').click(function(){
        cropImage();
    })
})

function submit(event)
{
    //var id  = $(this).data('id');
    files = event.target.files; 
    event.stopPropagation(); 
    event.preventDefault(); 
    var data = new FormData();
    var token = $('#token').val();
    data.append('file', files[0]);
    data.append('_token', token);
  	$.ajax({
        url: '/user/file-upload-reg/',
        type: 'POST',
        data: data,
        dataType: 'json',
        processData: false, 
        contentType: false, 
        success: function(data)
        {
            $('#imag_slider').show();
            $('#imag_slider').children().attr('src','/uploads/'+data.name);
            $('#image').val(data.name);
            document.getElementById('crop_container').innerHTML = '';
            document.getElementById('crop_container').innerHTML = '<img id="image" src="/uploads/'+data.name+'">';
            $("#myModalCrop").modal('show');
            setTimeout(function () {
                makeCropping();
            }, 200);
        }
    })
}