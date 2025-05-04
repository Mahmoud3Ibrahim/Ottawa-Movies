// Authors: Mahmoud Ibrahim, Sharmarke Yusuf, Mustafa Tareki
// Section: 321, Course: CST8285 Web Programming, Assignment 02: Ottawa Movies

// This code adds carousel functionality to scroll the movie grid left or right when buttons are clicked.

document.addEventListener('DOMContentLoaded', () => {
    // Get carousel elements
    const movieGrid = document.getElementById('movieGrid');
    const leftBtn = document.querySelector('.carousel-btn.left');
    const rightBtn = document.querySelector('.carousel-btn.right');
    const scrollAmount = 300; // Distance to scroll on each click

    // Scroll left when left button is clicked
    leftBtn.addEventListener('click', () => {
        movieGrid.scrollLeft -= scrollAmount;
    });

    // Scroll right when right button is clicked
    rightBtn.addEventListener('click', () => {
        movieGrid.scrollLeft += scrollAmount;
    });
});