<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng Điều Khiển - Cửa Hàng Thời Trang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            overflow-x: hidden;
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
                <img src="img/logo.png" alt="Logo" style="width:40px;">
                Quản Trị Cửa Hàng
            </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-tachometer-alt"></i> Bảng Điều Khiển
                </a>
                <a href="#products-section" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-box"></i> Sản Phẩm
                </a>
                <a href="#categories-section" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-tags"></i> Danh Mục Sản Phẩm
                </a>
                <a href="#product-types-section" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-cubes"></i> Nhân Viên
                </a>
                <a href="#" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-shopping-cart"></i> Đơn Hàng
                </a>
                <a href="#" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-users"></i> Khách Hàng
                </a>
                <a href="#" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-cog"></i> Cài Đặt
                </a>
                <a href="#" class="list-group-item list-group-item-action text-white">
                    <i class="fas fa-sign-out-alt"></i> Đăng Xuất
                </a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <div class="container-fluid mt-4">
                <!-- Dashboard Stats -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Tổng Sản Phẩm</h5>
                                <p class="card-text">120</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Tổng Đơn Hàng</h5>
                                <p class="card-text">150</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Tổng Khách Hàng</h5>
                                <p class="card-text">300</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Doanh Thu</h5>
                                <p class="card-text">$5000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Manage Categories Section -->
                <div id="categories-section" class="mt-4">
                    <h2>Quản Lý Danh Mục Sản Phẩm</h2>
                    <div class="mb-3">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">Thêm Danh Mục</button>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Mã Danh Mục</th>
                                <th>Tên Danh Mục</th>
                                <th>Danh Mục Cha</th>
                                <th>Tùy Biến</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>33</td>
                                <td>Áo Nam</td>
                                <td>Nam</td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-category" data-toggle="modal" data-target="#editCategoryModal" data-id="33" data-name="Áo Nam" data-parent="1">Chỉnh Sửa</button>
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </td>
                            </tr>
                            <!-- Additional categories can be added here -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->

    <!-- Modal Add Category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Thêm Danh Mục</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        <div class="form-group">
                            <label for="categoryName">Tên Danh Mục</label>
                            <input type="text" class="form-control" id="categoryName" placeholder="Nhập tên danh mục">
                        </div>
                        <div class="form-group">
                            <label for="parentCategory">Danh Mục Cha</label>
                            <select class="form-control" id="parentCategory">
                                <option value="">Không có</option>
                                <option value="1">Nam</option>
                                <option value="2">Nữ</option>
                                <!-- Additional parent categories can be added here -->
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-primary" id="saveCategory">Lưu</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Category -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="
                modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Chỉnh Sửa Danh Mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">
                <form id="editCategoryForm">
                <input type="hidden" id="editCategoryId">
                <div class="form-group">
                <label for="editCategoryName">Tên Danh Mục</label>
                <input type="text" class="form-control" id="editCategoryName" placeholder="Nhập tên danh mục">
                </div>
                <div class="form-group">
                <label for="editParentCategory">Danh Mục Cha</label>
                <select class="form-control" id="editParentCategory">
                <option value="">Không có</option>
                <option value="1">Nam</option>
                <option value="2">Nữ</option>
                <!-- Additional parent categories can be added here -->
                </select>
                </div>
                </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="updateCategory">Cập Nhật</button>
                </div>
                </div>
                </div>
                </div>
</body>
</html>