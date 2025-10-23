import "./bootstrap";
// import Notify from "laravel-notify";
import Toastify from "toastify-js";

// Initialize (optional: you can customize defaults here)
// Notify.init();

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// var channel = window.Echo.channel(`App.Models.User.${userID}`);
// channel.notification(function (data) {
//     console.log(data);
//     alert(data.title);
// });

// var channel = window.Echo.channel(`App.Models.User.${user_id}`);
// channel.listen(".my-event", function (data) {
//     alert(JSON.stringify(data));
// });

var channel = Echo.private(`App.Models.User.${user_id}`);
channel.notification(function (data) {
    // alert(data.title);
    Toastify({
        text: data.title,
        duration: 6000,
        destination: "http://127.0.0.1:8000/dashboard/orders",
        newWindow: true,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "right", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: "linear-gradient(to right, #00b09b, #96c93d)",
        },
        onClick: function () {}, // Callback after click
    }).showToast();
});
