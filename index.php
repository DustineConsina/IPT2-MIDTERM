<?php
  include('database\database.php');
  include('partials\header.php');
  include('partials\sidebar.php');

  $sql = "SELECT * FROM books";
  $books = $conn->query($sql);
  // Your PHP BACK CODE HERE

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
                <div>
                  <h5 class="card-title">Default Table</h5>
                </div>
                <div>
                  <button class="btn btn-primary btn-sm mt-4 mx-3">Add Employee</button>
                </div>
              </div>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Genre</th>
                    <th scope="col">Date_Published</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
              <?php if ($books->num_rows > 0): ?>
               <?php while($row = $books->fetch_assoc()): ?>
                <tr>
                  <th scope="row"><?php echo $row['id']; ?></th>
                  <td><?php echo $row['title']; ?></td>
                  <td><?php echo $row['Author']; ?></td>
                  <td><?php echo $row['Genre']; ?></td>
                  <td><?php echo $row['Date_Published']; ?></td>
                  <td class="d-flex justify-content-center">
                    <button class="btn btn-success btn-sm mx-1" data-bs-toggle="model" data-bs-target="#editInfo">Edit</button>
                    <!-- Update Modal -->
                    <div class="modal fade" id="editInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel"
                    aria-hidden="true">
                    </div>

                    <button class="btn btn-primary btn-sm mx-1" title="View Books Information" data-bs-toggle="modal" data-bs-target="viewInfo">View</button>

                    <div class="modal fade" id="ViewInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel"
                    aria-hidden="true">
                    </div>

                    <button class="btn btn-danger btnb-sm mx-1" data-bs-toggle="modal" data-bs-target="#delete">Delete</button>

                    <div class="modal fade" id="delete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel"
                    aria-hidden="true">
                    </div>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else: ?>
             </tr>
                <td colspan="6" class="text-center">No books found</td>
              </tr>
            <?php endif; ?>


              </table>
              <!-- End Default Table Example -->
            </div>
            <div class="mx-4">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
            </div>
          </div>

        </div>

        
      </div>

      <!-- Modal -->
      <div class="modal fade" id="editInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editInfoLabel">Employee Information</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              </table>
              <!-- End Default Table Example -->
            </div>
            <div class="mx-4">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
            </div>
          </div>

        </div>

        
      </div>

      <!-- Modal -->
      <div class="modal fade" id="editInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editInfoLabel">Employee Information</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
<?php
include('partials\footer.php');
?>