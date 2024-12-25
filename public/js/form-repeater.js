$(document).ready(function () {
    $('#add-form-btn').click(function () {
     
       
        var newForm = $(this).parents('.vehicle-form:first').clone();
        var $originalSelect = $(newForm).find('.selectpicker');
        $originalSelect.next().addClass('d-none')
       
        $originalSelect.selectpicker('render');
    
        var lastNumberInput = $('.vehicle-form').last().find('.number');
        var lastNumberValue = 0;

        if (lastNumberInput.length) {
            var numericString = lastNumberInput.val().replace(/\D/g, '');
            var numericValue = Number(numericString);
            if (!isNaN(numericValue)) {
                lastNumberValue = numericValue;
            }
        }

        newForm.find('input').each(function () {
            var input = $(this);

            if (input.hasClass('number')) {
                input.val(lastNumberInput.val().replace(/\d/g, '') + (lastNumberValue + 1));
            }
           
            if (!(input.hasClass('drgpicker') || input.hasClass('number') || input.hasClass('task_start_time') || input.hasClass('date'))) {
                input.val('');
            }
        });

        newForm.find('.delete-form-btn').click(function () {
            newForm.remove();
            checkDeleteButtonVisibility();
        });

        $('#vehicle-forms-container').append(newForm);

        newForm.find('.btn-primary').click(function () {
            $('#add-form-btn').click();
        });

        checkDeleteButtonVisibility();
    });

    function checkDeleteButtonVisibility() {
        var formCount = $('.vehicle-form').length;
        $('.delete-form-btn').each(function () {
            if (formCount <= 1) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    }

    checkDeleteButtonVisibility();
});