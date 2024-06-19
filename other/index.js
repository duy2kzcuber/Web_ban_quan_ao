


/* Đây là phânf hover vào menu */

document.addEventListener('DOMContentLoaded', function () {
    const menuItem = document.querySelectorAll('.menu-item');

    menuItem.forEach(item => {
        const submenu = item.querySelector('.sub-menu');

        // Ẩn tất cả các mục con khi trang được tải lại
        submenu.style.display = 'none';

        // Hiển thị mục con khi di chuột qua mục cha
        item.addEventListener('mouseenter', () => {
            submenu.style.display = 'flex';
        });

        // Ẩn mục con khi di chuột ra khỏi mục cha
        item.addEventListener('mouseleave', () => {
            submenu.style.display = 'none';
        });

        // Thêm sự kiện click vào mỗi mục cha
        item.addEventListener('click', () => {
            // Loại bỏ lớp 'clicked' khỏi tất cả các mục
            menuItem.forEach(item => {
                item.classList.remove('clicked');
            });
            // Thêm lớp 'clicked' vào mục được nhấp vào
            item.classList.add('clicked');
            
            // Đảo ngược trạng thái của mục con khi click vào mục cha
            submenu.style.display = submenu.style.display === 'none' ? 'flex' : 'none';
        });
    });
    
    // Doi hinh anh cho banner
    function switchImages(bannerId) {
        const banner = document.getElementById(bannerId);
        const images = banner.getElementsByTagName('img');
        let currentImageIndex = 0;

        setInterval(() => {
            images[currentImageIndex].classList.remove('active');
            images[currentImageIndex].classList.add('inactive');

            currentImageIndex = (currentImageIndex + 1) % images.length;

            images[currentImageIndex].classList.remove('inactive');
            images[currentImageIndex].classList.add('active');
        }, 3000); // Change image every 3 seconds
    }
    switchImages('banner-1');
    switchImages('banner-2');
});




window.onload = () => {
    const listImage = document.querySelector('.list-image');
    const imgs = listImage.getElementsByTagName('img');

    setInterval(() => {
        let width = imgs[0].offsetWidth;
        listImage.style.transition = 'transform 1s ease-in-out'; // Thêm transition để tạo hiệu ứng di chuyển mềm mại
        listImage.style.transform = `translateX(${-width}px)`; // Di chuyển danh sách ảnh sang trái

        setTimeout(() => {
            listImage.appendChild(imgs[0]); // Lấy ảnh đầu tiên ra khỏi danh sách và chèn vào cuối danh sách
            listImage.style.transition = 'none'; // Loại bỏ transition để tránh hiệu ứng không mong muốn khi thêm ảnh vào cuối danh sách
            listImage.style.transform = 'translateX(0)'; // Đặt lại vị trí của danh sách ảnh về ban đầu
        }, 1000); // Thời gian chờ trước khi di chuyển ảnh, phải lớn hơn thời gian của transition
    }, 4000); // Thời gian cách nhau giữa các lần di chuyển ảnh
};


// Thiết lập thời gian đếm ngược (ví dụ: 1 giờ từ bây giờ)
const countdownTime = new Date().getTime() + 60 * 60 * 1000;

function updateCountdown() {
    const now = new Date().getTime();
    const distance = countdownTime - now;

    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("hours").textContent = String(hours).padStart(2, '0');
    document.getElementById("minutes").textContent = String(minutes).padStart(2, '0');
    document.getElementById("seconds").textContent = String(seconds).padStart(2, '0');

    // Nếu đếm ngược kết thúc, dừng lại
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("hours").textContent = "00";
        document.getElementById("minutes").textContent = "00";
        document.getElementById("seconds").textContent = "00";
    }
}

const x = setInterval(updateCountdown, 1000);



//Hover vào mục new Arrial
document.addEventListener('DOMContentLoaded', () => {
    const modaLink = document.querySelector('.moda-link');
    const menLink = document.querySelector('.men-link');
    const kidsLink = document.querySelector('.kids-link');

    const modaSection = document.querySelector('.moda');
    const menSection = document.querySelector('.men');
    const kidsSection = document.querySelector('.kids');

    modaLink.addEventListener('click', (event) => {
        event.preventDefault();
        modaSection.classList.remove('hidden');
        menSection.classList.add('hidden');
        kidsSection.classList.add('hidden');
    });

    menLink.addEventListener('click', (event) => {
        event.preventDefault();
        modaSection.classList.add('hidden');
        menSection.classList.remove('hidden');
        kidsSection.classList.add('hidden');
    });

    kidsLink.addEventListener('click', (event) => {
        event.preventDefault();
        modaSection.classList.add('hidden');
        menSection.classList.add('hidden');
        kidsSection.classList.remove('hidden');
    });
});



//Phan product

function showTabContent(tabId, event) {
            var contents = document.querySelectorAll('.tab-content');
            contents.forEach(function(content) {
                content.classList.remove('active');
            });

            var tabs = document.querySelectorAll('.tab-item');
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });

            document.getElementById(tabId).classList.add('active');
            event.target.parentElement.classList.add('active');
        }
           function toggleContent(tabId) {
            var moreContent = document.querySelector('#' + tabId + ' .more-content');
            var shortContent = document.querySelector('#' + tabId + ' .short-content');
            var button = document.querySelector('#' + tabId + ' .product-detail-divider .fa');
            if (moreContent.style.display === 'none' || moreContent.style.display === '') {
                moreContent.style.display = 'block';
                shortContent.classList.remove('short-content');
                button.className = 'fa fa-chevron-up';
            } else {
                moreContent.style.display = 'none';
                shortContent.classList.add('short-content');
                button.className = 'fa fa-chevron-down';
            }
        }



     //PRODUCT ZOOM ANH
        function zoomImage(event) {
            const imageContainer = event.currentTarget;
            const image = imageContainer.querySelector('img');
            
            // Lấy kích thước của hình ảnh
            const imageRect = image.getBoundingClientRect();
            
            // Tính toán vị trí của chuột so với hình ảnh
            const mouseX = event.clientX - imageRect.left;
            const mouseY = event.clientY - imageRect.top;
            
            // Chuyển vị trí của chuột thành phần trăm so với kích thước của hình ảnh
            const offsetX = (mouseX / imageRect.width) * 100;
            const offsetY = (mouseY / imageRect.height) * 100;
            
            // Cập nhật vị trí của hình ảnh sử dụng transform-origin
            image.style.transformOrigin = `${offsetX}% ${offsetY}%`;
            
            // Phóng to hình ảnh
            image.style.transform = 'scale(2)'; // Phóng to lên 200%
        }
        
        function unzoomImage(event) {
            const imageContainer = event.currentTarget;
            const image = imageContainer.querySelector('img');
            
            // Đặt lại thuộc tính transform của hình ảnh về kích thước ban đầu
            image.style.transform = 'scale(1)';
        }
        
        
        
        
        function changeImage(imagePath) {
            document.getElementById("mainImage").src = imagePath;
        }
        


        function showTab(tabId, element) {
            const tabs = document.querySelectorAll('.tab-content');
            const tabLinks = document.querySelectorAll('.tabs a');
            
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            document.getElementById(tabId).classList.add('active');
            
            tabLinks.forEach(link => {
                link.classList.remove('active');
            });
            element.classList.add('active');
        }
          

        /*Cartegory*/
document.addEventListener("DOMContentLoaded", function() {
    const categoryLinks = document.querySelectorAll('.cartegory-left-li > a');
    categoryLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const subCategory = this.nextElementSibling;
            if (subCategory) {
                subCategory.classList.toggle('hidden');
            }
        });
    });
});




//Dang kyyyyyyyyyyyyyyy
document.addEventListener("DOMContentLoaded", function () {
    const provinces = [
        "Hà Nội", "TP HCM", "Đà Nẵng", "Hải Phòng", "Cần Thơ"
        // Add more provinces as needed
    ];

    const districts = {
        "Hà Nội": ["Ba Đình", "Hoàn Kiếm", "Tây Hồ", "Long Biên"],
        "TP HCM": ["Quận 1", "Quận 2", "Quận 3", "Quận 4"],
        "Đà Nẵng": ["Hải Châu", "Thanh Khê", "Liên Chiểu", "Ngũ Hành Sơn"],
        "Hải Phòng": ["Hồng Bàng", "Lê Chân", "Ngô Quyền", "Kiến An"],
        "Cần Thơ": ["Ninh Kiều", "Bình Thủy", "Cái Răng", "Ô Môn"]
        // Add more districts as needed
    };

    const wards = {
        "Ba Đình": ["Phúc Xá", "Trúc Bạch", "Vĩnh Phúc", "Cống Vị"],
        "Hoàn Kiếm": ["Chương Dương", "Cửa Đông", "Đồng Xuân", "Hàng Bạc"],
        // Add more wards for each district as needed
    };

    const tinhTpSelect = document.getElementById("tinh-tp");
    const quanHuyenSelect = document.getElementById("quan-huyen");
    const phuongXaSelect = document.getElementById("phuong-xa");

    provinces.forEach(province => {
        const option = document.createElement("option");
        option.value = province;
        option.textContent = province;
        tinhTpSelect.appendChild(option);
    });

    tinhTpSelect.addEventListener("change", function () {
        const selectedProvince = tinhTpSelect.value;
        quanHuyenSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
        phuongXaSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
        
        if (selectedProvince) {
            districts[selectedProvince].forEach(district => {
                const option = document.createElement("option");
                option.value = district;
                option.textContent = district;
                quanHuyenSelect.appendChild(option);
            });
        }
    });

    quanHuyenSelect.addEventListener("change", function () {
        const selectedDistrict = quanHuyenSelect.value;
        phuongXaSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
        
        if (selectedDistrict && wards[selectedDistrict]) {
            wards[selectedDistrict].forEach(ward => {
                const option = document.createElement("option");
                option.value = ward;
                option.textContent = ward;
                phuongXaSelect.appendChild(option);
            });
        }
    });

    // Captcha generation
    function generateCaptcha() {
        const charsArray = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const lengthOtp = 6;
        let captcha = "";
        for (let i = 0; i < lengthOtp; i++) {
            const index = Math.floor(Math.random() * charsArray.length);
            captcha += charsArray[index];
        }
        document.getElementById("captcha-image").innerText = captcha;
    }

    generateCaptcha();
});
//Phan lien heee cua trang
document.addEventListener("DOMContentLoaded", function() {
    const contactIcon = document.getElementById('contact-icon');
    const menu = document.getElementById('menu');

    contactIcon.addEventListener('mouseover', function() {
        menu.style.display = 'block';
    });

    contactIcon.addEventListener('mouseout', function() {
        setTimeout(function() {
            if (!menu.matches(':hover')) {
                menu.style.display = 'none';
            }
        }, 100);
    });

    menu.addEventListener('mouseleave', function() {
        menu.style.display = 'none';
    });

    menu.addEventListener('mouseover', function() {
        menu.style.display = 'block';
    });
});
document.addEventListener("DOMContentLoaded", function() {
    // Get all the region links
    const regionLinks = document.querySelectorAll(".page-nav__link");

    // Add click event listeners to the region links
    regionLinks.forEach(function(link) {
        link.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default link behavior

            // Get the ID of the clicked region
            const regionId = this.getAttribute("href").substring(1);

            // Hide all store content
            hideAllStoreContent();

            // Show the store content of the clicked region
            showStoreContent(regionId);
        });
    });

    function hideAllStoreContent() {
        const allStoreContent = document.querySelectorAll(".ds__sidemenu");
        allStoreContent.forEach(function(content) {
            content.style.display = "none";
        });
    }

    function showStoreContent(regionId) {
        const storeContent = document.getElementById(regionId);
        if (storeContent) {
            storeContent.style.display = "block";
        }
    }
});
//he thong cua hàng
document.addEventListener('DOMContentLoaded', function () {
    // Lắng nghe sự kiện click cho mỗi liên kết "MIỀN BẮC", "MIỀN TRUNG", và "MIỀN NAM"
    var regionLinks = document.querySelectorAll('.region-link');
    regionLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault(); // Ngăn chặn hành vi mặc định khi click vào liên kết
            var region = this.getAttribute('data-region'); // Lấy giá trị của thuộc tính data-region
            // Ẩn tất cả các phần tử có class 'ds__sidemenu'
            var sidemenus = document.querySelectorAll('.ds__sidemenu');
            sidemenus.forEach(function (sidemenu) {
                sidemenu.style.display = 'none';
            });
            // Hiển thị phần tử tương ứng với vùng đã chọn
            var selectedRegion = document.getElementById(region);
            if (selectedRegion) {
                selectedRegion.style.display = 'block';
            }
        });
    });
});
function searchStores() {
    var input = document.getElementById('searchInput');
    var filter = input.value.toUpperCase();
    var resultsContainer = document.getElementById('searchResults');
    var stores = document.getElementsByClassName('ds__item__label');

    for (var i = 0; i < stores.length; i++) {
        var store = stores[i];
        var textValue = store.textContent || store.innerText;
        if (textValue.toUpperCase().indexOf(filter) > -1) {
            store.style.display = ""; // Hiển thị cửa hàng nếu tìm thấy kết quả
        } else {
            store.style.display = "none"; // Ẩn cửa hàng nếu không tìm thấy kết quả
        }
    }

    // Hiển thị hoặc ẩn kết quả tìm kiếm
    if (resultsContainer) {
        if (filter === "") {
            resultsContainer.innerHTML = "";
        } else {
            resultsContainer.innerHTML = "Không tìm thấy kết quả phù hợp";
        }
    }
}

document.getElementById('searchInput').addEventListener('input', searchStores);





document.addEventListener("DOMContentLoaded", function () {
    const provinces = [
        "Hà Nội", "TP HCM", "Đà Nẵng", "Hải Phòng", "Cần Thơ"
        // Add more provinces as needed
    ];

    const districts = {
        "Hà Nội": ["Ba Đình", "Hoàn Kiếm", "Tây Hồ", "Long Biên"],
        "TP HCM": ["Quận 1", "Quận 2", "Quận 3", "Quận 4"],
        "Đà Nẵng": ["Hải Châu", "Thanh Khê", "Liên Chiểu", "Ngũ Hành Sơn"],
        "Hải Phòng": ["Hồng Bàng", "Lê Chân", "Ngô Quyền", "Kiến An"],
        "Cần Thơ": ["Ninh Kiều", "Bình Thủy", "Cái Răng", "Ô Môn"]
        // Add more districts as needed
    };

    const wards = {
        "Ba Đình": ["Phúc Xá", "Trúc Bạch", "Vĩnh Phúc", "Cống Vị"],
        "Hoàn Kiếm": ["Chương Dương", "Cửa Đông", "Đồng Xuân", "Hàng Bạc"],
        // Add more wards for each district as needed
    };

    const tinhTpSelect = document.getElementById("tinh-tp");
    const quanHuyenSelect = document.getElementById("quan-huyen");
    const phuongXaSelect = document.getElementById("phuong-xa");

    provinces.forEach(province => {
        const option = document.createElement("option");
        option.value = province;
        option.textContent = province;
        tinhTpSelect.appendChild(option);
    });

    tinhTpSelect.addEventListener("change", function () {
        const selectedProvince = tinhTpSelect.value;
        quanHuyenSelect.innerHTML = '<option value="">Chọn Quận/Huyện</option>';
        phuongXaSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
        
        if (selectedProvince) {
            districts[selectedProvince].forEach(district => {
                const option = document.createElement("option");
                option.value = district;
                option.textContent = district;
                quanHuyenSelect.appendChild(option);
            });
        }
    });
    


    quanHuyenSelect.addEventListener("change", function () {
        const selectedDistrict = quanHuyenSelect.value;
        phuongXaSelect.innerHTML = '<option value="">Chọn Phường/Xã</option>';
        
        if (selectedDistrict && wards[selectedDistrict]) {
            wards[selectedDistrict].forEach(ward => {
                const option = document.createElement("option");
                option.value = ward;
                option.textContent = ward;
                phuongXaSelect.appendChild(option);
            });
        }
    });
    
    
});


    





    


          
        