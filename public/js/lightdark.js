document.addEventListener("DOMContentLoaded", function () {
    const isDarkMode = localStorage.getItem("dark-mode");

    const darkModeToggle = document.getElementById("darkModeToggle");
    const toggleIcon = darkModeToggle.querySelector("i");

    if (isDarkMode === "enabled") {
        document.body.classList.add("dark-mode");
        toggleIcon.classList.remove("fa-sun");
        toggleIcon.classList.add("fa-moon");
    } else {
        toggleIcon.classList.remove("fa-moon");
        toggleIcon.classList.add("fa-sun");
    }

    darkModeToggle.addEventListener("click", function () {
        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            localStorage.setItem("dark-mode", "enabled");
            toggleIcon.classList.remove("fa-sun");
            toggleIcon.classList.add("fa-moon");
        } else {
            localStorage.setItem("dark-mode", "disabled");
            toggleIcon.classList.remove("fa-moon");
            toggleIcon.classList.add("fa-sun");
        }
    });
});    