function changeId(id) {
    var idOrder = document.getElementById("id-change");
    // id.innerHTML = id;
    idOrder.innerHTML = id;
    // console.log(idOrder);
}

function payment() {
    var paymentStatus = document.getElementById("payment-status").value;
    console.log(paymentStatus);
}

function editPayment() {
    var paymentStatus = document.getElementById("payment-status").value;
    var idOrder = document.getElementById("id-change").innerHTML;
    let token = $('meta[name="csrf-token"]').attr("content");
    var data = {
        paymentStatus: paymentStatus,
        idOrder: idOrder,
        _token: token,
    };

    console.log(data);

    // console.log(csrfToken);
    $.ajax({
        type: "POST",
        url: "orders/edit",
        data: data,
        success: function (response) {
            // console.log(response);
            if (response == "1") {
                alert("Edit Success");
                window.location.href = "orders";
            }
        },
    });
    // console.log(idOrder);
}
