// Cookie Popup Script
function add_cookie_popup_script() {
    // Only show popup on pages, not posts
    if (is_page()) {
        ?>
        <style>
            /* Cookie Popup Styling */
            #cookie-popup {
                display: none; /* Initially hidden */
                position: fixed;
                bottom: 20px;
                left: 20px;
                right: 20px;
                background: #ffffff; /* White background */
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15); /* Subtle shadow */
                padding: 20px;
                max-width: 600px;
                margin: 0 auto;
                font-family: 'Arial', sans-serif;
                z-index: 9999;
                border: 2px solid #cccccc; /* Light gray border for better contrast */
                transform: translateY(100%); /* Hidden initially */
                opacity: 0; /* Invisible initially */
                transition: transform 0.5s ease, opacity 0.5s ease; /* Smooth slide-in */
                word-wrap: break-word; /* Prevent overlapping text */
                overflow: hidden; /* Prevent content overflow */
            }

            #cookie-popup.show {
                display: block;
                transform: translateY(0); /* Slide in */
                opacity: 1; /* Fully visible */
            }

            #cookie-popup p {
                margin: 0 0 10px;
                font-size: 14px;
                color: #333333;
                line-height: 1.5;
                word-break: break-word; /* Break long words gracefully */
            }

            /* Link Styling */
            #cookie-popup a {
                color: #004488; /* Link color */
                text-decoration: none; /* Remove underline */
                font-weight: bold;
                transition: color 0.3s ease;
            }

            #cookie-popup a:hover {
                color: #002244;
                text-decoration: none; /* Ensure no underline on hover */
            }

            /* Accept Button Styling */
            #cookie-popup .accept-btn {
                background: linear-gradient(135deg, #00b09b, #96c93d); /* Premium gradient */
                color: #ffffff; /* White text */
                padding: 12px 30px;
                font-size: 16px;
                font-weight: bold;
                border: none;
                border-radius: 25px; /* Pill shape */
                cursor: pointer;
                transition: background 0.3s ease, transform 0.2s ease, box-shadow 0.3s ease;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15); /* Elegant shadow */
            }

            #cookie-popup .accept-btn:hover {
                background: linear-gradient(135deg, #009e88, #82b835); /* Hover gradient */
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.25); /* Stronger shadow */
                transform: scale(1.1); /* Slight zoom */
            }

            /* Close Button Styling */
            #cookie-popup .close-btn {
                position: absolute;
                top: 10px;
                right: 15px;
                width: 30px;
                height: 30px;
                background: linear-gradient(135deg, #e0e0e0, #f7f7f7); /* Premium gradient background */
                color: #444444; /* Neutral text color */
                border: 2px solid #cccccc; /* Subtle border */
                border-radius: 50%; /* Circular shape */
                cursor: pointer;
                font-weight: bold;
                font-size: 18px; /* Adjusted size */
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow for depth */
                transition: all 0.3s ease;
                z-index: 10001; /* Ensure it is always on top */
            }

            #cookie-popup .close-btn:hover {
                background: linear-gradient(135deg, #ff6666, #ff4d4d); /* Premium hover gradient */
                color: #ffffff; /* White text color on hover */
                box-shadow: 0 6px 12px rgba(255, 77, 77, 0.4); /* Glow effect */
                transform: scale(1.1); /* Slight zoom */
            }

            /* Responsive Design */
            @media screen and (max-width: 450px) {
                #cookie-popup {
                    bottom: 15px;
                    left: 10px;
                    right: 10px;
                    max-width: calc(100% - 20px); /* Ensure it doesn't overflow */
                    padding: 15px;
                }

                #cookie-popup p {
                    font-size: 13px;
                    line-height: 1.4;
                    margin-right: 50px; /* Prevent overlapping with close button */
                }

                #cookie-popup .accept-btn {
                    padding: 10px 20px;
                    font-size: 14px;
                }

                #cookie-popup .close-btn {
                    top: 8px;
                    right: 8px;
                    width: 28px;
                    height: 28px;
                    font-size: 16px;
                }
            }

            @media screen and (min-width: 451px) and (max-width: 900px) {
                #cookie-popup {
                    bottom: 20px;
                    left: 10%;
                    right: 10%;
                    max-width: 80%;
                    padding: 20px;
                }

                #cookie-popup p {
                    font-size: 15px;
                    line-height: 1.6;
                    margin-right: 60px;
                }

                #cookie-popup .accept-btn {
                    padding: 12px 25px;
                    font-size: 15px;
                }

                #cookie-popup .close-btn {
                    top: 12px;
                    right: 12px;
                    width: 30px;
                    height: 30px;
                    font-size: 16px;
                }
            }
        </style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cookieConsent = localStorage.getItem("cookieConsent");
        const cookieDismiss = localStorage.getItem("cookieDismiss");
        const currentURL = window.location.href;
        const privacyPolicyURL = "https://insightzing.com/privacy-policy/";

        // If no consent or dismiss action has been taken, show the popup
        if (!cookieConsent && !cookieDismiss) {
            const cookiePopup = document.createElement("div");
            cookiePopup.id = "cookie-popup";
            cookiePopup.innerHTML = `
                <span class="close-btn" id="close-popup">&times;</span>
                <p>We use cookies to provide you with the best experience.
                ${currentURL !== privacyPolicyURL ? `<a href="${privacyPolicyURL}" target="_blank" id="learn-more">Learn More</a>` : ""}</p>
                <button class="accept-btn" id="accept-cookies">Accept</button>
            `;
            document.body.appendChild(cookiePopup);

            setTimeout(() => {
                document.getElementById("cookie-popup").classList.add("show");
            }, 500);

            // Accept button behavior
            document.getElementById("accept-cookies").addEventListener("click", function () {
                localStorage.setItem("cookieConsent", "accepted");
                document.getElementById("cookie-popup").classList.remove("show");
                setTimeout(() => document.getElementById("cookie-popup").remove(), 500);
            });

            // Close button behavior
            document.getElementById("close-popup").addEventListener("click", function () {
                localStorage.setItem("cookieDismiss", "dismissed");
                setTimeout(() => document.getElementById("cookie-popup").remove(), 500);
            });

            // Link click behavior
            const learnMoreLink = document.getElementById("learn-more");
            if (learnMoreLink) {
                learnMoreLink.addEventListener("click", function () {
                    learnMoreLink.style.color = "#ff6600"; // Premium color
                    learnMoreLink.style.fontSize = "16px"; // Slightly larger font size
                    setTimeout(() => {
                        learnMoreLink.style.color = ""; // Reset color
                        learnMoreLink.style.fontSize = ""; // Reset font size
                    }, 5000); // Remove effect after 5 seconds
                });
            }
        }
    });
</script>

        <?php
    }
}
add_action('wp_footer', 'add_cookie_popup_script');
