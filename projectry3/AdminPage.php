<?php
@include 'conf.php';

// Update the post status if the form is submitted
if (isset($_POST['update_status'])) {
   $postId = $_POST['post_id'];
   $updateQuery = "UPDATE posts SET status='received' WHERE pid='$postId'";
   mysqli_query($conn, $updateQuery);
}

// Delete the post if the delete form is submitted
if (isset($_POST['delete_post'])) {
   $postId = $_POST['post_id'];
   $deleteQuery = "DELETE FROM posts WHERE pid='$postId'";
   mysqli_query($conn, $deleteQuery);
   $deleteQuery = "DELETE FROM admin WHERE pid='$postId'";
   mysqli_query($conn, $deleteQuery);
}

// Delete the post if the delete form is submitted
if (isset($_POST['delete_notice'])) {
   $noticeId = $_POST['notice_id'];
   $deleteQuery = "DELETE FROM notices WHERE n_id='$noticeId'";
   mysqli_query($conn, $deleteQuery);
}


// Fetch posts and employees from the database
$search="";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $postQuery = "SELECT * FROM users 
                  INNER JOIN posts ON users.uid = posts.uid 
                  WHERE posts.short_description LIKE '%$search%'
                  OR posts.Area LIKE '%$search%'
                  OR posts.full_address LIKE '%$search%'
                  OR posts.type LIKE '%$search%'
                  OR posts.amount LIKE '%$search%'
                  OR posts.Expire_date LIKE '%$search%'";
} else {
    $postQuery = "SELECT * FROM users INNER JOIN posts ON users.uid = posts.uid";
}
$post = mysqli_query($conn, $postQuery);

$empQuery = "SELECT * FROM employees";
$employee = mysqli_query($conn, $empQuery);


$assignedEmployee = null;
$assignedPostId = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assign_post'])) {
   $assignedEmployee = $_POST['employee_id'];
   $assignedPostId = $_POST['post_id'];
   $sql = "UPDATE admin SET eid ='$assignedEmployee' WHERE pid ='$assignedPostId'";
   $result = $conn->query($sql);
}

// $adminQuery = "SELECT * FROM admin";
// $admin = mysqli_query($conn, $adminQuery);

$assign = "SELECT admin.pid,admin.eid,admin.ruid,posts.Area FROM admin INNER JOIN posts ON (admin.pid=posts.pid) WHERE eid IS NOT NULL";
$assignEmp = mysqli_query($conn, $assign);

// Fetch notices from the database
$noticeQuery = "SELECT * FROM notices";
$notice = mysqli_query($conn, $noticeQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="AdminPage.css">
   <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
   <title>Admin Page</title>
   <style>
      /* Hover effect for table rows */
      tr[data-bs-toggle="modal"]:hover {
         background-color: #f1f1f1;
         cursor: pointer;
         transition: all 0.3s ease;
         transform: scale(1.02);
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      /* Hover effect for action column containing trash icon */
      .action-column .delete-icon:hover {
         color: black !important;
         cursor: pointer;

      }
   </style>
</head>

<body style="background-color:#ecdcef;">

   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-light fixed-top">
      <div class="container">
         <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="logo" class="logo">
         </a>
         <div class="collapse navbar-collapse justify-content-center" id="navbarSearch">
            <form class="d-flex" method="post" action="">
               <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
               <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
         </div>
         <div class="d-flex">
            <button class="btn btn-primary me-2" type="button" onclick="location.href='NoticeForm.php'">Create
               Notice</button>
            <button class="btn btn-danger" type="button" onclick="location.href='logout.php'">Log Out</button>
         </div>
      </div>
   </nav>

   <!-- Hero Section -->
   <section class="hero-section text-center">
      <h1>ADMINS WORKPLACE</h1>
   </section>

   <!-- Tabs Section -->
   <section class="tabs-section">
      <div class="container">
         <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
               <button class="nav-link active" id="general-info-tab" data-bs-toggle="tab" data-bs-target="#general-info"
                  type="button" role="tab" aria-controls="general-info" aria-selected="true">General Info</button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="nav-link" id="employee-info-tab" data-bs-toggle="tab" data-bs-target="#employee-info"
                  type="button" role="tab" aria-controls="employee-info" aria-selected="false">Employee
                  Info</button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="nav-link" id="assign-info-tab" data-bs-toggle="tab" data-bs-target="#assign-info"
                  type="button" role="tab" aria-controls="assign-info" aria-selected="false">Assign Info</button>
            </li>
            <li class="nav-item" role="presentation">
               <button class="nav-link" id="notice-info-tab" data-bs-toggle="tab" data-bs-target="#notice-info"
                  type="button" role="tab" aria-controls="notice-info" aria-selected="false">Notice Info</button>
            </li>
         </ul>
         <div class="tab-content" id="myTabContent">
            <!-- General Info Tab -->
            <div class="tab-pane fade show active" id="general-info" role="tabpanel" aria-labelledby="general-info-tab">
               <table class="table table-striped mt-3">
                  <thead>
                     <tr>
                        <th scope="col">Post Id</th>
                        <th scope="col">Donor Id</th>
                        <th scope="col">Donate Area</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php while ($row = mysqli_fetch_assoc($post)): ?>
                        <tr data-bs-toggle="modal" data-bs-target="#generalModal<?php echo $row['pid']; ?>">
                           <td><?php echo $row['pid']; ?></td>
                           <td><?php echo $row['uid']; ?></td>
                           <td><?php echo $row['Area']; ?></td>
                           <td><?php echo $row['short_description']; ?></td>
                           <td>
                              <?php
                              if ($row['status'] == "claimed") {
                                 echo "<p class='status pending'>Pending</p>";
                              } elseif ($row['status'] == "unclaimed") {
                                 echo "<p class='status unclaimed'>Unclaimed</p>";
                              } elseif ($row['status'] == "expired") {
                                 echo "<p class='status expired'>Expired</p>";
                              } elseif ($row['status'] == "received") {
                                 echo "<p class='status received'>Received</p>";
                              }
                              ?>
                           </td>
                           <td class="action-column">
                              <i class="fas fa-trash delete-icon text-danger" data-bs-toggle="modal"
                                 data-bs-target="#deleteModal<?php echo $row['pid']; ?>"></i>
                           </td>
                        </tr>

                        <!-- General Modal -->
                        <div class="modal fade" id="generalModal<?php echo $row['pid']; ?>" tabindex="-1"
                           aria-labelledby="generalModalLabel<?php echo $row['pid']; ?>" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="generalModalLabel<?php echo $row['pid']; ?>">
                                       General Info
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <p><strong>Post Id:</strong> <?php echo $row['pid']; ?></p>
                                    <p><strong>Donor Id:</strong>
                                       <a href="#" data-bs-toggle="modal"
                                          data-bs-target="#userModal<?php echo $row['uid']; ?>" data-bs-dismiss="modal">
                                          <?php echo $row['uid']; ?>
                                       </a>
                                    </p>
                                    <p><strong>Area:</strong> <?php echo $row['Area']; ?></p>
                                    <p><strong>Description:</strong> <?php echo $row['short_description']; ?>
                                    </p>
                                    <p><strong>Status:</strong> <?php echo ucfirst($row['status']); ?></p>
                                 </div>
                                 <div class="modal-footer">

                                    <?php if ($row['status'] == 'claimed'): ?>
                                       <form method="post" action="">
                                          <input type="hidden" name="post_id" value="<?php echo $row['pid']; ?>">
                                          <?php
                                          $p = $row['pid'];
                                          $sql = "SELECT * FROM admin inner join users on (admin.ruid=users.uid) WHERE pid='$p'";
                                          $result = $conn->query($sql);
                                          $rrow = $result->fetch_assoc();
                                          $rname = $rrow['username'];
                                          ?>
                                          <p>claimed by <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#receiverModal<?php echo $rrow['ruid']; ?>"
                                                data-bs-dismiss="modal">
                                                <?php echo $rname ?></p>
                                          </a>
                                          <button type="submit" name="update_status" class="btn btn-primary">Received??</button>
                                       </form>
                                    <?php elseif ($row['status'] == 'received'): ?>
                                       <span class="text-success fw-bold">Received</span>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Receiver Modal -->
                        <div class="modal fade" id="receiverModal<?php echo $rrow['ruid']; ?>" tabindex="-1"
                           aria-labelledby="receiverModalLabel<?php echo $rrow['ruid']; ?>" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="receiverModalLabel<?php echo $rrow['ruid']; ?>">
                                       Receiver Details
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <?php
                                    $rc = $rrow['ruid'];
                                    $sql = "SELECT * FROM users WHERE uid='$rc'";
                                    $result = $conn->query($sql);
                                    $crow = $result->fetch_assoc();
                                    $cname = $crow['username'];
                                    $caddress = $crow['address'];
                                    $cemail = $crow['email'];
                                    $cphn = $crow['phone'];
                                    $cophn = $crow['optional_num'];
                                    ?>
                                    <p><strong>Name: </strong><?php echo $cname; ?></p>
                                    <p><strong>Address: </strong><?php echo $caddress; ?></p>
                                    <p><strong>Email: </strong><?php echo $cemail; ?> </p>
                                    <p><strong>Contact: </strong> <?php echo $cphn; ?></p>
                                    <p><strong>Additional: </strong> <?php echo $cophn; ?></p>

                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="backToGeneral"
                                       data-bs-dismiss="modal">Back</button>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <script>
                           document.getElementById('backToGeneral').addEventListener('click', function () {
                              // Close the User Modal
                              var userModal = document.getElementById('receiverModal<?php echo $rrow['ruid']; ?>');
                              var bootstrapModal = bootstrap.Modal.getInstance(receiverModal);
                              bootstrapModal.hide();

                              // Wait for the User Modal to hide, then open the General Modal
                              setTimeout(function () {
                                 var generalModal = new bootstrap.Modal(document.getElementById('generalModal<?php echo $row['pid']; ?>'));
                                 generalModal.show();
                              }, 200); // Delay to ensure smooth transition
                           });
                        </script>

                        <!-- User Modal -->
                        <div class="modal fade" id="userModal<?php echo $row['uid']; ?>" tabindex="-1"
                           aria-labelledby="userModalLabel<?php echo $row['uid']; ?>" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel<?php echo $row['uid']; ?>">
                                       Donor Details
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <?php
                                    $r = $row['uid'];
                                    $sql = "SELECT * FROM users WHERE uid='$r'";
                                    $result = $conn->query($sql);
                                    $urow = $result->fetch_assoc();
                                    $uname = $urow['username'];
                                    $uaddress = $urow['address'];
                                    $uemail = $urow['email'];
                                    $uphn = $urow['phone'];
                                    $uophn = $urow['optional_num'];
                                    ?>
                                    <p><strong>Name: </strong><?php echo $uname; ?></p>
                                    <p><strong>Address: </strong><?php echo $uaddress; ?></p>
                                    <p><strong>Email: </strong><?php echo $uemail; ?> </p>
                                    <p><strong>Contact: </strong> <?php echo $uphn; ?></p>
                                    <p><strong>Additional: </strong> <?php echo $uophn; ?></p>

                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" id="backButton"
                                       data-bs-dismiss="modal">Back</button>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <script>
                           document.getElementById('backButton').addEventListener('click', function () {
                              // Close the User Modal
                              var userModal = document.getElementById('userModal<?php echo $row['uid']; ?>');
                              var bootstrapModal = bootstrap.Modal.getInstance(userModal);
                              bootstrapModal.hide();

                              // Wait for the User Modal to hide, then open the General Modal
                              setTimeout(function () {
                                 var generalModal = new bootstrap.Modal(document.getElementById('generalModal<?php echo $row['pid']; ?>'));
                                 generalModal.show();
                              }, 200); // Delay to ensure smooth transition
                           });
                        </script>
                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal<?php echo $row['pid']; ?>" tabindex="-1"
                           aria-labelledby="deleteModalLabel<?php echo $row['pid']; ?>" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel<?php echo $row['pid']; ?>">
                                       Confirm Delete
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    Are you sure you want to delete this post?
                                 </div>
                                 <div class="modal-footer">
                                    <form method="post" action="">
                                       <input type="hidden" name="post_id" value="<?php echo $row['pid']; ?>">
                                       <button type="submit" name="delete_post" class="btn btn-danger">Yes</button>
                                    </form>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php endwhile; ?>
                  </tbody>
               </table>
            </div>
            <!-- Employee Info Tab -->
            <div class="tab-pane fade" id="employee-info" role="tabpanel" aria-labelledby="employee-info-tab">
               <table class="table table-striped mt-3">
                  <thead>
                     <tr>
                        <th scope="col">Employee Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Area</th>
                        <th scope="col">Detail Address</th>
                        <th scope="col">Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php while ($row = mysqli_fetch_assoc($employee)): ?>
                        <tr data-bs-toggle="modal" data-bs-target="#employeeModal<?php echo $row['eid']; ?>">
                           <td><?php echo $row['eid']; ?></td>
                           <td><?php echo $row['name']; ?></td>
                           <td><?php echo $row['Area']; ?></td>
                           <td><?php echo $row['Detail_address']; ?></td>
                           <td>
                              <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                 data-bs-target="#assignModal<?php echo $row['eid']; ?>">Assign</button>
                           </td>
                        </tr>

                        <!-- Employee Modal -->
                        <div class="modal fade" id="employeeModal<?php echo $row['eid']; ?>" tabindex="-1"
                           aria-labelledby="employeeModalLabel<?php echo $row['eid']; ?>" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="employeeModalLabel<?php echo $row['eid']; ?>">Employee Info
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <p><strong>Employee Id:</strong> <?php echo $row['eid']; ?></p>
                                    <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
                                    <p><strong>Area:</strong> <?php echo $row['Area']; ?></p>
                                    <p><strong>Detail Address:</strong> <?php echo $row['Detail_address']; ?></p>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <!-- Assign Modal for each Employee -->
                        <div class="modal fade" id="assignModal<?php echo $row['eid']; ?>" tabindex="-1"
                           aria-labelledby="assignModalLabel<?php echo $row['eid']; ?>" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="assignModalLabel<?php echo $row['eid']; ?>">Assign Post to
                                       Employee</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <!-- Assign Form -->
                                    <form method="post" action="">
                                       <div class="mb-3">
                                          <label for="post_id_<?php echo $row['eid']; ?>" class="form-label">Enter Post
                                             ID:</label>
                                          <input type="text" class="form-control" id="post_id_<?php echo $row['eid']; ?>"
                                             name="post_id">
                                       </div>
                                       <input type="hidden" name="employee_id" value="<?php echo $row['eid']; ?>">
                                       <button type="submit" name="assign_post" class="btn btn-primary">Assign</button>
                                    </form>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php endwhile; ?>
                  </tbody>
               </table>
            </div>

            <!-- Assign Info Tab -->
            <div class="tab-pane fade" id="assign-info" role="tabpanel" aria-labelledby="assign-info-tab">
               <table class="table table-striped mt-3">
                  <thead>
                     <tr>
                        <th scope="col">Post Id</th>
                        <th scope="col">Assigned Employee Id</th>
                        <th scope="col">Receiver Id</th>
                        <th scope="col">Area</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php while ($row = mysqli_fetch_assoc($assignEmp)): ?>
                        <tr data-bs-toggle="modal" data-bs-target="#assignModal<?php echo $i + 1; ?>">
                           <td><?php echo $row['pid']; ?></td>
                           <td><?php echo $row['eid']; ?></td>
                           <td><?php echo $row['ruid']; ?></td>
                           <td><?php echo $row['Area']; ?></td>
                        </tr>

                        <!-- Assign Modal -->
                        <div class="modal fade" id="assignModal<?php echo $row['pid']; ?>" tabindex="-1"
                           aria-labelledby="assignModalLabel<?php echo $row['pid']; ?>" aria-hidden="true">
                           <div class="modal-dialog">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="assignModalLabel<?php echo $row['pid']; ?>">Assign Info
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                       aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                    <p><strong>Post Id: </strong> <?php echo $row['pid']; ?></p>
                                    <p><strong>Assigned Employee Id: </strong><?php echo $row['eid']; ?></p>
                                    <p><strong>Receiver Id: </strong><?php echo $row['ruid']; ?></p>
                                    <p><strong>Area: </strong> Area <?php echo $row['Area']; ?></p>
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php endwhile; ?>
                  </tbody>
               </table>
            </div>

            <!-- Notice Info Tab -->
            <div class="tab-pane fade" id="notice-info" role="tabpanel" aria-labelledby="notice-info-tab">
               <table class="table table-striped mt-3">
                  <thead>
                     <tr>
                        <th scope="col">Notice Id</th>
                        <th scope="col">Location</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php if ($notice->num_rows > 0): ?>
                        <?php while ($row = $notice->fetch_assoc()): ?>
                           <tr data-bs-toggle="modal" data-bs-target="#noticeModal<?php echo $row['n_id']; ?>">
                              <td><?php echo $row['n_id']; ?></td>
                              <td><?php echo $row['location']; ?></td>
                              <td><?php echo $row['description']; ?></td>
                              <td><?php echo $row['created_at']; ?></td>
                              <td>
                                 <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteNoticeModal<?php echo $row['n_id']; ?>">Delete</button>
                              </td>
                           </tr>

                           <!-- Notice Modal -->
                           <div class="modal fade" id="noticeModal<?php echo $row['n_id']; ?>" tabindex="-1"
                              aria-labelledby="noticeModalLabel<?php echo $row['n_id']; ?>" aria-hidden="true">
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="noticeModalLabel<?php echo $row['n_id']; ?>">Notice Info
                                       </h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                       <p><strong>Notice Id:</strong> <?php echo $row['n_id']; ?></p>
                                       <p><strong>Location:</strong> Location <?php echo $row['location']; ?></p>
                                       <p><strong>Description:</strong> Description <?php echo $row['description']; ?></p>
                                       <p><strong>Date Created:</strong> <?php echo $row['created_at']; ?></p>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <!-- Delete Modal -->
                           <div class="modal fade" id="deleteNoticeModal<?php echo $row['n_id']; ?>" tabindex="-1"
                              aria-labelledby="deleteNoticeModalLabel<?php echo $row['n_id']; ?>" aria-hidden="true">
                              <div class="modal-dialog">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title" id="deleteNoticeModalLabel<?php echo $row['n_id']; ?>">
                                          Confirm Delete
                                       </h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                       Are you sure you want to delete this notice?
                                    </div>
                                    <div class="modal-footer">
                                       <form method="post" action="">
                                          <input type="hidden" name="notice_id" value="<?php echo $row['n_id']; ?>">
                                          <button type="submit" name="delete_notice" class="btn btn-danger">Yes</button>
                                       </form>
                                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    </div>
                                 </div>
                              </div>
                           </div>


                        <?php endwhile; ?>
                     <?php else: ?>
                        <tr>
                           <td colspan="5">No notices found.</td>
                        </tr>
                     <?php endif; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section>

   <!-- Assigned Modal -->
   <?php if ($assignedEmployee && $assignedPostId): ?>
      <div class="modal fade show" id="assignedModal" tabindex="-1" aria-labelledby="assignedModalLabel"
         style="display: block;" aria-modal="true" role="dialog">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="assignedModalLabel">Assigned Post to Employee</h5>
                  <form method="post" action="">
                     <button type="submit" name="close_assigned_modal" class="btn-close" aria-label="Close"></button>
                  </form>
               </div>
               <div class="modal-body">
                  <p>Employee added successfully!!</p>
               </div>
               <div class="modal-footer">
                  <form method="post" action="">
                     <button type="submit" name="close_assigned_modal" class="btn btn-secondary">Close</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   <?php endif; ?>

   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>
</body>

</html>