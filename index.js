


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
