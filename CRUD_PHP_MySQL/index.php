<?php include("db.php") ?>
<?php include("includes/header.php")?>
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a href="index.php" class="navbar-brand">PHP MySQL CRUD</a>
  </div>
</nav>

<div class="container p-4">

  <div class="row">

    <div class="col-md-4">

      <?php 
        if(isset($_SESSION['message'])){ ?>
          <div class="alert alert-<?= $_SESSION['message_type'];?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
          </div>
        <?php session_unset(); }
      ?>

      <div class="card card-body">
        
        <form action="insert_task.php" method="POST">
    
          <div class="form-group m-2">

          <input type="text" name="title" class="form-control" placeholder="Task Title" autofocus>

          </div>

          <div class="form-group m-2">

            <textarea name="description" rows="2" class="form-control" placeholder="Task description"></textarea>

          </div>
          
          <div class="form-group m-2">
            <input type="submit" class="btn btn-success btn-block center" name="insert_task" value="Insert Task">
          </div>

        </form>

      </div>

    </div>

    <div class="col-md-8">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              Title
            </th>
            <th>
              Description
            </th>
            <th>
              Actions
            </th>
          </tr>
          <tbody>
            <?php 
              $query = "SELECT * FROM task";
              $result_tasks = mysqli_query($conn, $query);

              while($row = mysqli_fetch_array($result_tasks)){ ?>
                <tr>
                  <td>
                    <?php echo $row['title']?>
                  </td>
                  <td>
                    <?php echo $row['description']?>
                  </td>
                  <td>
                    <a href="update_task.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                      <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </a>
                    <a href="delete_task.php?id=<?php echo $row['id']?>" class="btn btn-danger">
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
              <?php } ?>

          </tbody>
        </thead>
      </table>
    </div>

  </div>

</div>
<?php include("includes/footer.php")?> 
