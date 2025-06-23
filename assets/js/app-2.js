document.addEventListener("DOMContentLoaded", () => {
    const menuButton = document.getElementById('menu-button');
    const closeMenuButton = document.getElementById('close-menu');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuItems = document.getElementById('menu-items');
    const dropdowns = {
        aboutUs: document.getElementById('aboutUs-dropdown'),
        community: document.getElementById('community-dropdown'),
    };

    menuButton.addEventListener('click', () => {
        mobileMenu.classList.remove('hidden');
        document.body.classList.add('overflow-hidden'); // Prevent scrolling
    });

    closeMenuButton.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
        document.body.classList.remove('overflow-hidden'); // Allow scrolling
    });

    // Handle dropdown toggling
    window.toggleDropdown = (key) => {
        for (const k in dropdowns) {
            if (k !== key) {
                dropdowns[k].classList.add('hidden');
            }
        }
        dropdowns[key].classList.toggle('hidden');
    };

    // Close dropdowns when clicking outside
    document.addEventListener('click', (event) => {
        if (!menuItems.contains(event.target) && !mobileMenu.contains(event.target)) {
            for (const k in dropdowns) {
                dropdowns[k].classList.add('hidden');
            }
        }
    });
});
