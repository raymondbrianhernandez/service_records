function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input   = document.getElementById("search");
    filter  = input.value.toUpperCase();
    table   = document.getElementById("address-table");
    tr      = table.getElementsByTagName("tr");
  
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
  
$(function() {
    $("td[colspan=7]").find("p").hide();
    $("table").click(function(event) {
        event.stopPropagation();
        var $target = $(event.target);
        
        if ( $target.closest("td").attr("colspan") > 1 ) {
            $target.slideUp();
        } else {
            /* $target.closest("tr").next().find("p").slideToggle(); */
            var $p = $target.closest("tr").next().find("p");
            $p.slideToggle();
            $("td[colspan] p").not($p).slideUp();
        }                    
    });
});