(function ($) {
    $(".item-quantity").on("change", function (e) {
        $.ajax({
            url: "/cart/" + $(this).data("id"), // data-id
            method: "put",
            data: {
                quantity: $(this).val(),
                _token: csrf_token,
            },
        });
    });

    $(".remove-item").on("click", function (e) {
        let id = $(this).data("id");
        $.ajax({
            url: "/cart/" + id,
            method: "delete",
            data: {
                _token: csrf_token,
            },
            success: (response) => {
                $(`#${id}`).remove();
            },
        });
    });

    $(".add-to-cart").on("click", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        let quantity = $("#quantity").val(); // Get quantity from the select dropdown

        $.ajax({
            url: "/cart",
            method: "post",
            data: {
                product_id: id,
                quantity: quantity,
                _token: csrf_token,
            },
            success: (response) => {
                alert("Product added to cart successfully!");
                // Optional: Update cart count or show success message
                console.log("Product added:", response);
            },
            error: (xhr, status, error) => {
                alert("Error adding product to cart. Please try again.");
                console.error("Error:", error);
            },
        });
    });
})(jQuery);
