$(document).ready(function () {
    $(".dropdown").on("click", function (event) {
        $(".dropdown-content").toggle();
        event.stopPropagation(); // Prevent the event from bubbling up to the document
    });

    $(document).on("click", function (event) {
        if (!$(event.target).closest('.dropdown').length && !$(event.target).closest('.dropdown-content').length) {
            $(".dropdown-content").hide();
        }
    });

    // This code ensures nothing happens when you click on ".dropdown-content"
    $(".dropdown-content").on("click", function (event) {
        event.stopPropagation(); // Prevent the event from bubbling up to the document
    });
});