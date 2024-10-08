const hamburger = document.querySelector("#toggle-btn");

hamburger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
    document.querySelector(".main").classList.toggle("expand");
});

$(document).ready(function () {
    const curPage = document.URL;
    const links = document.getElementsByTagName("a");
    for (let link of links) {
        if (link.href == curPage) {
            link.classList.add("active");
        }
    }
});