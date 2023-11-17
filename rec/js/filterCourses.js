// Function to filter courses based on search input
function filterCourses() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const courses = document.getElementById('coursesContainer').getElementsByClassName('course-card');

    for (let course of courses) {
        const courseName = course.querySelector('h3').innerText.toLowerCase();

        if (courseName.includes(searchInput)) {
            course.style.display = 'block';
        } else {
            course.style.display = 'none';
        }
    }
}

// Attach the filterCourses function to the input event
document.getElementById('searchInput').addEventListener('input', filterCourses);