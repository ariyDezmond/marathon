function getCountriesE($edit,content)
{
	var country = "<select id='country' class='form-control' name='country'>";
	var contentId;
    $.ajax({
        type    : "POST",
        url     : site+"/runner/country",
        success : function(data){
            var countries = $.parseJSON(data);
            for(i=0;i<countries.length;i++)
               country +="<option value='"+countries[i].cValue+"'>"+countries[i].cValue+"</option>";
           	country+="</select>";
           	$(country).find("option[value='"+content+"']")
           			  .attr("selected","selected");
           	$(country).val(content)
           			  .appendTo($edit)
           			  .focus()
           			  .blur(function(e){
           			  	$edit.trigger('blur');
           			  });
        }
    });
}

function getDistancesE($edit,content)
{
	var distance ="<select id='distance' class='form-control' name='distance'>";
    $.ajax({
        type    : "POST",
        url     : site+"/runner/distance",
        success : function(data){
            var distances = $.parseJSON(data);
            for(i=0;i<distances.length;i++)
                distance+="<option value='"+distances[i].dValue+"'>"+distances[i].dValue+"</option>";
            distance+="</select>";
            $(distance).find("option[value='"+content+"']")
            		  .attr("selected","selected");
           	$(distance).val(content)
           			  .appendTo($edit)
           			  .focus()
           			  .blur(function(e){
           			  	$edit.trigger('blur');
           			  });
        }
    });

    return distance;
}

$(function(){

	if($('div').is('.group'))
	{

	}

	$('.editable').bind({
		dblclick : function(e){
			// saving html object which is editing in var
			var $edit = $(this);

			// check if this element had already edited
			if($edit.hasClass("active-inline"))
				return;

			//saving value of editing element
			var content = $.trim($edit.text());
			// add class that mean that element is editing now and clear his value
			$edit.addClass("active-inline")
				   .empty();
			var editing="";
			if($edit.hasClass("select-country"))
			{
				getCountriesE($edit,content);
				return;
			}
			else if($edit.hasClass("select-distance"))
			{
				getDistancesE($edit,content);
				return;
			}
            else if($edit.hasClass("select-gender"))
            {
            	editing = "<select id='gender' class='form-control' name='gender'>"+
                   		 	"<option value='мужской'>мужской</option>"+
                   		 	"<option value='женский'>женский</option>"+
                   		   "</select>";
                $(editing).find("option[value='"+content+"']").attr("selected","selected");
            }
            else
            {
            	editing = "<input type='text' class='form-control'>";
            	$(editing).val(content)
            }
            console.log(editing);
			$(editing).val(content)
					  .attr("old",content)
					  .appendTo($edit)
					  .focus()
					  .blur(function(e){
					  	$edit.trigger('blur');
					  });
		},
		keypress:function(e)
		{
			if(e.keyCode==13)
			{
				var $edit = $(this);
				var edited      = $edit.find(":first-child").val();
				var content  = $edit.find(":first-child").attr('old');
				var editedField = $edit.attr("name");
				//console.log(editedField);
	
				// find element which contains id of competitors
				var id = $edit.parent().find("td[name='ID']").text();
				console.log("old variant "+content);
				data = "id="+id+"&field="+editedField+"&value="+edited+"&old="+content;
				
				// sending edited value to server
				$.ajax({
					type : "POST",
					url  : site+"/save/edit",
					data : data,
					beforeSend: function()
            		{
            		    $edit.children()
            		         .replaceWith("<div class='progress progress-striped active'>"+
  											"<div class='progress-bar' role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>"+
  											"</div>"+
										  "</div>");
            		},
					success: function(data){
						console.log(data);
						$edit.removeClass('active-inline')
							 .children().replaceWith(edited);
					}
				});
			}
		},
		blur : function(e){
			var $edit = $(this);
			var edited      = $edit.find(":first-child").val();
			var content  = $edit.find(":first-child").attr('old');
			var editedField = $edit.attr("name");
			console.log(editedField);

			// find element which contains id of competitors
			var id = $edit.parent().find("td[name='ID']").text();
			console.log("old variant "+content);
			data = "id="+id+"&field="+editedField+"&value="+edited+"&old="+content;
			
			// sending edited value to server
			$.ajax({
				type : "POST",
				url  : site+"/save/edit",
				data : data,
				beforeSend: function()
            	{
            	    $edit.children()
            	         .replaceWith("<div class='progress progress-striped active'>"+
  											"<div class='progress-bar' role='progressbar' aria-valuenow='45' aria-valuemin='0' aria-valuemax='100' style='width: 100%'>"+
  											"</div>"+
										  "</div>");
            	},
				success: function(data){
					console.log(data);
					$edit.removeClass('active-inline')
						 .children().replaceWith(edited);
				}
			});
		}
	})
})