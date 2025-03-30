document.addEventListener("DOMContentLoaded", function () {
    let successAlert = document.querySelector('meta[name="success"]')?.content;
    let successTimer = document.querySelector(
        'meta[name="success_timer"]'
    )?.content;
    let error = document.querySelector('meta[name="error"]')?.content;
    let errors = JSON.parse(
        document.querySelector('meta[name="errors"]')?.content || "[]"
    );

    if (successAlert) {
        Swal.fire({
            title: successAlert,
            icon: "success",
        });
    }

    if (successTimer) {
        Swal.fire({
            title: successTimer,
            icon: "success",
            showConfirmButton: false,
            timer: 1500,
        });
    }

    if (error) {
        Swal.fire({
            title: error,
            icon: "error",
        });
    }

    if (errors.length > 0) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            html:
                "<ul>" + errors.map((e) => `<li>${e}</li>`).join("") + "</ul>",
            confirmButtonText: "OK",
        });
    }
});
