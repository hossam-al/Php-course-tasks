document.addEventListener("DOMContentLoaded", function() {
    let btnclose = document.querySelector(".btn-close");
    if (btnclose) {
        btnclose.addEventListener("click", function() {
            location.replace("http://localhost/Php-course-tasks/TASK-5%20CRUD/index.php");
        });
    } 
});
