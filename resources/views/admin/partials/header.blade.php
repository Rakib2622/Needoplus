<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #1e1e2f;
            color: white;
            padding-top: 20px;
            transition: all 0.3s;
            z-index: 9998;
        }

        .sidebar a {
            display: block;
            color: #ddd;
            padding: 12px 20px;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #343a40;
            color: white;
        }

        /* Collapsed */
        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar.collapsed span {
            display: none;
        }

        /* Main */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: 0.3s;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        /* Toggle */
        .toggle-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 9999;
        }

        /* Overlay */
        #overlay {
            display: none;
        }

        /* Horizontal Scroll */
        .product-scroll {
            overflow-x: auto;
            gap: 12px;
            padding-bottom: 10px;
        }

        .product-scroll::-webkit-scrollbar {
            height: 6px;
        }

        .product-scroll::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 10px;
        }

        /* Card Size */
        .product-card {
            min-width: 160px;
            max-width: 160px;
            flex: 0 0 auto;
        }

        /* Image */
        .img-box {
            height: 120px;
            overflow: hidden;
        }

        .img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-img {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eee;
            font-size: 12px;
        }

        /* Card style */
        .product-ui {
            border-radius: 12px;
            transition: 0.3s;
            background: #fff;
        }

        .product-ui:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Image */
        .img-box {
            height: 130px;
            overflow: hidden;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.3s;
        }

        .product-ui:hover img {
            transform: scale(1.05);
        }

        /* No image */
        .no-img {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f1f1;
            font-size: 12px;
        }

        /* Buttons */
        .btn-warning {
            background: #0bf5f1;
            border: none;
        }

        .btn-danger {
            background: #ef4444;
            border: none;
        }

        /* Mobile */
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            #overlay.active {
                display: block;
                position: fixed;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.4);
                top: 0;
                left: 0;
                z-index: 9997;
            }
        }
    </style>

</head>

<body>

    <button class="btn btn-dark toggle-btn" onclick="toggleSidebar()">☰</button>

    <!-- Overlay -->
    <div id="overlay" onclick="toggleSidebar()"></div>