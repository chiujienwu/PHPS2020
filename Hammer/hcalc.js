$(document).ready(function(){
    // Add minus icon for collapse element which is open by default
    $(".collapse.show").each(function(){
        $(this).siblings(".card-header").find(".btn i").html("remove");
    });

    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
        $(this).parent().find(".card-header .btn i").html("remove");
    }).on('hide.bs.collapse', function(){
        $(this).parent().find(".card-header .btn i").html("add");
    });
});

//enter condition to make sure form is valid before opening modal