<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Điều Khiển - Cửa Hàng Thời Trang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .image-container {
            display: flex;
            gap: 10px; /* Khoảng cách giữa các ảnh */
        }

        .product-image {
            width: 75px;
            height: auto;
        }
    
        body {
            
            background-color: #f1f1f1;
        }

        #wrapper {
            display: flex;
            flex-direction: row;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            width: 250px;
            background-color: #343a40; /* New color for sidebar */
            transition: all 0.3s ease-out;
        }

        #sidebar-wrapper .sidebar-heading {
            padding: 1rem;
            font-size: 1.2rem;
            color: #ffffff; /* Text color */
        }

        #sidebar-wrapper .list-group {
            width: 100%;
        }

        #sidebar-wrapper .list-group-item {
            background-color: #343a40; /* New color for items */
            color: #ffffff; /* Text color */
            border: none; /* Remove border */
        }

        #sidebar-wrapper .list-group-item:hover {
            background-color: #495057; /* Hover color */
        }

        #page-content-wrapper {
            width: calc(100% - 250px);
            padding-left: 20px;
        }

        .card {
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }
    </style>
    <!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Ensure the DOM is fully loaded
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Bảng điều khiển đã được tải.");

        // Event listener for the "Thêm Danh Mục" button to show the modal
        $('#addCategoryModal').on('show.bs.modal', function () {
            // Clear previous input values
            $('#categoryName').val('');
            $('#parentCategory').val('');
        });

        // Event listener for the "Lưu" button in the Add Category modal
        $('#saveCategory').click(function() {
            // Perform actions to save the category
            var categoryName = $('#categoryName').val();
            var parentCategory = $('#parentCategory').val();
            // Here you would typically send this data to your backend or perform other actions
            console.log("Category Name:", categoryName);
            console.log("Parent Category:", parentCategory);
            // Close the modal
            $('#addCategoryModal').modal('hide');
        });

        // Event listener for the "Chỉnh Sửa" button in the Edit Category modal
        $('.edit-category').click(function() {
            // Get data attributes from the button
            var categoryId = $(this).data('id');
            var categoryName = $(this).data('name');
            var parentCategory = $(this).data('parent');

            // Populate the form fields with the retrieved data
            $('#editCategoryId').val(categoryId);
            $('#editCategoryName').val(categoryName);
            $('#editParentCategory').val(parentCategory);

            // Show the Edit Category modal
            $('#editCategoryModal').modal('show');
        });

        // Event listener for the "Cập Nhật" button in the Edit Category modal
        $('#updateCategory').click(function() {
            // Perform actions to update the category
            var editCategoryId = $('#editCategoryId').val();
            var editCategoryName = $('#editCategoryName').val();
            var editParentCategory = $('#editParentCategory').val();
            // Here you would typically send this data to your backend or perform other actions
            console.log("Updated Category ID:", editCategoryId);
            console.log("Updated Category Name:", editCategoryName);
            console.log("Updated Parent Category:", editParentCategory);
            // Close the modal
            $('#editCategoryModal').modal('hide');
        });
    });
</script>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="sidebar-heading text-white">
                <img src="/Thoitrang_VHTDT/backend/img/logo.png" alt="Logo" style="width:40px;">
                Nhân viên cửa hàng
            </div>
            <div class="list-group list-group-flush">
                <a href="/Thoitrang_VHTDT/nhanvien/backend_sanpham/lietke.php" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-box"></i> Sản Phẩm
                </a>
                <a href="/Thoitrang_VHTDT/nhanvien/backend_danhmuc/lietkedanhmuc.php" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-tags"></i> Danh Mục Sản Phẩm
                </a>
                <a href="/Thoitrang_VHTDT/nhanvien/backend_donhang/Danhsach_dh.php" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-shopping-cart"></i> Đơn Hàng
                </a>
                <a href="/Thoitrang_VHTDT/nhanvien/dangxuat.php" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                </a>
            </div>
        </div>
        
    
</body>
</html>