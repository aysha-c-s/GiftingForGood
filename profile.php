<?php @include 'conf.php';
session_start();
$uid = $_SESSION['uid'];
$sql = "SELECT * FROM users WHERE uid='$uid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['username'];
    $address = $row['address'];
    $email = $row['email'];
    $phn = $row['phone'];
    $ophn = $row['optional_num'];
    $pass=$row['password'];
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phn = $_POST['phn'];
    $ophn = $_POST['ophn'];
    $address = $_POST['address'];
    $sql = "UPDATE users SET username='$name', email='$email', phone='$phn',optional_num='$ophn',address='$address' WHERE uid='$uid'";
    $result = $conn->query($sql);
    if ($result == TRUE) {
        header("Location: profile.php?success=Your account has been updated successfully");
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}


if (isset($_POST['change'])) {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    if ($currentPassword != $pass) {
        header("Location: profile.php?err=Old password doesn't match");
        exit();
    } else if ($newPassword != $confirmPassword) {
        header("Location: profile.php?err=New passwords do not match");
        exit();
    } else {
        $sql = "UPDATE users SET password='$newPassword' WHERE uid='$uid'";
        $result = $conn->query($sql);
        if ($result == TRUE) {
            header("Location: profile.php?succ=true");
            exit();
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="pstyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .modal-dialog {
            max-width: 500px;
            margin: 1.75rem auto;
        }
    </style>
</head>

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Account settings
        </h4>

        <div class="row no-gutters row-bordered row-border-light">
            <!-- <div class="col-md-3 pt-0">
                <div class="list-group list-group-flush account-settings-links">
                    <a class="list-group-item list-group-item-action active" data-toggle="list"
                        href="#account-general"></a>
                    <button style="background-color:blue; color:white; " type="button"
                        class="list-group-item list-group-item-action" data-toggle="modal"
                        data-target="#changePasswordModal">
                        Change Password
                    </button>
                </div>
            </div> -->
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="account-general">
                        <form action="" method="post" enctype="multipart/form-data">
                            <hr class="border-light m-0">

                            <div class="card-body">

                                <!-- success -->
                                <?php if (isset($_GET['success'])) { ?>
                                    <div class="alert alert-success" role="alert">
                                        <?php echo $_GET['success']; ?>
                                    </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone No.</label>
                                    <input type="text" class="form-control" name="phn" value="<?php echo $phn; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Optional Phone No.</label>
                                    <input type="text" class="form-control" name="ophn" value="<?php echo $ophn; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address"
                                        value="<?php echo $address; ?>">
                                </div>
                                <div class="text-right mt-3">
                                    <input type="submit" value="Save Changes" name="update"
                                        class="btn btn-primary">&nbsp;
                                    <button type="button" class="btn btn-primary" onclick="location.href='UserHome.php'">Home</button>
									
									<div style="float:left" class="list-group list-group-flush account-settings-links">
										<a class="list-group-item list-group-item-action active" data-toggle="list"
											href="#account-general"></a>
										<button style="background-color:crimson; color:white; border-radius:4px" type="button"
											class="list-group-item list-group-item-action" data-toggle="modal"
											data-target="#changePasswordModal">
											Change Password
										</button>
									</div>
                                </div>
								

                            </div>
                        </form>
                    </div>

                    <!-- The Modal -->

                    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="currentPassword">Current Password:</label>
                                            <input type="password" class="form-control" id="currentPassword"
                                                name="currentPassword" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="newPassword">New Password:</label>
                                            <input type="password" class="form-control" id="newPassword"
                                                name="newPassword" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPassword">Confirm New Password:</label>
                                            <input type="password" class="form-control" id="confirmPassword"
                                                name="confirmPassword" required>
                                        </div>
                                        <?php
                                        if (isset($_GET['err'])) {
                                            echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['err']) . '</div>';
                                        }
                                        ?>
                                        <button type="submit" name="change" class="btn btn-primary">Change Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Success Modal -->
                    <div class="modal fade" id="successModal" tabindex="-1" role="dialog"
                        aria-labelledby="successModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="successModalLabel">Success</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Your password has been changed.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                    <?php
                    if (isset($_GET['succ'])) {
                        echo '<script>
    $(document).ready(function() {
        $("#successModal").modal("show");
    });
    </script>';
                    }

                    if (isset($_GET['err'])) {
                        echo '<script>
    $(document).ready(function() {
        $("#changePasswordModal").modal("show");
    });
    </script>';
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>

</body>

</html>