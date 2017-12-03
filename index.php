<html>
    
<head>
    <link rel='stylesheet' type='text/css' href='style.css'>
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>

    <script>
        function getCityInfo() {
        
             $.ajax({
                type: "get",
                url: "http://hosting.otterlabs.org/laramiguel/ajax/zip.php",
                dataType: "json",
                data: {
                    "zip_code": $("#zip").val()
                },
                success: function(data,status) {
                    console.log(data); 
                    $("#zip-code-error-msg").html("");
                    
                    if (!data.city) {
                        $("#zip-code-error-msg").html("Zip code is invalid"); 
                        return; 
                    }
                   
                    
                    $("#city").html(data.city);
                    $("#lon").html(data.longitude);
                    $("#lat").html(data.latitude);
                    
                },
                complete: function(data,status) { //optional, used for debugging purposes
                     //alert(status);
                }
             });
        }
        
        
        function getCountyInfo() {
            // alert("select state changed. Value: " + $("#stateList").val());
            
            $.ajax({
                type: "get",
                url: "http://hosting.otterlabs.org/laramiguel/ajax/countyList.php",
                dataType: "json",
                data: {"state": $("#stateList").val()},
                success: function(data,status) {
                    // alert(data); 
                    $("#county-list").html("");
                    for (var i = 0; i < data.counties.length; i++) {
                        $("#county-list").append("<option>" + data.counties[i].county + "</option>");
                    }
                    
                    
                  },
                complete: function(data,status) { //optional, used for debugging purposes
                     //alert(status);
                }
            });
        }
        
        
        function validateUsername() {
                    
            $.ajax({
                type: "get",
                url: "api.php",
                dataType: "json",
                data: {
                    'username': $('#username').val(),
                    'action': 'validate-username'
                },
                success: function(data,status) {
                    debugger;
                    
                    if (data.length > 0) {
                        $('#username-valid').html("Username is not available"); 
                    } else {
                        $('#username-valid').html("Username is available");
                    }
                    
                  },
                complete: function(data,status) { //optional, used for debugging purposes
                     //alert(status);
                }
            });
                }
    </script>
</head>



<body id="dummybodyid">

   <h1> Sign Up Form </h1>

    <form onsubmit="return false;">
        <fieldset>
           <legend>Sign Up</legend>
            First Name:  <input type="text"><br> 
            Last Name:   <input type="text"><br> 
            Email:       <input type="text"><br> 
            Phone Number:<input type="text"><br><br>
            Zip Code:    <input id="zip" onchange="getCityInfo();" type="text"> <span id="zip-code-error-msg"></span></span><br>
            City:  <span id="city"></span>
            <br>
            Latitude: <span id="lon"></span>
            <br>
            Longitude: <span id="lat"></span>
            <br><br>
            State: 
            <select onchange="getCountyInfo();" id="stateList" name="stateList">
              <option value="ca">California</option>
              <option value="nv">Nevada</option>
              <option value="wa">Washington</option>
              <option value="or">Oregon</option>
            </select><br>
            Select a County: <select id="county-list"></select><br>
            
            Desired Username: <input onchange="validateUsername();" id='username' type="text"> <span id="username-valid"></span></span><br>
            Password: <input type="password"><br>
            Type Password Again: <input type="password"><br>
            <input type="submit" value="Sign up!">
        </fieldset>
    </form>
</body>

</html>