// Function to animate progress bars
document.addEventListener("DOMContentLoaded", function() {
    const progressBars = document.querySelectorAll('.progress');
    progressBars.forEach(bar => {
        const percent = bar.getAttribute('data-percent');
        bar.style.width = percent + '%';
    });
});


