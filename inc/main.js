var clickStatus = 0;

$(document).ready(function(){
	
	$("#close").click(function(){
		$("#alert-wrapper").slideToggle(700);
	});
	
	$("#logo").click(function(){
	if(clickStatus == 0){
		menuShow();
		}else{
		menuHide();
		}
	});
});

var map;
var geocoder;
function initialize() {

    geocoder = new google.maps.Geocoder();
  var myOptions = {
    zoom: 8,
    center: new google.maps.LatLng(38.8900, -77.0300),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('content'),
      myOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);


function childAlert(){
	
	$.getJSON("inc/amber.json",  function(data) {
		console.log(data);
    		$("#alert-name").html(data.name); 
    		$("#alert-height").html(data.height);  
    		$("#alert-weight").html(data.weight);    
	});
}

function getPins(state){


var marker = []; 
	var url = "http://dev-site.citizenhub.org/alerted/all.children.state.php?state="+state+"&callback=?";

	$.getJSON(url,  function(data) {
        
        $.each(data.children, function(i, item) {
            
            
            var id = item.id;
            var pos = item.location;            
    geocoder.geocode( { 'address': pos}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      var posLat = results[0].geometry.location.$a;
      var posLong = results[0].geometry.location.ab;
        var point = new google.maps.LatLng(parseFloat(posLat),parseFloat(posLong));
        	var mark = new google.maps.Marker({
            	map: map,
            	icon: 'inc/missing-child.png',
            	position: point
           	}); 
           	
          	
  			marker.push(mark);
  			mark.set('id', id);
  			
			google.maps.event.addListener(mark, 'click', function() {
    			var id = this.get('id');
				localStorage['child'] = id;
				window.location.href='details.html';
  			});
      	
       

      } else {
      }
    });
            
        });
        

		
    });

}

function getLatLong(address){
  geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      results[0].geometry.location.$a+","+results[0].geometry.location.ab;
        return results[0].geometry.location;
      	
       

      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });

  }
  



function placeMarker(location) {

	marker.setMap(null);
	
	marker = new google.maps.Marker({
      	position: location, 
   		map: map,
   		icon: 'inc/marker.png'
   	});
   	
   	marker.setZIndex(999);
   	
   	xloc = location;
	
    geocoder.geocode({latLng: location}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        	if (results[0]) {
        	
	          	document.getElementById('location').innerHTML = results[0].formatted_address; 
	          	var address = results[0].address_components;
	          	zipcode = address[address.length - 1].long_name;
				floc = results[0].formatted_address; 
    		}
  
  		}
  	}); 

  map.setCenter(location);
}


function placeMarkerAddress() {

	marker.setMap(null);
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
      	
        var marker = new google.maps.Marker({
            map: map, 
            position: results[0].geometry.location,
   			icon: 'inc/marker.png'
        });

   		marker.setZIndex(999);
   	
   		xloc = results[0].geometry.location;
   	
	    geocoder.geocode({latLng: results[0].geometry.location}, function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
	        	if (results[0]) {
	        	
		          	document.getElementById('location').innerHTML = results[0].formatted_address; 
		          	var address = results[0].address_components;
		          	zipcode = address[address.length - 1].long_name;
		          	floc = results[0].formatted_address; 
	    		}
	  
	  		}
	  	}); 

  		map.setCenter(location);

      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
}


function placeMarkerAddressT(address) {

	marker.setMap(null);
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
      	
        var marker = new google.maps.Marker({
            map: map, 
            position: results[0].geometry.location,
   			icon: 'inc/marker.png'
        });

   		marker.setZIndex(999);
   	
   		xloc = results[0].geometry.location;
   	
	    geocoder.geocode({latLng: results[0].geometry.location}, function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
	        	if (results[0]) {
	        	
		          	document.getElementById('location').innerHTML = results[0].formatted_address; 
		          	var address = results[0].address_components;
		          	zipcode = address[address.length - 1].long_name;
		          	floc = results[0].formatted_address; 
	    		}
	  
	  		}
	  	}); 

  		map.setCenter(location);

      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
}

function success(position)
{

	newLoc = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
	
	marker = new google.maps.Marker({
      	position: newLoc, 
   		map: map,
   		icon: 'inc/marker.png'
   	});
	xloc = newLoc;
	
	var geocoder = new google.maps.Geocoder();
        geocoder.geocode({latLng: newLoc}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
		          	var address = results[0].address_components;
		          	zipcode = address[address.length - 1].long_name;
		          	floc = results[0].formatted_address; 
            }
          }
        });
    
    
	map.setCenter(newLoc);
}

function error(msg) {
	alert(msg);
}

function myLoc(){


	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(success, error);
	} 
	else {
		error('not supported');
	}
}

function menuShow(){
		$("#logo img").attr("src","inc/logo_selected.png");
		$("#logo").addClass("logo-seleced");
		$("#select-menu").show();
		clickStatus = 1;
}

function menuHide(){
		$("#logo img").attr("src","inc/logo.png");
		$("#select-menu").hide();
		$("#logo").removeClass("logo-seleced");
		clickStatus = 0;
}
