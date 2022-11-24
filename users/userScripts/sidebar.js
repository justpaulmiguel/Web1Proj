(() => {
    const menuBar = document.querySelector("#menu-icon");
    const sideBar = document.querySelector("aside");

    menuBar.addEventListener("click", () => {
        sideBar.classList.toggle("menu-closed");
    });

    const adjustSidebar = () => {
        if (window.innerWidth <= 700) sideBar.classList.add("menu-closed");
        else sideBar.classList.remove("menu-closed");
    };
    window.addEventListener("resize", adjustSidebar);
    window.addEventListener("load", adjustSidebar);
})();