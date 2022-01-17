const hamburger = document.querySelector("#hamburger");
console.log(hamburger);
const menu_bar = document.querySelector("#menu-bar");
console.log(menu_bar);
const main_page = document.querySelector("#main-page");
console.log(main_page);

hamburger.addEventListener("click", event => {
    menu_bar.classList.toggle("open");
    main_page.classList.toggle("open");
    event.stopPropagation();
});