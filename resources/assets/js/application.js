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
$(function() {
    $('img').addClass('img-responsive');
    $('iframe[src*="youtube.com"]').each(function() {
        $(this).parent("p").append($("<div></div>").addClass("flex-video").append($(this)));
    });
});
     