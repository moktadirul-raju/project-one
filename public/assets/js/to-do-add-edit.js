(function($){
    "use strict";

     $(document).on('click', '#add-task', function() {
        let task_table = $('#task-table');
        task_table.removeClass('d-none');
        $('#add-task-alert').addClass('d-none');

        let task_form = `<tr>
            <td style="width: 45%">
                <input type="text" name="task_name[]" class="form-control" placeholder="Task Name" required>
            </td>
            <td style="width: 45%">
                <textarea name="task_description[]" class="form-control" rows="1"  placeholder="Task Description"></textarea>
            </td>
            <td style="width: 5%">
                <button type="button" class="btn btn-sm btn-danger text-right remove-task" >
                <i class="bi bi-trash"></i>
            </button>
            </td>
        </tr>`;
        task_table.find('tbody').append(task_form);
    });

    $(document).on('click', '.remove-task', function(){
        let event = this;
        $(event).parent().parent().remove();
    });



})(jQuery);
