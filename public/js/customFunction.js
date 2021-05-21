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

function api_url(value = '') {
    if (value == '') {
        return "http://localhost:8000/api/";
    } else {
        return "http://localhost:8000/api/" + value;
    }

}
function base_url(value = '') {
    if (value == '') {
        return "http://localhost:8000/";
    } else {
        return "http://localhost:8000/" + value;
    }

}