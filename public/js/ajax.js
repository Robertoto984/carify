

$(document).on('click', '.checkbox', function () {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if ($(this).is(':checked')) {
            checkboxes[i].checked = true;
        } else {
            checkboxes[i].checked = false;
        }

    }
})


// delete elemnt
$(document).on('click', '#destroy', function (e) {
    e.preventDefault()
    var token = $("meta[name='csrf-token']").attr('content')
    var href = $(this).attr('href')

    swal.fire({
        title: 'انتباه!',
        text: 'هل تريد الحذف',
        icon: 'error',
        confirmButtonText: "نعم",
        cancelButtonText: "لا",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {
        if(result.isConfirmed){
            $.ajax({
                url: href,
                type: "DELETE",
                data: { _token: token },
                dataType: "json",
                success: function (response) {
                    if (response.redirect) {
                        swal.fire({
                            title: response.message,
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false, // Remove the "OK" button
                            allowOutsideClick: false, // Prevent the dialog from closing by clicking outside
                            allowEscapeKey: false,// Prevent the dialog from closing by pressing the escape key
                            position: 'top-start',
    
                        }).then(function() {
                            window.location = response.redirect;
                        });
    
                    }
    
                },
    
            })
        }
       

    })
})


//multi delete
$(document).on('click', '#bulkDeleteBtn', function (e) {
    e.preventDefault()
    var token = $("meta[name='csrf-token']").attr('content')
    var href = $(this).attr('href')
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var ids = []
    $("#check:checked").each(function () {
        ids.push($(this).val());
    });
    swal.fire({
        title: 'انتباه!',
        text: 'هل تريد الحذف؟',
        icon: 'error',
        confirmButtonText: "نعم",
        cancelButtonText: "لا",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {

        if (ids.length > 0 && result.value == true) {
            $.ajax({
                url: href,
                type: "DELETE",
                data: { ids: ids, _token: token },
                dataType: "json",
                success: function (response) {
                    if (response.redirect) {
                        swal.fire({
                            title: response.message,
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false, // Remove the "OK" button
                            allowOutsideClick: false, // Prevent the dialog from closing by clicking outside
                            allowEscapeKey: false,// Prevent the dialog from closing by pressing the escape key
                            position: 'top-start',

                        }).then(function() {
                            window.location = response.redirect;
                        });
                        

                    }

                },

            })
        }
    })
})

$(document).on('click', '#modal', function (e) {
    e.preventDefault()

    var href = $(this).attr('href')
    $.ajax({
        url: href,
        type: "GET",
        dataType: "json",
        success: function (response) {
            $('#load-form').html(' ')
            $('#load-form').append(response.html);

        },

    })
})


$('body').on('submit', 'form.submit-form', function (e) {
    e.preventDefault();

    let form = $(this);
    form.find('span.error').fadeOut(200);
    form.parent().addClass('load');

    // Add CSRF token in the request header
    var token = $("meta[name='csrf-token']").attr("content");

    $.ajax({
        url: form.attr('action'),
        type: "POST",
        data: new FormData($(this)[0]), // Send form data, including files
        processData: false,
        contentType: false,
        beforeSend: function(xhr) {
            // Set the CSRF token in the header
            xhr.setRequestHeader('X-CSRF-TOKEN', token);
        },
        dataType: 'JSON',
        success: function (data) {
            // Check for a redirect URL in the response
            if (data.redirect) {
                swal.fire({
                    title: data.message, 
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    position: 'top-start',
                }).then(function() {
                    // Perform the redirect
                    window.location = data.redirect; // Redirect to the provided URL
                });
            }
            // Hide modal and reset the form
            $('.modal').modal("hide");
            form.trigger("reset");
        },
        error: function (err) {
            var errors = err.responseJSON.errors;
            $.each(errors, function (key, value) {
                $('#' + key + '-error').text(value[0]);
            });
        },
        complete: function () {
            form.parent().removeClass('load');
        }
    });
});


$(document).on('submit','form.form-login',function(e){
    e.preventDefault()
    let form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: "POST",
        data: new FormData($(this)[0]), "_token": "{{ csrf_token() }}",
        dataType: 'JSON',
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR, response) {
            
            
           if(data.status == 200){
            window.location.href = '/dashboard'
           }
           if(data.status == 401){
            window.location.href = '/'
           }

        },

        error: function (err, data, response, jqXhr, xhr) {
            console.log(err)
            var errors = err.responseJSON.errors;
            $.each(errors, function (key, value) {
                console.log($('#' + key + '-error').text(value[0])
                )
            });
        },

    });
})

