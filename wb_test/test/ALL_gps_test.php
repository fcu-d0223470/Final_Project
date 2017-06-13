                ///////監聽
                document.getElementById('ConstructionADD1').addEventListener('change',function(){

                    var	Longitude = document.getElementById("Longitude1");
                    var	Latitude  = document.getElementById("Latitude1");
                    
                    var geocoder = new google.maps.Geocoder();
                    
                    geocoder.geocode( { address:add},function(results,status){

                        if (status == google.maps.GeocoderStatus.OK) {
                            Longitude.value = results[0].geometry.location.lng();
                            Latitude.value = results[0].geometry.location.lat();
                            alert(Longitude.value);
                            alert(Latitude.value);
                        }else {
                            alert("Geocode was not successful for the following reason: " + status);
                        }
                  })
                })
                //////