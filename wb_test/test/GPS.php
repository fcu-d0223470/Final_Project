<html>
  <head>
    <title>新增任務</title>
	
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1zYQ6gaw_wPy-q_rl4yQG890zM1-Fg2U&signed_in=true&callback=initMap" async defer></script>
	
    <script type="text/javascript">
        $sub_num = 1;
		var add;
		var Longitude;
		var Latitude;
		
		function addRow(){
			$('tr:last').after( $('#template').clone().removeAttr('id') );
			$('tr:last > td.id').text( id );
			$('tr:last > td.username').text( username );
			$('tr:last > td.email').text( email );
		}
		
		
        function more(){    	
		 
		
		 
          while($sub_num<10){
            $sub_num = $sub_num + 1; 
            nt = document.getElementById('myTable').insertRow(document.getElementById('myTable').rows.length-1) 
 
            story_address = nt.insertCell(0);
			story_picture = nt.insertCell(1);
            story_data = nt.insertCell(2);
			
			
            story_address.innerHTML = "<input type='text' name='story_address[]' id='ConstructionADD'+$sub_num >";
			story_picture.innerHTML = "<input type='text' name='story_picture[]' id='Longitude'+$sub_num readonly='readonly'>";
            story_data.innerHTML 	= "<input type='text' name='story_data[]' 	 id='Latitude'+$sub_num  readonly='readonly'>"; 
			
          break;
          }           
        }
        function delayedLoop() {
            codeAddress();
            codeAddress1();
        }

        
		function codeAddress(){
			var i=0;
           //for(var i=0;i<2;i++){
			add = document.getElementById("ConstructionADD"+i);
			Longitude = document.getElementById("Longitude"+i);
			Latitude = document.getElementById("Latitude"+i);
			
			var geocoder = new google.maps.Geocoder();

			geocoder.geocode( { address: add.value}, function(results, status) {

				if (status == google.maps.GeocoderStatus.OK) {
					Longitude.value = results[0].geometry.location.lng();
					Latitude.value = results[0].geometry.location.lat();
				}else {
					alert("Geocode was not successful for the following reason: " + status);
				}
			});
           // window.setTimeout(delayedLoop,1500);
           //}
		}
		function codeAddress1(){
			
			add = document.getElementById("ConstructionADD1");
			Longitude = document.getElementById("Longitude1");
			Latitude = document.getElementById("Latitude1");
			
			var geocoder = new google.maps.Geocoder();

			geocoder.geocode( { address: add.value}, function(results, status) {

				if (status == google.maps.GeocoderStatus.OK) {
					Longitude.value = results[0].geometry.location.lng();
					Latitude.value = results[0].geometry.location.lat();
				}else {
					alert("Geocode was not successful for the following reason: " + status);
				}
			});
		}
	
		
    </script> 
  </head>
  <body>
    <form  method="post" name="myForm" enctype="multipart/form-data"> 
      <table id="myTable" table width="500"  border="1" cellpadding="5" cellspacing="1" align="center"> 
        <tr align="center">
            <td>故事位置</td>
			<td>故事經度</td>
            <td>故事緯度</td>
        </tr>        
        <tr align="center"> 
            <td><input type="text" name="story_address[0]" id="ConstructionADD0" value="台北" onchange='codeAddress()'></td>
			<td><input type="text" name="story_picture[0]" id="Longitude0" readonly="readonly"></td>
            <td><input type="text" name="story_data[0]" id="Latitude0" readonly="readonly"></td> 
        </tr>
		<tr align="center"> 
            <td><input type="text" name="story_address[1]" id="ConstructionADD1" value="台灣" onchange='codeAddress1()'></td>
			<td><input type="text" name="story_picture[1]" id="Longitude1" readonly="readonly"></td>
            <td><input type="text" name="story_data[1]" id="Latitude1" readonly="readonly"></td> 
        </tr>
        <tr align="center">
          <td colspan="6">
            <input type="button" value="送出" onClick="delayedLoop()"/>&nbsp;&nbsp;&nbsp;&nbsp; 
            <input type="button" value="新增更多故事" onclick="more();" />&nbsp;&nbsp;&nbsp;&nbsp; 
            <input type="reset" value="重新填寫">
          </td>
        </tr>       
      </table> 
    </form> 
  </body>
</html>