<?php
  include('database/database.php');
  include('database/delete.php');
  include('database/update.php');
  include('partials/header.php');
  include('partials/sidebar.php');

  $sql = "SELECT * FROM books";
  $books = $conn->query($sql);
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Book Information Management System</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">General</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <h5 class="card-title">Book List</h5>
              <button class="btn btn-primary btn-sm mt-4 mx-3">Add book</button>
            </div>

            <!-- Default Table -->
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>title</th>
                  <th>Author</th>
                  <th>Genre</th>
                  <th>Date_Published</th>
                  <th class="text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($books->num_rows > 0): ?>
                  <?php while ($row = $books->fetch_assoc()): ?>
                    <tr>
                      <th scope="row"><?php echo $row['id']; ?></th>
                      <td><?php echo $row['title']; ?></td>
                      <td><?php echo $row['Author']; ?></td>
                      <td><?php echo $row['Genre']; ?></td>
                      <td><?php echo $row['Date_Published']; ?></td>
                      <td class="d-flex justify-content-center">
                        <!-- Edit Button -->
                        <button class="btn btn-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">Edit</button>
                        <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Book</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="database/update.php" method="POST">
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                  <div class="mb-3">
                                    <label class="form-label">title</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $row['title']; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Author</label>
                                    <input type="text" name="Author" class="form-control" value="<?php echo $row['Author']; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Genre</label>
                                    <input type="text" name="Genre" class="form-control" value="<?php echo $row['Genre']; ?>" required>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Date_Published</label>
                                    <input type="date" name="Date_Published" class="form-control" value="<?php echo $row['Date_Published']; ?>" required>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                        <button class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#delete">Delete</button>
                        <!-- Delete Modal -->
                        <div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-backdrop="false" tabindex="-1" aria-labelledby="editInfolabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                <h1 class="text-danger" style="font-size: 50px"><strong>!</strong></h1>
                                <h5>Are you sure you want to delete this employee?</h5>
                                <h6>This action cannot be undone.</h6>
                              </div>
                              <div class="modal-footer d-flex justify-content-center">
                                 <form action="database/delete.php" method="POST">
                                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Yes, Delete</button>
                               </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" class="text-center">No books found</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

<?php include('partials/footer.php'); ?>
