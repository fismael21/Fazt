$(document).ready(function () {
  //console.log("jQuery is working.");

  let edit = false;

  $("#task-result").hide();
  fetchTasks();

  $("#search").keyup(function (e) {
    if ($("#search").val()) {
      let search = $("#search").val();
      console.log(search);

      $.ajax({
        url: "php/task_search.php",
        type: "POST",
        data: { search: search },
        success: function (response) {
          let tasks = JSON.parse(response);

          let template = "";

          tasks.forEach((task) => {
            template += `<li>${task.name}</li>`;
          });

          $("#container").html(template);
          $("#task-result").show();
        },
      });
    }
  });

  $("#task-form").submit(function (e) {
    const postData = {
      name: $("#name").val(),
      description: $("#description").val(),
      id: $("#id-task").val(),
    };

    let url = edit === false ? "php/task_add.php" : "php/task_edit.php";

    console.log(url);

    $.post(url, postData, function (response) {
      console.log(response);
      fetchTasks();
      $("#task-form").trigger("reset");
    });

    e.preventDefault();
  });

  function fetchTasks() {
    $.ajax({
      url: "php/task_list.php",
      type: "GET",
      success: function (response) {
        let tasks = JSON.parse(response);
        template = "";

        tasks.forEach((task) => {
          template += `<tr task-id="${task.id}">
            <td>${task.id}</td>
            <td>
              <a href="#" class="task-item">${task.name}</a>
            </td>
            <td>${task.description}</td>
            <th>
              <button class="task-delete btn btn-danger">
              Delete
              </button>
            </th>
          </tr>`;
        });

        $("#tasks").html(template);
      },
    });
  }

  $(document).on("click", ".task-delete", function () {
    if (confirm("Are your sure you want to delete this task?")) {
      let element = $(this)[0].parentElement.parentElement;
      let id = $(element).attr("task-id");
      console.log(id);

      $.post("php/task_delete.php", { id }, function (response) {
        fetchTasks();
      });
    }
  });

  $(document).on("click", ".task-item", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("task-id");

    $.post("php/task_single.php", { id }, function (response) {
      console.log(response);
      const task = JSON.parse(response);
      $("#name").val(task.name);
      $("#description").val(task.description);
      $("#id-task").val(task.id);

      edit = true;
    });
  });
});
