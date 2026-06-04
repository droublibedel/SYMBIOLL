document.addEventListener("DOMContentLoaded", () => {
    const elements = document.querySelectorAll(
        ".hero-content, .section h2, .card, .project-card, .cta h2, .cta p, .contact-card, .about-block"
    );

    elements.forEach((element) => {
        element.classList.add("reveal");
    });

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                }
            });
        },
        {
            threshold: 0.12
        }
    );

    elements.forEach((element) => {
        observer.observe(element);
    });

    const navbar = document.querySelector(".navbar");

    window.addEventListener("scroll", () => {
        if (window.scrollY > 40) {
            navbar.style.background = "rgba(5, 5, 5, 0.86)";
            navbar.style.boxShadow = "0 18px 50px rgba(0,0,0,0.3)";
        } else {
            navbar.style.background = "rgba(5, 5, 5, 0.62)";
            navbar.style.boxShadow = "none";
        }
    });

    const heroGlow = document.querySelector(".hero-glow");

    if (heroGlow) {
        window.addEventListener("mousemove", (event) => {
            const x = event.clientX / window.innerWidth - 0.5;
            const y = event.clientY / window.innerHeight - 0.5;

            heroGlow.style.transform = `translate(${x * 40}px, ${y * 40}px)`;
        });
    }
});