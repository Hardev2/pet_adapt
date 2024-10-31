document.addEventListener('DOMContentLoaded', function() {
    // Get all links within nav-links
    const navLinks = document.querySelectorAll('.nav-links > li > a');

    navLinks.forEach(link => {
        // Check if the link has a dropdown menu as its next sibling
        const dropdown = link.nextElementSibling;

        // If it has a dropdown, make it toggle
        if (dropdown && dropdown.classList.contains('dropdown')) {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Only prevent default for dropdown toggles

                // Toggle the current dropdown's visibility
                dropdown.classList.toggle('active');
                dropdown.style.maxHeight = dropdown.classList.contains('active') ? '200px' : '0';

                // Close other open dropdowns
                document.querySelectorAll('.dropdown.active').forEach(openDropdown => {
                    if (openDropdown !== dropdown) {
                        openDropdown.classList.remove('active');
                        openDropdown.style.maxHeight = '0';
                    }
                });
            });
        }
    });
});
