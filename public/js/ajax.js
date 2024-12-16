

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
        text: 'هل تريد الاستمرار؟',
        icon: 'error',
        confirmButtonText: "نعم",
        cancelButtonText: "لا",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {

        $.ajax({
            url: href,
            type: "DELETE",
            data: { _token: token },
            dataType: "json",
            success: function (response) {
                if (response.redirect) {
                    swal.fire({
                        title: response.message,
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false, // Remove the "OK" button
                        allowOutsideClick: false, // Prevent the dialog from closing by clicking outside
                        allowEscapeKey: false,// Prevent the dialog from closing by pressing the escape key
                        position: 'top-start',

                    });
                    return window.location = response.redirect

                }

            },

        })

    })
})


//multi delete
$(document).on('click', '#MulitDelete', function (e) {
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
        text: 'هل تريد الاستمرار؟',
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
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false, // Remove the "OK" button
                            allowOutsideClick: false, // Prevent the dialog from closing by clicking outside
                            allowEscapeKey: false,// Prevent the dialog from closing by pressing the escape key
                            position: 'top-start',

                        });
                        return window.location = response.redirect

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
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: form.attr('action'),
        type: "POST",
        data: new FormData($(this)[0]), "_token": "{{ csrf_token() }}",
        dataType: 'JSON',
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR, response) {
            if (data.redirect) {
                swal.fire({
                    title: data.message,
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false, // Remove the "OK" button
                    allowOutsideClick: false, // Prevent the dialog from closing by clicking outside
                    allowEscapeKey: false,// Prevent the dialog from closing by pressing the escape key
                    position: 'top-start',

                });
                return window.location = data.redirect

            }
            $('.modal').modal("hide");
            //    swal.fire(data.title, data.message, data.status);
            form.trigger("reset");
            location.reload(true)
        },

        error: function (err, data, response, jqXhr, xhr) {
            var errors = err.responseJSON.errors;
            $.each(errors, function (key, value) {
                console.log(key)
                console.log($('#' + key + '-error').text(value[0])
                )
            });
        },

        complete: function () { form.parent().removeClass('load'); }
    });
});