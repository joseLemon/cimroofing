/*$('.dropdown-menu a').click(function(){
 activateDropdownLinks();
 });*/


$(".dropdown-menu").on("click", "li", function(){
    activateDropdownLinks();
});

function activateDropdownLinks(){
    var activeID = $('.section.active').attr('id');
    $('.dropdown-menu a').removeClass('active dropdown-image');
    switch(activeID){
        case 'compania1':
            $('.dropdown-menu a:eq(0)').addClass('active dropdown-image');
            break;
        case 'compania2':
            $('.dropdown-menu a:eq(0)').addClass('active dropdown-image');
            break;
        case 'compania3':
            $('.dropdown-menu a:eq(0)').addClass('active dropdown-image');
            break;
        case 'fabricantes':
            $('.dropdown-menu a:eq(1)').addClass('active dropdown-image');
            break;
        case 'responsabilidad':
            $('.dropdown-menu a:eq(2)').addClass('active dropdown-image');
            break;
        case 'certificaciones':
            $('.dropdown-menu a:eq(3)').addClass('active dropdown-image');
            break;
        case 'empleos':
            $('.dropdown-menu a:eq(4)').addClass('active dropdown-image');
            break;
        case 'impermeabilizacion':
            $('.dropdown-menu a:eq(0)').addClass('active dropdown-image');
            break;
        case 'renovacion':
            $('.dropdown-menu a:eq(1)').addClass('active dropdown-image');
            break;
        case 'reemplazo':
            $('.dropdown-menu a:eq(2)').addClass('active dropdown-image');
            break;
        case 'reparacion':
            $('.dropdown-menu a:eq(3)').addClass('active dropdown-image');
            break;
        case 'mantpreventivo':
            $('.dropdown-menu a:eq(4)').addClass('active dropdown-image');
            break;
        case 'inspeccion':
            $('.dropdown-menu a:eq(5)').addClass('active dropdown-image');
            break;
        case 'contrato':
            $('.dropdown-menu a:eq(6)').addClass('active dropdown-image');
            break;
        default:
            $('.dropdown-menu a').removeClass('active dropdown-image');
            break;
    }
}

$('.navbar-collapse').on('show.bs.collapse', function () {
    $('.navbar').addClass('open');
});

$('.navbar-collapse').on('hide.bs.collapse', function () {
    $('.navbar').removeClass('open');
});

$('.carousel').carousel({
    interval: 7000
});

$('ul.dropdown-menu').on('click', function(event){
    // The event won't be propagated up to the document NODE and
    // therefore delegated events won't be fired
    event.stopPropagation();
});



            function UpdateTableHeaders() {
                $(".persist-area").each(function() {

                    var el             = $(this),
                        offset         = el.offset(),
                        scrollTop      = $(window).scrollTop(),
                        floatingHeader = $(".floatingHeader", this)

                    if ((scrollTop > offset.top) && (scrollTop < offset.top + el.height())) {
                        floatingHeader.css({
                            "visibility": "visible"
                        });
                    } else {
                        
                        floatingHeader.css({
                            "visibility": "hidden"
                        });      
                    };
                });
            }

            // DOM Ready      
            $(function() {

                var clonedHeaderRow;

                $(".persist-area").each(function() {
                    clonedHeaderRow = $(".persist-header", this);
                    clonedHeaderRow
                        .before(clonedHeaderRow.clone())
                        .css("width", clonedHeaderRow.width())
                        .addClass("floatingHeader");

                });

                $(window)
                    .scroll(UpdateTableHeaders)
                    .trigger("scroll");

            });
    