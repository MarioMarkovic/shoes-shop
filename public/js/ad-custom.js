$(function () {
    $("#btnAdd").bind("click", function () {
        var div = $("<tr />");
        div.html(GetDynamicTextBox(""));
        $("#TextBoxContainer").append(div);
    });
    $("body").on("click", ".remove", function () {
        $(this).closest("tr").remove();
    });
});
function GetDynamicTextBox(value) {
    return '<td><input name="size[]" type="number" class="form-control" required min="10" max="55"/></td><td><input name="quantity[]" type="number" class="form-control" required min="0"/></td><td><button type="button" class="btn btn-danger remove">Remove</button></td>'
}