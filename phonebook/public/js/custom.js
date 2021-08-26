$('#editContactModal').on('show.bs.modal', function (event) {
    let link = $(event.relatedTarget);
    let modal = $(this);
    let name = link.data("name");
    let phone_number = link.data("number");
    let id = link.data("id");
    modal.find("#editName").val(name);
    modal.find("#editPhoneNumber").val(phone_number);
    modal.find("#contactID").val(id);
});

$('#shareContactModal').on('show.bs.modal', function (event) {
    let link = $(event.relatedTarget);
    let modal = $(this);
    let id = link.data("id");
    modal.find("#contactID").val(id);
});
