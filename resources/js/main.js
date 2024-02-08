$(document).ready(function(){
    // Modal
    $('.openModalBtn').on('click', function(){
        $(this).removeClass('hidden');
        const modal = $(this).data('modal-show');
        $(`#${modal}`).show();
    })
    $('.closeModalBtn').on('click', function(){
        const modal = $(this).data('modal-hide');
        $(`#${modal}`).hide();
        $(`#${modal} .formErrors`).hide();
        $(`#${modal} form input`).val('');
        $(`#${modal} form #supplier-select`).val('').trigger('change');
    })

    // datatable actions dropdown
    $(document).mouseup(function(e) {
        var container = $(".actionsDropdownContent");
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            $(".actionsDropdownContent").hide();
        }
    });
});