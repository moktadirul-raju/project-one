(function($){
    "use strict";
    let base_url = $('meta[name="base-url"]').attr('base_url');

   $(document).on('click','.view-task-list',function () {
       let to_do_id = $(this).attr('data-id');
       axios.get(base_url+'/to-do-list-tasks/'+to_do_id).then((response) => {
          if (response.data.length > 0) {
              let task_list = '';
              jQuery.each(response.data, function(index, item) {
                 task_list += `<tr>
                    <td>${index + 1}</td>
                    <td>${item.task_name}</td>
                    <td>${item.task_description}</td>
                </tr>`;
            });
              $('#task-list-table').append(task_list);
          } else {
              let alert_message = `<p class="alert alert-danger alert-padding mt-2">No Task Found!</p>`;
              $('#not-task-alert').html(alert_message);
          }

       });
        $('#task-list').modal('show');
    });

   $(document).on('click','.close-task-list',function () {
        $('#task-list').modal('hide');
    });
})(jQuery);
