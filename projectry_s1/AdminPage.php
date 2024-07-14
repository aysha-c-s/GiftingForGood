<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="AdminPage.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>adminPage</title>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="images/logo.png" alt="logo" class="logo">
                </a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSearch">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
                <div class="d-flex">
                    <button class="btn btn-primary me-2" type="button">Create Notice</button>
                    <button class="btn btn-danger" type="button">Log Out</button>
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
                        <button class="nav-link active" id="general-info-tab" data-bs-toggle="tab" data-bs-target="#general-info" type="button" role="tab" aria-controls="general-info" aria-selected="true">General Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="employee-info-tab" data-bs-toggle="tab" data-bs-target="#employee-info" type="button" role="tab" aria-controls="employee-info" aria-selected="false">Employee Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="assign-info-tab" data-bs-toggle="tab" data-bs-target="#assign-info" type="button" role="tab" aria-controls="assign-info" aria-selected="false">Assign Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="notice-info-tab" data-bs-toggle="tab" data-bs-target="#notice-info" type="button" role="tab" aria-controls="notice-info" aria-selected="false">Notice Info</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- General Info Tab -->
                    <div class="tab-pane fade show active" id="general-info" role="tabpanel" aria-labelledby="general-info-tab">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">p_id</th>
                                    <th scope="col">u_id</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 3; $i++): ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td>u_<?php echo $i + 1; ?></td>
                                    <td>Area <?php echo $i + 1; ?></td>
                                    <td>Description <?php echo $i + 1; ?></td>
                                    <td>Status <?php echo $i + 1; ?></td>
                                    <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
    
                    <!-- Employee Info Tab -->
                    <div class="tab-pane fade" id="employee-info" role="tabpanel" aria-labelledby="employee-info-tab">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">e_id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 3; $i++): ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td>Name <?php echo $i + 1; ?></td>
                                    <td>Area <?php echo $i + 1; ?></td>
                                    <td>Details <?php echo $i + 1; ?></td>
                                    <td><button class="btn btn-primary btn-sm">Assign</button></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
    
                    <!-- Assign Info Tab -->
                    <div class="tab-pane fade" id="assign-info" role="tabpanel" aria-labelledby="assign-info-tab">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">p_id</th>
                                    <th scope="col">Assigned e_id</th>
                                    <th scope="col">r_id</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 3; $i++): ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td>e_<?php echo $i + 1; ?></td>
                                    <td>r_<?php echo $i + 1; ?></td>
                                    <td>Area <?php echo $i + 1; ?></td>
                                    <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
    
                    <!-- Notice Info Tab -->
                    <div class="tab-pane fade" id="notice-info" role="tabpanel" aria-labelledby="notice-info-tab">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">N_id</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < 3; $i++): ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td>Location <?php echo $i + 1; ?></td>
                                    <td>Description <?php echo $i + 1; ?></td>
                                    <td><?php echo date('Y-m-d'); ?></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    
    
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>
    
