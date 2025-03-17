<?php
  include('database/database.php');
  include('partials/header.php');
  include('partials/sidebar.php');

  $items_per_page = 10;

  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

  $start_from = ($page - 1) * $items_per_page;

  $sql = "SELECT * FROM books LIMIT $start_from, $items_per_page";

  if (!empty($_GET['search'])) {
      $search = $_GET['search'];
      $sql = "SELECT * FROM books WHERE title LIKE '%$search%' OR Author LIKE '%$search%' OR Genre LIKE '%$search%' OR Date_Published LIKE '%$search%'";
  }
  
  $books = $conn->query($sql);  
  $status = '';
  if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    unset($_SESSION['status']);
  }
?>

<main id="main" class="main">

    <!-- BOOTSTRAP ALERT -->
    <?php if ($status == 'created'): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        New Book Added successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
      </div> 
    <?php elseif ($status == 'updated'): ?>
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        Book Info Updated.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
      </div> 
    <?php elseif ($status == 'error'): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Error, Please Try again.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
      </div>
    <?php elseif ($status == 'deleted'): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        Book Deleted.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
      </div> 
    <?php endif; ?>
      
  <div class="pagetitle">
    <h1>SorSu Book Management System</h1>
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
              <button class="btn btn-primary btn-sm mt-4 mx-3" data-bs-toggle="modal" data-bs-target="#addBookModal">Add Book</button>
            </div>

            <!-- Default Table -->
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Genre</th>
                  <th>Date Published</th>
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

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" data-bs-backdrop="static">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Edit Book</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="database/update.php" method="POST">
                                <div class="modal-body">
                                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                  <div class="mb-3">
                                    <label class="form-label">Title</label>
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
                                    <label class="form-label">Date Published</label>
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


                            <!-- View Button -->
                            <button class="btn btn-primary btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#ViewModal<?php echo $row['id']; ?>">View</button>

                            <!-- View Modal -->
                            <div class="modal fade" id="ViewModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="ViewModalLabel" aria-hidden="true" data-bs-backdrop="static">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title">View Book Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                  <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" value="<?php echo $row['title']; ?>" disabled>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Author</label>
                                    <input type="text" class="form-control" value="<?php echo $row['Author']; ?>" disabled>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Genre</label>
                                    <input type="text" class="form-control" value="<?php echo $row['Genre']; ?>" disabled>
                                  </div>
                                  <div class="mb-3">
                                    <label class="form-label">Date Published</label>
                                    <input type="date" class="form-control" value="<?php echo $row['Date_Published']; ?>" disabled>
                                  </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>


                        <!-- Delete Button -->
                        <button class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>">Delete</button>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true" data-bs-backdrop="static">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-body text-center">
                                <h1 class="text-danger" style="font-size: 50px"><strong>!</strong></h1>
                                <h5>Are you sure you want to delete this book?</h5>
                                <h6>This action cannot be undone.</h6>
                              </div>
                              <div class="modal-footer d-flex justify-content-center">
                                <form action="database/delete.php" method="POST">
                                  <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-danger">Yes, Delete</button>
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


            <!-- Pagination -->
          <div class="mx-4">
            <nav aria-label="Page navigation">
              <ul class="pagination justify-content-left">
                <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                  <a class="page-link" href="?page=<?php echo $page - 1; ?>">Previous</a>
                </li>
                
                <li class="page-item <?php echo ($page == $total_pages || !$next_page_exists) ?>">
                  <a class="page-link" href="?page=<?php echo $page + 1; ?>">Next</a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->

                        <!-- Create (Add Book) Modal -->
                        <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="addBookLabel" aria-hidden="true" data-bs-backdrop="static">
                          <div class="modal-dialog">
                            <form action="database/create.php" method="POST">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Add Book</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                              <div class="mb-3">
                                  <label class="form-label">Title</label>
                                  <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Author</label>
                                <input type="text" name="Author" id="Author" class="form-control" placeholder="Enter author"required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <input type="text" name="Genre" id="Genre" class="form-control" placeholder="Enter genre"required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Date Published</label>
                                <input type="date" name="Date_Published" id="Date_Published" class="form-control" placeholder="Enter Date Published"required>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Add Book</button>
                            </div>
                          </div>
                      </form>
                    </div>
                  </div>
                
                





<?php include('partials/footer.php'); ?>
