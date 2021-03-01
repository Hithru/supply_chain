<!DOCTYPE html>

<body>

<form action="view" method="post">

<p> Select the type of report you wish to view. </p>

<input type="radio" name="type" id="quarterlySales" value="quarterlySales" class="year" required>
<label for="quarterlySales"> Quarterly Sales Report </label><br><br>

<input type="radio" name="type" id="topitems" value="topitems">
<label for="topitems"> Best Selling Items Report </label><br><br>

<input type="radio" name="type" id="sales" value="sales" class="year">
<label for="sales"> Categorized Sales Report </label><br><br>

<input type="radio" name="type" id="hours" value="workinghrs" class="range">
<label for="workinghrs"> Transport Staff Working Hours Report </label><br><br>

<input type="radio" name="type" id="customer" value="customer" class="range">
<label for="customer"> Customer - Orders Report </label><br><br>



<label for="year" class="sel_year">Year: </label>
<select id="year" name="year" class="sel_year"></select> <br><br>

<label for="from" class="sel_range">From: </label> <br>
<input type="date" id="from" name="from" class="sel_range"/>

<label for="to" class="sel_range">To: </label> <br>
<input type="date" id="to" name="to" class="sel_range"/>


<br><br>

<input type="submit" value="Go"/>

</form>

</body>

<script>

    function display(classname,option){
        var elements = document.getElementsByClassName(classname);

        for (var i=0; i<elements.length; i++){
            elements[i].style.display = option;
        }
    }

    var select_year = document.getElementById("year");

    window.onload = function(){
        var current = (new Date()).getFullYear();

        for (var i=current; i>=2019; i--){
            var option = document.createElement("OPTION");
            option.innerHTML = i;
            option.value = i;
            select_year.appendChild(option);
        }
    };


    display("sel_year","None");
    display("sel_range","None");

    var year_reports = document.getElementsByClassName("year");
    var range_reports = document.getElementsByClassName("range");

    for (var i=0; i<year_reports.length; i++){
        year_reports[i].onclick = function(){
            display("sel_year","Block"); display("sel_range","None");
        }
    }

    for (var i=0; i<range_reports.length; i++){
        range_reports[i].onclick = function(){
            display("sel_year","None"); display("sel_range","Block");
        }
    }


</script>