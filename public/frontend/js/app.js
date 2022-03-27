// modal
settings = {
    objModalPopupBtn: ".modalButton",
    objModalCloseBtn: ".overlay, .closeBtn",
    objModalDataAttr: "data-popup"
}
$(settings.objModalPopupBtn).bind("click", function() {
    setTimeout(() => {
        if ($(this).attr(settings.objModalDataAttr)) {
            var strDataPopupName = $(this).attr(settings.objModalDataAttr);
            $(".overlay, #" + strDataPopupName).fadeIn();
        }
    }, 1000);
});
$(settings.objModalCloseBtn).bind("click", function() {
    $(".modal").fadeOut();
});
$("#bnt_show_document").click(function (e) { 
    window.open(e.target.getAttribute("data_document"), "Tài liệu", "width=700, height=900");
});

const iconNavbar = document.querySelector(".navbar-main");
const Navbar = document.querySelector(".navbar-mobile");
const overlay = document.querySelector(".overlay");
const btnClose = document.querySelector(".close-mobile");
// const btnlink = document.querySelector(".link-menu");
const dropdownMenu = document.querySelectorAll(".dropdown-menu-item > li");
    console.log(dropdownMenu)
overlay.addEventListener("click", e => {
    overlay.style.display = "none";
    Navbar.classList.remove("active");
})
iconNavbar.addEventListener('click', e => {
    Navbar.classList.add("active");
    overlay.style.display = "block";
})
btnClose.addEventListener("click", e => {
    overlay.style.display = "none";
    Navbar.classList.remove("active");
})
dropdownMenu.forEach(item =>{
    item.addEventListener("click", e => {
        overlay.style.display = "none";
    Navbar.classList.remove("active");
    })
})

const btnDropdown = document.querySelectorAll('.navbar-mobile-warp .dropdown-menu .btn-dropdown');

btnDropdown.forEach((element,index) => {
    element.addEventListener('click',(e) => {

        if (btnDropdown[index].parentElement.classList.toggle('active')) {
            btnDropdown[index].children[1].classList.remove("fa-plus");
            btnDropdown[index].children[1].classList.add("fa-minus");
        } else {
            btnDropdown[index].children[1].classList.remove("fa-minus");
            btnDropdown[index].children[1].classList.add("fa-plus");
        }
    })
})
// <i class="fas fa-plus icon-plus"></i>
{/* <i class="fas fa-minus icon-minus"></i> */}