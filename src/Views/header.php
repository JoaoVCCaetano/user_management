<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .navbar-custom {
            background-color: #4B0082; /* Indigo */
        }
        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: #FFFFFF; /* White */
        }
        .navbar-custom .nav-link:hover {
            color: #FFD700; /* Gold */
        }
        .container-custom {
            background-color: #F8F9FA; /* Light gray */
            padding: 20px;
            border-radius: 8px;
        }
        footer {
            background-color: #333333; /* Black */
            color: #FFFFFF; /* White */
            padding: 10px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand">User Management</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/users">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/user/create">Add User</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container container-custom mt-5">
