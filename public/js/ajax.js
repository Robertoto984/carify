

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
        title: 'Wrning!',
        text: 'Do you want to continue',
        icon: 'error',
        confirmButtonText: "yes",
        cancelButtonText: "No",
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
                    $('#table-container').html(`<div class="alert alert-success" id="success">${response.success}</div>
                        `)
                        location.reload();

                },

            })
        }
    })
})

