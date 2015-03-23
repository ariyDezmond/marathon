names = ["Oleg","Petr","Elena","Eugeniy","Vitaly","Aleksandr","Dmitriy","Fignya","Lol"];
surnames = ["Olegov","Petrov","Vasiliev","Fedotov","Makarych","Aleksandrov","Dmitriev","Fignyaev","Lolov"];
genders = ["male","female"];
bDates = ["1985-11-25","1984-10-15","1975-01-05","1984-06-03","1993-04-12","1991-05-23","1965-11-25"];

function random(min,max)
{
	return Math.round(min-0.5+Math.random( ) * (max-min+1));
	//return Math.floor(Math.random()*(min-min+max+1));
}

// ficha for fun, something like bot :)
function bot(){
	name = names[random(0,names.length-1)];
	surname = surnames[random(0,surnames.length-1)];
	bDate = bDates[random(0,bDates.length-1)];
	gender = genders[random(0,genders.length-1)];
	$('input').each(function(){
    if($(this).attr('type')=='reset') return;    //
    	if($(this).attr('name') == 'name')
    		$(this).val(name);
    	else if($(this).attr('name') == 'surname')
    		$(this).val(surname);
    	else if($(this).attr('name') == 'bDate')
    		$(this).val(bDate);
    	else if($(this).attr('name') == 'email')
    		$(this).val(name+'@'+surname+'.com');
    	else if($(this).attr('name') == 'tel')
    		$(this).val(random(111111,999999));
    	else if($(this).attr('name') == 'distantion')
    		$(this).val(random(1,5));
    });
}

// function, which sent data of competitors to server via ajax
function save()
{
	name      = $('#name').val();
	surname   = $('#surname').val();
	bDate      = $('#bDate').val();
	email     = $('#email').val();
	tel       = $('#tel').val();
	country   = $('#country').val();
	distance  = $('#distance').val();
	gender    = $('input:radio:checked').val();

    var data = $("form").serialize();
    alert(data);
	$.ajax({
		type    : "POST",
		url     : site+"/save",
        data    : data,
		success : function(data){
            console.log(data);
			if(data=="1")
                $("#out").removeClass("alert alert-danger")
                         .addClass("alert alert-success")
                         .text("Runner is successfully added!")
                         .show(1000)
                         .delay(2000)
                         .hide(1000);
            else
                $("#out").removeClass("alert alert-success")
                         .addClass("alert alert-danger")
                         .text("Error!")
                         .show(1000)
                         .delay(2000)
                         .hide(1000);
		}
	});
}

function getCountries()
{
    $.ajax({
        type    : "POST",
        url     : site+"/runner/country",
        success : function(data){
            var countries = $.parseJSON(data);
            var $select = $("#country");
            for(i=0;i<countries.length;i++)
                $select.append("<option value='"+countries[i].ID+"'>"+countries[i].cValue+"</option>");
        }
    });
}

function getDistances()
{
    $.ajax({
        type    : "POST",
        url     : site+"/runner/distance",
        success : function(data){
            var distances = $.parseJSON(data);
            var $select = $("#distance");
            for(i=0;i<distances.length;i++)
                $select.append("<option value='"+distances[i].ID+"'>"+distances[i].dValue+"</option>");
        }
    });
}

$(function(){

    $(document).tooltip({
    	delay: 100
    });
    //$("div[class*='primary'").draggable();
    $('#radio').buttonset();
    $('#tabs').tabs();
    $('#bDate').datepicker({
    	changeMonth: true,
    	changeYear: true,
    	minDate: "-80Y",
    	maxDate: "-15Y",
    	dateFormat: "yy-mm-dd"
    });
    $('#bot').click(function(){
    	bot();
        return false;
    });

    $('form').submit(function(event){
    	$(this).find("input").each(function(){
    		if(!$(this).val().length)
    		{
    			$(this).parent()
    				   .append("<span class='input-group-addon'>Fill this field</span>")
    				   .next()
    				   .css("color","red")
    				   .end()
    				   .children(".input-group-addon")
    				   .css("color","red");
    			event.preventDefault();
    		}

    	})
    });

   $('input,select').bind({
        focus : function(){
        	       $(this).parent()
        		   .children(".input-group-addon")
        		   .animate({"color":"#66AFE9"});
                },
        blur:   function(){
        	       $(this).parent()
        		   .children(".input-group-addon")
        		   .animate({"color":"#555555"});
                }
    });

    $('#save').click(function(){
    	save();
        return false;
    });

    // autofocus
	

    $("td").click(function(){
        $(this).data("value");
    });

    if($("form").is(".lol"))
    {
        $("#name").focus();
        console.log("Yes");
        po_enter(lol);
        getCountries();
        getDistances();
        $('#gender').bind({
            keypress : function(e){
                if(e.keyCode==13)
                    save();
            }
        })
    }
    else
    {
        console.log("no");
    }
});