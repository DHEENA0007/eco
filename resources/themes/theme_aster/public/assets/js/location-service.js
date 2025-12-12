/**
 * Accurate Indian Pincode Detection System
 *
 * GPS → OSM Reverse Geocode → India Post API → Final Pincode
 * Handles:
 * ✔ Accurate India Pincode (Fixes wrong results like 638654)
 * ✔ Error handling
 * ✔ Skip logic
 * ✔ Manual entry fallback
 */

(function () {
    "use strict";

    // Check if pincode is already stored or skipped
    const hasSavedPincode = () => {
        const modal = document.getElementById("locationPermissionModal");
        const serverPin = modal?.getAttribute("data-has-pincode") === "true";
        const localPin = localStorage.getItem("user_pincode") !== null;
        const skipped = sessionStorage.getItem("skipped_location") === "1";
        return serverPin || localPin || skipped;
    };

    // Show modal if not saved
    window.addEventListener("DOMContentLoaded", () => {
        if (!hasSavedPincode()) {
            setTimeout(() => {
                const modal = new bootstrap.Modal(
                    document.getElementById("locationPermissionModal")
                );
                modal.show();

                // Focus on manual input since it's now the primary option
                setTimeout(() => {
                    document.getElementById("manual-pincode")?.focus();
                }, 300);
            }, 1200);
        }
    });

    /**
     * AUTO-DETECT BUTTON (SECONDARY OPTION)
     */
    const allowBtn = document.getElementById("allow-location-btn");

    if (allowBtn) {
        allowBtn.addEventListener("click", () => {
            showLoading();

            if (!navigator.geolocation) {
                showError("Geolocation is not supported. Please enter pincode manually above.");
                return;
            }

            navigator.geolocation.getCurrentPosition(
                async (pos) => {
                    const lat = pos.coords.latitude;
                    const lng = pos.coords.longitude;

                    const pincode = await getAccurateIndianPincode(lat, lng);

                    hideLoading();

                    if (pincode) {
                        showSuccess(pincode);

                        // Auto-fill the input field
                        const input = document.getElementById("manual-pincode");
                        input.value = pincode;
                        input.focus();
                        input.select();
                    } else {
                        showError("Could not detect correct pincode. Please enter manually above.");
                    }
                },
                (err) => {
                    let msg = "Unable to detect location. Please enter pincode manually above.";

                    if (err.code === 1) msg = "Location permission denied. Please enter pincode manually above.";
                    if (err.code === 2) msg = "Location unavailable. Please enter pincode manually above.";
                    if (err.code === 3) msg = "Location timeout. Please enter pincode manually above.";

                    showError(msg);
                }
            );
        });
    }

    /**
     * Accurate Indian Pincode Detection
     */
    async function getAccurateIndianPincode(lat, lng) {
        try {
            // Step 1 — Reverse Geocode
            const osm = await fetch(
                `https://nominatim.openstreetmap.org/reverse?format=json&addressdetails=1&lat=${lat}&lon=${lng}`,
                {
                    headers: { "User-Agent": "Laravel-Ecommerce-App" },
                }
            );

            const data = await osm.json();

            const area =
                data?.address?.suburb ||
                data?.address?.village ||
                data?.address?.town ||
                data?.address?.city ||
                data?.address?.hamlet ||
                data?.address?.locality;

            if (!area) return null;

            // Step 2 — India Post API (Accurate Pincode Source)
            const post = await fetch(
                `https://api.postalpincode.in/postoffice/${area}`
            );
            const p = await post.json();

            if (p[0]?.Status === "Success") {
                return p[0].PostOffice[0].Pincode; // First correct result
            }

            return null;
        } catch (e) {
            console.error("PINCODE ERROR:", e);
            return null;
        }
    }

    /**
     * Manual Pincode Form
     */
    const form = document.getElementById("manual-pincode-form");

    if (form) {
        form.addEventListener("submit", (e) => {
            e.preventDefault();

            const pin = document.getElementById("manual-pincode").value.trim();

            if (!/^\d{6}$/.test(pin)) {
                toastr.error("Enter a valid 6-digit pincode.");
                return;
            }

            const btn = form.querySelector("button[type=submit]");
            const original = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2"></span>Saving...';

            savePincode(pin)
                .then(() => {
                    localStorage.setItem("user_pincode", pin);

                    toastr.success("Pincode saved!");

                    setTimeout(() => location.reload(), 800);
                })
                .catch((err) => {
                    toastr.error(err.message || "Failed to save.");
                    btn.disabled = false;
                    btn.innerHTML = original;
                });
        });
    }

    function savePincode(pin) {
        return fetch("/customer/save-location", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    "meta[name=csrf-token]"
                ).content,
            },
            body: JSON.stringify({ pincode: pin }),
        })
            .then((r) => r.json())
            .then((d) => {
                if (!d.success) throw new Error(d.message);
                return d;
            });
    }

    /**
     * Skip Button
     */
    document
        .getElementById("skip-location-btn")
        ?.addEventListener("click", () => {
            sessionStorage.setItem("skipped_location", "1");
        });

    /**
     * UI functions
     */
    function showLoading() {
        const btn = document.getElementById("allow-location-btn");
        btn.disabled = true;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Detecting...';
        
        document.getElementById("location-loading").classList.remove("d-none");
        document.getElementById("location-error").classList.add("d-none");
        document.getElementById("location-success").classList.add("d-none");
    }

    function hideLoading() {
        const btn = document.getElementById("allow-location-btn");
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-crosshair me-2"></i>Auto Detect Location';
        
        document.getElementById("location-loading").classList.add("d-none");
    }

    function showSuccess(pin) {
        document.getElementById("location-success").classList.remove("d-none");
        document.getElementById("detected-pincode").textContent = pin;
    }

    function showError(msg) {
        hideLoading();
        document.getElementById("location-error").classList.remove("d-none");
        document.getElementById("location-error-message").textContent = msg;
    }
})();
