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
//function for displaying the results in the dropdown menu
function dropdownDisplayResults(source)
{
    const dropdown=document.querySelector(".search-container.dropdown .dropdown-content");
    //clears previous results
    dropdown.innerHTML=`<li class="dropdown-item-container"><a class="dropdown-a no-link-style" href="courses.php?filter=${searchInput.value}">Search all...</a></li>`;
    //only shows the first 10 results
    for (let i=0; i<10; i++)
    {
        if (!source[i].name.toLowerCase().includes(document.getElementById("searchInput").value.toLowerCase())) continue;
        dropdown.insertBefore(newItem=document.createElement("li"), dropdown.lastChild);
        newItem.classList.add("dropdown-item-container");
        newItem.innerHTML=`<a class="dropdown-a no-link-style" href="course.php?id=${source[i].id}">${source[i].name}</a>`;
    }
}

// Attach the filterCourses function to the input event
//document.getElementById('searchInput').addEventListener('input', filterCourses);