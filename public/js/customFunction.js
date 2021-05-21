function sweetAlertToastr(type, message = "") {
    Swal.fire({
        toast: true,
        position: "top-right",
        iconColor: "#fff",
        customClass: {
            popup: "colored-toast",
        },
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        icon: type,
        text: message,
    });
}