<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
        <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            height: 100vh; /* Full height */
            overflow: hidden; /* Prevent vertical scroll */
        }
        .sidebar {
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background-color: #f8f9fa;
            padding-top: 56px; /* Adjust for header height */
            transition: transform 0.3s ease; /* Smooth transition for sliding */
            transform: translateX(-250px); /* Start hidden */
        }
        .sidebar.show {
            transform: translateX(0); /* Show sidebar */
        }
        .main-content {
            margin-left: 0; /* Adjust for sidebar width when hidden */
            padding: 20px;
            overflow-y: auto; /* Allow scrolling in the main content area */
            height: calc(100vh - 56px); /* Full height minus header */
            transition: margin-left 0.3s ease; /* Smooth transition for content area */
        }
        .main-content.shift {
            margin-left: 250px; /* Adjust for sidebar width when shown */
        }
        .header {
            position: fixed;
            width: 100%;
            height: 56px;
            background-color: #343a40;
            color: white;
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }
        .toggle-btn {
            cursor: pointer;
            color: white;
            margin-right: 20px;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <span class="toggle-btn" id="toggleSidebar">&#9776;</span> <!-- Hamburger icon -->
        <h5 class="ms-2">Project Dashboard</h5>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        // Toggle sidebar visibility
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            sidebar.classList.toggle('show'); // Toggle the sidebar's visibility
            mainContent.classList.toggle('shift'); // Shift the main content
        });
    </script>
</body>
</html>
