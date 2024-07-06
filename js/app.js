




$(document).ready(function () {
    $("#submissionForm").submit(function (event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "submit_form.php",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                showToast(response.status, response.message);
                $("#submissionForm")[0].reset(); // Reset form after submission
            },
            error: function (xhr, status, error) {
                console.error("Error:", error);
                showToast("error", "An error occurred while submitting the form");
            },
        });
    });

    function showToast(type, message) {
        var toast = $('<div class="toast align-items-center text-white bg-' + type + '" role="alert" aria-live="assertive" aria-atomic="true">' +
                        '<div class="d-flex">' +
                            '<div class="toast-body me-2">' +
                                (type === "success" ? '<i class="ri-check-line"></i>' : '<i class="ri-error-warning-line"></i>') +
                            '</div>' +
                            '<div class="toast-body">' +
                                message +
                            '</div>' +
                        '</div>' +
                    '</div>');

        $(".form-section").append(toast);

        var bootstrapToast = new bootstrap.Toast(toast[0]);
        bootstrapToast.show();

        setTimeout(function () {
            toast.remove();
        }, 3000); // Remove toast after 3 seconds
    }
});
