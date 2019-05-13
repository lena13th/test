
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#main-sidebar").toggleClass("active");
});
function mybuttondelete(button_id) {
    console.log(button_id);
    if (button_id === undefined) {
        var oSource = window.event.srcElement;
        var div_delete = oSource.parentNode;
        var par_div_delete = oSource.parentNode.parentNode;
        par_div_delete.removeChild(div_delete);

    } else {
        var par_div_delete = document.getElementsByClassName('div_answers')[0];
        var div_delete = document.getElementsByClassName('new-answer_'+button_id)[0];
        par_div_delete.removeChild(div_delete);
    }
}