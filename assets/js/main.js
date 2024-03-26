let arrow_icon = document.querySelectorAll(".arrow_img");
let nav_dropdown_one = document.querySelector(".nav_links_dropdown_one")
let nav_dropdown_two = document.querySelector(".nav_links_dropdown_two")


arrow_icon.forEach(element => {
    element.addEventListener('click' , handleClick)
});

function handleClick()
{
    nav_dropdown_one.classList.toggle("active");
    nav_dropdown_one.style.animation = "none";
}