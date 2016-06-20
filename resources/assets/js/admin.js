function editor_init(selector){
    tinymce.init({
        selector: selector,
        theme: "modern",
        menubar : false,
        relative_urls: false,
        forced_root_block: false, // Start tinyMCE without any paragraph tag
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars media nonbreaking",
             "table contextmenu directionality paste textcolor code localautosave"
        ],
        toolbar1: "localautosave | bold italic underline hr",
        entity_encoding: "raw",
        directionality : "rtl",
        language: "ar"
   });    
}
var hash = 0;
function links(data = null, template) {
    var $newPanel = template.clone();
    $newPanel.find(".collapse").removeClass("in");
    $newPanel.find(".accordion-toggle").attr("href", "#" + (++hash)).text("رابط #" + hash);

    var count = $("#accordion").children().length;
    var proto = $("#accordion").data('prototype').replace(/__NAME__/g, count);

    $newPanel.find(".panel-collapse").attr("id", hash);

    $newPanel.find('.panel-body').empty().append(proto);
                    // replace sessions data
    if(data){

        $.each(data, function(index, value){
            $newPanel.find("#" + index).val(value); 
        })    
        $newPanel.find(".accordion-toggle").text($newPanel.find("#type option:selected").text());
    }
    $("#accordion").append($newPanel.fadeIn());
}
$(function() {
    $('input[type=date]').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight: true
    });

    $('#color').colorpicker().on('changeColor.colorpicker', function(event){
        $(this).css('background-color', event.color.toHex());
    });

    if( !$('input[type=date]').val() ) {
        $('input[type=date]').datepicker("setDate", new Date());
    }
});