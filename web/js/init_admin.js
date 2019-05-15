
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#main-sidebar").toggleClass("active");
});
function mybuttondelete(button_id,ss) {
    if (button_id === "noid") {
        var oSource = window.event.srcElement;
        var div_delete = oSource.parentNode;
        var par_div_delete = oSource.parentNode.parentNode;
    } else {
        var par_div_delete = document.getElementsByClassName('div_answers')[0];
        var div_delete = document.getElementsByClassName('new-answer_'+button_id)[0];
    }

    if (ss==3) {
        var sel = div_delete.getElementsByClassName('span_numb_answ')[0].textContent;
        var selected_val = '';
        var iy_1 = 0;
        while (sel[iy_1] !== '.') {
            selected_val = selected_val + sel[iy_1];
            iy_1++;
        }
    }
    par_div_delete.removeChild(div_delete);

    if (ss==3){
        var spans = document.getElementsByClassName('span_numb_answ');
        var one_tr=0;
        for(var i=0; i<spans.length; i++){
            var numb_answ=spans[i].textContent;
            var nAns='';
            var iy=0;
            while(numb_answ[iy]!=='.'){
                nAns=nAns+numb_answ[iy];
                iy++;
            }
            if ((+nAns)>(+selected_val)){
                spans[i].innerHTML = (+nAns-1)+'. ';
            }
        }
    }
}