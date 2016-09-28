/**
 * 
 */

//document.addEventListener('DOMContentLoaded', function () {

var centers = [
     ['Bulgaria Mall', 42.663974, 23.288833, 'http://www.bulgariamall.bg/'],
     ['Mall of Sofia', 42.698243, 23.308336, 'http://mallofsofia.bg/'],
     ['Mega Mall Sofia', 42.710220, 23.271296, 'http://megamallsofia.bg/'],
     ['Paradise Center', 42.657697, 23.314545, 'http://paradise-center.com/'],
     ['Park Center', 42.678735, 23.320505, 'http://www.parkcenter.bg/home'],	                 
     ['Princess Outlet', 42.636420, 23.371842],
     ['Serdika Center', 42.691725, 23.353726, 'http://www.serdikacenter.bg/'],
     ['Sky City Mall', 42.679713, 23.367697, 'http://www.skycitycenter.com/'],
     ['Sofia Outlet Center', 42.645238, 23.392435, 'http://www.sofiaoutletcenter.bg/'],
     ['Sofia Ring Mall', 42.624351, 23.352657, 'http://www.sofiaring.bg/'],
     ['The Mall', 42.660833, 23.382708, 'http://themall.bg/'],
     ['TZUM', 42.698308, 23.323402, 'http://www.tzum.bg/']
   ];


function initialize() {
	var mapProp = {
    	center: new google.maps.LatLng(42.699384, 23.319817),
    	zoom: 12,
    	mapTypeId: google.maps.MapTypeId.ROADMAP
  	};
  	var map = new google.maps.Map(document.getElementById("map"), mapProp);

  	setMarkers(map, centers);
}
  

  
function setMarkers(map, centers) {	

	var infowindow = new google.maps.InfoWindow({
	    content: ' '
	});
	
	
	for (var i = 0; i < centers.length; i++) {

		var latLng = new google.maps.LatLng(centers[i][1], centers[i][2]);
		
		var title = centers[i][0];
		
		var link = centers[i][3];
		
		var infoWindowContent = [	
		                       
			         				'<h4>' + title + '</h4>',
			         				'<p class="infocomments">' + document.querySelector('#com123').innerHTML + '</p>',
			         				'<p class="inforate">' + document.querySelector('#rate123').innerHTML + '</p>',
			         				'<a target="_blank" id="linkSite" href=' + link + '>Visit Store\'s site</a>',
			                        '<button onclick="showAddComments()">Add Comment</button>',
		                    
		                        ].join("");
		
		
			
		var infoWindow = document.createElement('div');
		infoWindow.innerHTML = infoWindowContent;
		infoWindow.classList.add('infowindow');
		
		//INSERT MARKERS
		 
		var marker = new google.maps.Marker({
			position: latLng,
		    icon: 'images/pins.png',
		    title: title,
		    html: infoWindow,
		    url: '?store=' + title
		    });
		
		marker.setMap(map);
		
		//INSERT INFO WINDOWS
		
		marker.addListener('click', function(e) {
			
			window.history.pushState('', '', this.url);
			
			infowindow.setContent(this.html);
			infowindow.open(map, this);
			

			Ajax.request('GET', 'db/getComments.php' + this.url, true, function(response) {
				
				document.getElementById('commentsContainer').innerHTML = response;
			
				infowindow.content.querySelector('.infocomments').innerHTML = document.querySelector('#com123').innerHTML;
				infowindow.content.querySelector('.inforate').innerHTML = document.querySelector('#rate123').innerHTML;
				
			});			
		});
		
		
	}
		
}

function showAddComments() {
	
	var comment = document.getElementById('comment');
	
	comment.style.display = "block";
	
}


google.maps.event.addDomListener(window, 'load', initialize);



//}, false);
		