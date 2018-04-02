/*
	RAVE JavaScript 
	Filename: main.js
	
	Authors: Group 8
		Nathan Chan, Jeffrey Holst, Cristian Johnson, Joseph Scott
	Date: 03/25/2018
*/

//Autocomplete textbox sample - Taken from w3schools 
//https://www.w3schools.com/howto/howto_js_autocomplete.asp
function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
              b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
      x[i].parentNode.removeChild(x[i]);
    }
  }
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
}

//Logs the user into our system
function login(){
	//Gathering the info need from the page
	var username = document.getElementById("userInput").value;
	var password = document.getElementById("passwordInput").value;

	var datastring = 'user=' + username + '&pass=' + password;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(username);
	array.push(password);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/login.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//Checking the rights for the user we tried to login
					var successful = xhr.responseText;

					//If we got a valid result we change our page and log the user in
					if(successful == true){
						window.location.replace("index.php");
					} else {
						//Otherwise we alert that something went wrong
						alert("Invalid Username or Password");
					}
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
}

//Called by each page to edit it's contents to suit the user's rights
function setUserRights(page){
	//Empty string for the post call
	var datastring = "";
	
	//Starting the ajax call
	var xhr;
	xhr = new XMLHttpRequest();

	//Opening the Request and setting the header
	xhr.open("POST", "php/getUserRights.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;

	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				//Setting our rights to whatever we recieved from the query
				var rights = xhr.responseText;

				//Gathering the elements related to each rights class
				var adminElements = document.getElementsByClassName("adminRights");
				var mecElements = document.getElementsByClassName("mecRights");
				var genElements = document.getElementsByClassName("genRights");
				
				//Arrays to store those elements' values
				var adminValues = new Array();
				var mecValues = new Array();
				var genValues = new Array();
				
				//Looping through all the elements to store their values then delete their contents
				for(var i = 0; i < adminElements.length; i++){
					adminValues.push(adminElements[i].innerHTML);
					adminElements[i].innerHTML = "";
				}
				for(var i = 0; i < mecElements.length; i++){
					mecValues.push(mecElements[i].innerHTML);
					mecElements[i].innerHTML = "";
				}
				for(var i = 0; i < genElements.length; i++){
					genValues.push(genElements[i].innerHTML);
					genElements[i].innerHTML = "";
				}
				
				//Then we reset the elements related to our user's rights
				if(rights == "GENERAL"){
					for(var i = 0; i < genElements.length; i++){
						genElements[i].innerHTML = genValues[i];
					}
				}
				
				if(rights == "MECHANIC"){
					for(var i = 0; i < genElements.length; i++){
						genElements[i].innerHTML = genValues[i];
					}
					for(var i = 0; i < mecElements.length; i++){
						mecElements[i].innerHTML = mecValues[i];
					}
				}
				
				if(rights == "ADMIN"){
					for(var i = 0; i < genElements.length; i++){
						genElements[i].innerHTML = genValues[i];
					}
					for(var i = 0; i < mecElements.length; i++){
						mecElements[i].innerHTML = mecValues[i];
					}
					for(var i = 0; i < adminElements.length; i++){
						adminElements[i].innerHTML = adminValues[i];
					}
				}
				
				//Next we call any functions needed for the page that called this function
				if(page == 'admintasks'){
					selectAllDepartments("selectDepartmentNameInput");
					selectDepartment();
				}
				if(page == 'analyzecosts'){
					setPreviousMonthDate();
					autocompleteVehicleId("editVehicleIDInput");
				}
				if(page == 'editfleet'){
					autocompleteVehicleId('vehicle');
					selectAllDepartments("addDepartmentNameInput");
					selectAllDepartments("editDepartmentNameInput");
				}
				if(page == 'editmaintenance'){
					autocompleteVehicleId('addVehicleIDInput');
					autocompleteMaintenanceVehicleId("vehicle");
					autocompleteLaborCodes("add");
					autocompleteLaborCodes("edit");
					setCurrentDate("addMaintenanceDateInput");
					setCurrentDate("editMaintenanceDateInput");
					setCurrentDate("editDateInput");
					setCurrentDate("removeDateInput");
					selectAllMechanics("addMaintenanceMechanicInput");
					selectAllMechanics("editMaintenanceMechanicInput");
				}
				if(page == 'editschedule'){
					autocompleteScheduleVehicleId("vehicle");
					autocompleteVehicleId("addVehicleIDInput");
					selectAllMechanics("addMechanicNameInput");
					selectAllMechanics("editMechanicNameInput");
					setCurrentDate("addScheduleDateInput");
					setCurrentDate("scheduleDateInput");
					setCurrentDate("editScheduleDateInput");
					setCurrentDate("removeScheduleDateInput");
				}
				if(page == 'index'){
					selectVehicleMileageAlerts();
				}
				if(page == 'viewfleet'){
					autocompleteVehicleId("editVehicleIDInput");
				}
				if(page == 'viewmaintenance'){
					autocompleteMaintenanceVehicleId("editVehicleIDInput");	
				}
				if(page == 'viewschedule'){
					setCurrentDate("scheduleDateInput");
				}
				if(page == 'weeklycheckup'){
					autocompleteVehicleId("vehicle");
				}
			} else {
				alert("There was a problem with the request.");
			} 
		}
	}

	//Send the request
	xhr.send(datastring);
}

//Sends a XMLHttp request to the server to generate the department report
function selectDepartmentReport(){
	//Gathering the variables we will need from the page
	var dName = document.getElementById("departmentNameInput").value;
	var startDate = document.getElementById("departmentStartDate").value;
	var endDate = document.getElementById("departmentEndDate").value;
	
	var datastring = 'dName=' + dName + '&sDate=' + startDate + '&eDate=' + endDate;
	
	//Starting the xmlhttp request
	var xhr;
	xhr = new XMLHttpRequest();
	
	//Opening the request
	xhr.open("POST", "php/selectDepartmentReport.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;

	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				var jsonarray = JSON.parse(xhr.responseText);
				//If our result is only one element then it's an error so we display it
				if(jsonarray.length == 1){
					alert(xhr.reponseText)
				} else {
					//Setting all of the reports elements to the results of the query
					document.getElementById("departmentTotalMileage").value = jsonarray[0];
					document.getElementById("departmentTotalGasCost").value = jsonarray[1];
					document.getElementById("departmentTotalMaintenanceCost").value = jsonarray[2];
					document.getElementById("departmentTotalMaintenanceRequests").value = jsonarray[3];
					document.getElementById("departmentTotalVehicles").value = jsonarray[4];
					document.getElementById("departmentAvgMileage").value = jsonarray[5];
				}
			} else {
				alert("There was a problem with the request.");
			} 
		} 
	}

	//Send the request
	xhr.send(datastring);
}

//Sends a XMLHttp request to the server to generate the vehicle report
function selectVehicleReport(){
	//Gathering all the variables needed from the page
	var vid = document.getElementById("editVehicleIDInput").value;
	var startDate = document.getElementById("vehicleStartDate").value;
	var endDate = document.getElementById("vehicleEndDate").value;
	
	var datastring = 'vid=' + vid + '&sDate=' + startDate + '&eDate=' + endDate;
	
	//Starting the xml request
	var xhr;
	xhr = new XMLHttpRequest();
		
	//Opening the request
	xhr.open("POST", "php/selectVehicleReport.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;
	
	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				var jsonarray = JSON.parse(xhr.responseText);
				
				//If our result only contains one element than it's an error
				if(jsonarray.length == 1){
					alert(xhr.responseText);
				} else {
					//Setting our report fields to the values in the array
					document.getElementById("vehicleTotalMileage").value = jsonarray[0];
					document.getElementById("vehicleTotalGasCost").value = jsonarray[1];
					document.getElementById("vehicleTotalMaintenanceCost").value = jsonarray[2];
					
					//Creating our maintenance table
					selectMaintenanceTableRange("editVehicleIDInput", startDate, endDate);
				}
			} else {
				alert("There was a problem with the request.");
			} 
		} 
	}
	
	//Send the request
	xhr.send(datastring);

}

//Sends a XMLHttp request to the server to generate the vehicle report
function selectMaintenanceReport(){
	//Gathering the variables needed from the page
	var licenseClass = document.getElementById("editRequiredLicenseInput").value;
	var startDate = document.getElementById("mainStartDate").value;
	var endDate = document.getElementById("mainEndDate").value;
	
	var datastring = 'licenseClass=' + licenseClass + '&sDate=' + startDate + '&eDate=' + endDate;
	
	//Starting the xmlhttp request
	var xhr;
	xhr = new XMLHttpRequest();
		
	//Opening the request
	xhr.open("POST", "php/selectMaintenanceReport.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;
	
	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				var jsonarray = JSON.parse(xhr.responseText);
				
				//If our result only contains one elements then it's an error
				if(jsonarray.length == 1){
					alert(xhr.responseText);
				} else {
					//Setting all of the report fields to the values in our array
					document.getElementById("maintenanceLaborCost").value = jsonarray[0];
					document.getElementById("maintenancePartsCost").value = jsonarray[1];
					
					//Creating the maintenance table for the class in question
					selectMaintenanceTableClass(licenseClass, startDate, endDate);
				}
			
			} else {
				alert("There was a problem with the request.");
			} 
		} 
	}
	
	//Send the request
	xhr.send(datastring);

}

//Sends a XMLHttp request to the server to select all vehicles matching certain criteria
function selectVehicleMileageAlerts(){
	//Starting the ajax call
	var xhr;
	xhr = new XMLHttpRequest();
	
	//Empty string for the post call
	var datastring = "";
	
	//Opening the request
	xhr.open("POST", "php/selectVehicleMileageAlerts.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;
	
	//String to hold the innner html for our table
	var string = "";
	
	//Setting the headers
	string = "<tr>" +
			"<th>Vehicle ID</th>" +
			"<th>Make</th>" +
			"<th>Model</th>" +
			"<th>Year</th>" +
			"<th>VIN</th>" +
			"<th>Mileage</th>" +
			"<th>Service Needed</th>" +
			"</tr>";
	
	//An array to hold the id's for all our elements that need to be restyled
	var overMileage = new Array();

	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				alert(xhr.responseText);

				var jsonarray = JSON.parse(xhr.responseText);
				//If our result doesnt contain any elements than we got an empty table
				if(jsonarray.length != 0){
					//If our result is only one element than it's an error
					if(jsonarray[0][0].length == 1){
						alert(xhr.responseText);
					} else {
						//String to hold the contents of a row
						var tableRow = "";

						//Our jsonarray is a three dimensional array so we loop through each dimension
						//One - Represents each vehicle that got a hit from the query
						//Two - Has the vehicle array along with some extra info
						//The vehicle is always in index 0 so we don't need to loop to get our info
						for(var i = 0; i < jsonarray.length; i++){
							//Starting a new row for each vehicle
							tableRow += "<tr id = " + jsonarray[i][0][0] + ">";
							
							//Three - Represents the attributes of the vehicle in question
							for(var j = 0; j < jsonarray[i][0].length; j++){
								//We only need some of the values for the table so we make a new cell when we each these
								if(j == 0 || j == 2 || j == 3 || j == 4 || j == 5 || j == 6){
									tableRow += "<td>" + jsonarray[i][0][j] + "</td>";
								}
							}
							
							//Once we finish the vehicle we pull the second element which represents which reccommended service this vehicle needs
							tableRow += "<td>" + jsonarray[i][jsonarray[i].length - 2] + "</td>";
							tableRow += "</tr>";
							
							//The last element of the second dimension represents wether or not the vehicle is over the recc mileage
							if(jsonarray[i][2] == true){
								overMileage.push(jsonarray[i][0][0]);
							}
							
							//Add this row to the string for the table
							string += tableRow;
							tableRow = "";
						}
					}
				}
				
				//We then send this string to be added upon and the array of elements that need to be styled
				selectVehicleCheckupAlerts(string, overMileage);
			} else {
				alert("There was a problem with the request.");
			}
		}
	}
	
	//Send the request
	xhr.send(datastring);
}

//Sends a XMLHttp request to the server to select all vehicles matching certain criteria
function selectVehicleCheckupAlerts(string, overMileage){
	//Starting the ajax call
	var xhr;
	xhr = new XMLHttpRequest();
	
	//Empty string for the post call
	var datastring = "";
	
	//Opening the request
	xhr.open("POST", "php/selectVehicleCheckupAlerts.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;

	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				//Grabbing the table for us to write in
				var vehicleAlertsTable = document.getElementById("vehicleAlerts");
				
				var jsonarray = JSON.parse(xhr.responseText);
				//If the length is zero than it's an empty table
				if(jsonarray.length != 0){
					//If the array length is 1 than it is an error string
					if(jsonarray[0][0].length == 1){
						alert(xhr.responseText);
					} else {			
						//Our result is a three dimensional array
						//One - Every vehicle that meet the criteria from the query
						for(var i = 0; i < jsonarray.length; i++){
							//Starting a new row
							var tableRow = "<tr>";
							
							//Two - Just holds the actual vehicle
							for(var k = 0; k < jsonarray[i].length; k++){
								//Three - The attributes for our vehicle
								for(var j = 0; j < jsonarray[i][k].length; j++){
									//We only want some the values so we add a cell to the row we reach those
									if(j == 0 || j == 2 || j == 3 || j == 4 || j == 5 || j == 6){
										tableRow += "<td>" + jsonarray[i][k][j] + "</td>";
									}
								} 
							}
							
							//Once we finish the vehicle we add a description cell and end the row
							tableRow += "<td>Weekly Checkup</td>";
							tableRow += "</tr>";
							
							//Tack this row onto the string for the table
							string += tableRow;
						}
					}
				}
				
				//Once the string is finish we write the table
				vehicleAlertsTable.innerHTML = string;
				
				//Once we've written the table we can style the elements that need attention
				for(var i = 0; i < overMileage.length; i++){
					var element = document.getElementById(overMileage[i]);
					element.classList.add("overMileage");
				}
				
			} else {
				alert("There was a problem with the request.");
			} 
		}
	}
	
	//Send the request
	xhr.send(datastring);
}

//Sets the autocomplete for the schedules forms' vehicle id's
function autocompleteScheduleVehicleId(id){
	//Starting the ajax call
	var xhr;
	xhr = new XMLHttpRequest();
	
	//We send an asterisk and -1 just so we know what we are looking for in the query
	var datastring = 'vid=*&sid=-1';
	
	//Opening the request
	xhr.open("POST", "php/selectAppointment.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;

	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				var jsonarray = JSON.parse(xhr.responseText);
				
				//If our length is 0 then it's an empty table
				if(jsonarray.length != 0){
					//Tif the array length is one than it's an error string
					if(jsonarray[0].length == 1){
						alert(xhr.responseText);
					} else {
						//We will use these variables to build a array of every vehicle id in the schedule table
						var idArray = new Array();
						var dontEnter = false;
						
						//Looping through the table
						for(var i = 0; i < jsonarray.length; i++){
							dontEnter = false;
							//Loop through the ids we've built so far and if they match the current we won't enter it
							for(var j = 0; j < idArray.length; j++){
								if(idArray[j] == jsonarray[i][1]){
									dontEnter = true;
								}
							}
							
							//If the entry doesn't exist we add it to our array
							if(!dontEnter){
								idArray.push(jsonarray[i][1]);
							}
						}
						
						//If we get vehicle then we set the two vehicle id fields related to schedule 
						//Otherwise we set whatever id we were given
						if(id == "vehicle"){
							autocomplete(document.getElementById("removeVehicleIDInput"), idArray);
							autocomplete(document.getElementById("editVehicleIDInput"), idArray);
						} else {
							autocomplete(document.getElementById(id), idArray);
						}
					}
				}
			} else {
				alert("There was a problem with the request.");
			} 
		}
	}

	//Send the request
	xhr.send(datastring);
}

//Sets the autocomplete for the maintenance form's vehicle id's
function autocompleteMaintenanceVehicleId(id){
	//Starting the ajax call
	var xhr;
	xhr = new XMLHttpRequest();
	
	//We send an asterisk and -1 just so we know what we are looking for in the query
	var datastring = 'vid=*&mid=-1';
	
	//Opening the request
	xhr.open("POST", "php/selectMaintenance.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;

	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				var jsonarray = JSON.parse(xhr.responseText);
				//If our length is 0 then it's an empty table
				if(jsonarray.length != 0){
					//Tif the array length is one than it's an error string
					if(jsonarray[0].length == 1){
						alert(xhr.responseText);
					} else {
						//We will use these variables to build an array of every vehicle id in the maintenance table
						var idArray = new Array();
						var dontEnter = false;
						
						//Looping through the table
						for(var i = 0; i < jsonarray.length; i++){
							dontEnter = false;
							//Looping through the id's we've entered already and if they match we wont enter it again
							for(var j = 0; j < idArray.length; j++){
								if(idArray[j] == jsonarray[i][1]){
									dontEnter = true;
									
								}
							}
							if(!dontEnter){
								idArray.push(jsonarray[i][1]);
							}
						}
						
						if(id == "vehicle"){
							autocomplete(document.getElementById("removeVehicleIDInput"), idArray);
							autocomplete(document.getElementById("editVehicleIDInput"), idArray);
						} else {
							autocomplete(document.getElementById(id), idArray);
						}
					}
				}
			} else {
				alert("There was a problem with the request.");
			} 
		}
	}

	//Send the request
	xhr.send(datastring);
}


//Sets the autocomplete for the vehicle id's
function autocompleteVehicleId(id){
	//Starting the ajax call
	var xhr;
	xhr = new XMLHttpRequest();

	//Opening the request
	xhr.open("GET", "php/selectVehicle.php?q=*", true);

	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;

	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				var jsonarray = JSON.parse(xhr.responseText);
				//If our length is 0 then it's an empty table
				if(jsonarray.length != 0){
					//Tif the array length is one than it's an error string
					if(jsonarray.length == 1){
						alert(xhr.responseText);
					} else {
						//The result is already just unique id's we will push all them into our id array
						var idArray = new Array();
						for(var i = 0; i < jsonarray.length; i++){
							idArray.push(jsonarray[i][0]);
						}
						
						if(id == "vehicle"){
							autocomplete(document.getElementById("removeVehicleIDInput"), idArray);
							autocomplete(document.getElementById("editVehicleIDInput"), idArray);
							autocomplete(document.getElementById("addVehicleIDInput"), idArray);
						} else {
							autocomplete(document.getElementById(id), idArray);
						}
					}
				}
			} else {
				alert("There was a problem with the request.");
			} 
		}
	}

	//Send the request
	xhr.send();
}

//Sets the autocompletes for the labor codes
function autocompleteLaborCodes(formSet){
	//Starting the ajax call
	var xhr;
	xhr = new XMLHttpRequest();

	//Opening the request
	xhr.open("GET", "php/selectLaborCodes.php", true);

	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;

	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				var jsonarray = JSON.parse(xhr.responseText);
				//If our length is 0 then it's an empty table
				if(jsonarray.length != 0){
					//Tif the array length is one than it's an error string
					if(jsonarray[0].length == 1){
						alert(xhr.responseText);
					} else {
						//Arrays to store the values we need
						var whatCodes = new Array();
						var whereCodes = new Array();
						var laborCodes = new Array();
						
						//Breaking our result into two arrays, one for what codes, one for where codes
						for(var i = 0; i < jsonarray.length; i++){
							if(jsonarray[i][0].length == 1){
								whatCodes.push("0"+jsonarray[i][0]);
							}
							if(jsonarray[i][0].length == 2){
								whatCodes.push(jsonarray[i][0]);
							}
							if(jsonarray[i][0].length == 3){
								whereCodes.push(jsonarray[i][0]);
							}
						}
						
						//Making a new array with all combinations for the codoes
						for(var i = 0; i < whatCodes.length; i++){
							for(var j = 0; j < whereCodes.length; j++){
								var string = whatCodes[i] + whereCodes[j];
								laborCodes.push(string);
							}
						}				
						
						if(formSet == "add"){
							//Setting the id for our input and running the autocomplete function for it
							var addLaborCodeInputs = document.getElementsByClassName("addLaborCodeInputs");
							for(var k = 0; k < addLaborCodeInputs.length; k++){
								var id = 'addLaborCodeInputs' + k;
								addLaborCodeInputs[k].id = id;
								autocomplete(document.getElementById(id), laborCodes);
							}
						}
						if(formSet == "edit"){
							//Setting the id for our input and running the autocomplete function for it
							var editLaborCodeInputs = document.getElementsByClassName("editLaborCodeInputs");
							for(var k = 0; k < editLaborCodeInputs.length; k++){
								var id = 'editLaborCodeInputs' + k;
								editLaborCodeInputs[k].id = id;
								autocomplete(document.getElementById(id), laborCodes);
							}
						}
					}
				}
			} else {
				alert("There was a problem with the request.");
			} 
		}
	}

	//Send the request
	xhr.send();
}

//Adds a new labor input everytime the user clicks off the field
function addLaborInputField(formSet){
	if(formSet == "add"){
		//Getting the div and array of current inputs
		var laborDiv = document.getElementById("addLaborCodeInputs");
		var currentLabors = document.getElementsByClassName("addLaborCodeInputs");
		
		//Saving the current values of the inputs
		var currentLaborsValues = new Array();
		for(var i = 0; i < currentLabors.length; i++){
			currentLaborsValues.push(currentLabors[i].value);
		}
		
		//Creating a new input
		var string = "<label>Labor Codes<input type = 'text' class = 'addLaborCodeInputs' placeholder = '01103'></label>"	
		laborDiv.innerHTML += string;
		
		//Resetting the values for the inputs
		for(var i = 0; i < currentLabors.length - 1; i++){
			currentLabors[i].value = currentLaborsValues[i];
		}
		
		//Setting the onchange functions for the input
		currentLabors[currentLabors.length-1].onchange = function(){addLaborInputField('add'); autocompleteLaborCodes('add')}
	}
	if(formSet == "edit"){
		//Getting the div and array of current inputs
		var laborDiv = document.getElementById("editLaborCodeInputs");
		var currentLabors = document.getElementsByClassName("editLaborCodeInputs");
		
		//Saving the current values of the inputs
		var currentLaborsValues = new Array();
		for(var i = 0; i < currentLabors.length; i++){
			currentLaborsValues.push(currentLabors[i].value);
		}
		
		//Creating a new input
		var string = "<label>Labor Codes<input type = 'text' class = 'editLaborCodeInputs' placeholder = '01130'></label>"
		laborDiv.innerHTML += string;
		
		//Resetting the values for the inputs
		for(var i = 0; i < currentLabors.length - 1; i++){
			currentLabors[i].value = currentLaborsValues[i];
		}
		
		//Setting the onchange functions for the input
		currentLabors[currentLabors.length-1].onblur = function(){addLaborInputField('edit'); autocompleteLaborCodes('edit')}
		
	}
}

//Checks if any of the fields we need for the database are empty
function validateForm(formValues){
	for(var i = 0; i < formValues.length; i++){
		if(formValues[i] == ""){
			alert("Form is missing values");
			return false;
		}
	}
	return true;
}

//Sends a XMLHttp request to the sever to use PHP to add a mechanic
function insertMechanic(){
	//Getting all of the information needed for a mechanic
	var mecId = document.getElementById("addMechanicIDInput").value;
	var mecFirstName = document.getElementById("addMechanicFirstNameInput").value;
	var mecLastName = document.getElementById("addMechanicLastNameInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(mecId);
	array.push(mecFirstName);
	array.push(mecLastName);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the vehicle information into a string to send
		var dataString = 'mechID=' + mecId + '&mechFName=' + mecFirstName + '&mechLNAME=' + mecLastName;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Open the request and set the header
		xhr.open("POST", "php/insertMechanic.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to update a record in the mechanic table
function updateMechanic(){
	//Getting all of the information needed for a mechanic
	var mecId = document.getElementById("editMechanicIDInput").value;
	var mecFirstName = document.getElementById("editMechanicFirstNameInput").value;
	var mecLastName = document.getElementById("editMechanicLastNameInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(mecId);
	array.push(mecFirstName);
	array.push(mecLastName);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the vehicle information into a string to send
		var dataString = 'mechID=' + mecId + '&mechFName=' + mecFirstName + '&mechLNAME=' + mecLastName;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request and setting the header
		xhr.open("POST", "php/updateMechanic.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to remove a record in the mechanic table
function removeMechanic(){
	var mecId = document.getElementById("removeMechanicIDInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(mecId);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		var dataString = 'mechID=' + mecId;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request and setting the header
		xhr.open("POST", "php/removeMechanic.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to select the mechanic in question
function selectMechanic(){
	//This function is called by two different forms so we need to specify which elements we are using
	var mecId = document.getElementById("selectMechanicIDInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("GET", "php/selectMechanic.php?q=" + mecId, true);
	
		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							document.getElementById("editMechanicIDInput").value = jsonarray[0][0];
							document.getElementById("editMechanicFirstNameInput").value = jsonarray[0][1];
							document.getElementById("editMechanicLastNameInput").value = jsonarray[0][2];
						}
					} 
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send();
	}
}

//Sends a XMLHttp request to the sever to use PHP to add a user
function insertUser(){
	//Getting all of the information needed for a user
	var username = document.getElementById("addUsernameInput").value;
	var password = document.getElementById("addPasswordInput").value;
	var adminRights = document.getElementById("addAdminRightsInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(username);
	array.push(password);
	array.push(adminRights);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the vehicle information into a string to send
		var dataString = 'username=' + username + '&password=' + password + '&adminRights=' + adminRights;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Open the request and set the header
		xhr.open("POST", "php/insertUser.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to update a record in the user table
function updateUser(){
	//Getting all of the information needed for a user
	var username = document.getElementById("editUsernameInput").value;
	var password = document.getElementById("editPasswordInput").value;
	var adminRights = document.getElementById("editAdminRightsInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(username);
	array.push(password);
	array.push(adminRights);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the vehicle information into a string to send
		var dataString = 'username=' + username + '&password=' + password + '&adminRights=' + adminRights;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request and setting the header
		xhr.open("POST", "php/updateUser.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to remove a record in the user table
function removeUser(){
	var username = document.getElementById("removeUsernameInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(username);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		var dataString = 'username=' + username;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request and setting the header
		xhr.open("POST", "php/removeUser.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to select the user in question
function selectUser(){
	//This function is called by two different forms so we need to specify which elements we are using
	var username = document.getElementById("selectUsernameInput").value;
	
	var datastring = 'username=' + username;
	//Making an array for our values to validate
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectUser.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);
					
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							document.getElementById("editUsernameInput").value = jsonarray[0][0];
							document.getElementById("editPasswordInput").value = jsonarray[0][1];
							document.getElementById("editAdminRightsInput").value = jsonarray[0][2];
						}
					} 
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
}

//Sends a XMLHttp request to the sever to use PHP to add a department
function insertDepartment(){
	//Getting all of the information needed for a department
	var departmentId = document.getElementById("addDepartmentIDInput").value;
	var departmentName = document.getElementById("addDepartmentNameInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(departmentId);
	array.push(departmentName);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the vehicle information into a string to send
		var dataString = 'deptID=' + departmentId + '&deptName=' + departmentName;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Open the request and set the header
		xhr.open("POST", "php/insertDepartment.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to update a record in the department table
function updateDepartment(){
	//Getting all of the information needed for a department
	var departmentId = document.getElementById("selectDepartmentNameInput").value;
	var departmentName = document.getElementById("editDepartmentNameInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(departmentId);
	array.push(departmentName);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the vehicle information into a string to send
		var dataString = 'deptID=' + departmentId + '&deptName=' + departmentName;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request and setting the header
		xhr.open("POST", "php/updateDepartment.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
					selectAllDepartments("selectDepartmentNameInput");
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to select the department in question
function selectDepartment(){
	//This function is called by two different forms so we need to specify which elements we are using
	var did = document.getElementById("selectDepartmentNameInput").value;
	
	var datastring = 'did=' + did;
	
	//We don't validate anything here
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectDepartment.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here					
					var jsonarray = JSON.parse(xhr.responseText);
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							document.getElementById("editDepartmentNameInput").value = jsonarray[0][1];
						}
					} 
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
}

//Sends a XMLHttp request to the server to use PHP to add a vehicle
function insertVehicle(){
	//Getting all of the vehicle information from the form
	var vid = document.getElementById("addVehicleIDInput").value;
	
	var did = document.getElementById("addDepartmentNameInput").value;
	
	var make = document.getElementById("addMakeInput").value;
	var model = document.getElementById("addModelInput").value;
	var year = document.getElementById("addYearInput").value;
	var vin = document.getElementById("addVINInput").value;
	var mileage = document.getElementById("addMileageInput").value;
	var engine = document.getElementById("addEngineInput").value;
	
	var tiresOption = document.getElementById("addTiresInput");
	var tires = tiresOption.options[tiresOption.selectedIndex].value;
	
	var conditionOption = document.getElementById("addConditionInput");
	var condition = conditionOption.options[conditionOption.selectedIndex].value;
	
	var licenseOption = document.getElementById("addRequiredLicenseInput");
	var license = licenseOption.options[licenseOption.selectedIndex].value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(vid);
	array.push(did);
	array.push(make);
	array.push(model);
	array.push(year);
	array.push(vin);
	array.push(mileage);
	array.push(engine);
	array.push(tires);
	array.push(condition);
	array.push(license);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the vehicle information into a string to send
		var dataString = 'vid=' + vid + '&did=' + did + '&make=' + make + '&model=' + model + '&year=' + year + '&vin=' + vin +
						 '&mileage=' + mileage + '&engine=' + engine + '&tires=' + tires +
						 '&condition=' + condition + '&license=' + license;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Open the request and set the header
		xhr.open("POST", "php/insertVehicle.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to update a vehicle
function updateVehicle(){
	//Getting all of the vehicle information from the form
	var vid = document.getElementById("editVehicleIDInput").value;
	var did = document.getElementById("editDepartmentNameInput").value;
	var make = document.getElementById("editMakeInput").value;
	var model = document.getElementById("editModelInput").value;
	var year = document.getElementById("editYearInput").value;
	var vin = document.getElementById("editVINInput").value;
	var mileage = document.getElementById("editMileageInput").value;
	var engine = document.getElementById("editEngineInput").value;
	var tires = document.getElementById("editTiresInput").value;
	var condition = document.getElementById("editConditionInput").value;
	var license = document.getElementById("editRequiredLicenseInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(vid);
	array.push(did);
	array.push(make);
	array.push(model);
	array.push(year);
	array.push(vin);
	array.push(mileage);
	array.push(engine);
	array.push(tires);
	array.push(condition);
	array.push(license);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the vehicle information into a string to send
		var dataString = 'vid=' + vid + '&did=' + did + '&make=' + make + '&model=' + model + '&year=' + year + '&vin=' + vin +
						 '&mileage=' + mileage + '&engine=' + engine + '&tires=' + tires + '&condition=' + condition + 
						 '&license=' + license;
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
		
		//Opening the request and setting the header
		xhr.open("POST", "php/updateVehicle.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to remove a vehicle
function removeVehicle(){
	//Grabbing the requested vehicle id
	var id = document.getElementById("removeVehicleIDInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(id);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request
		//Used GET here because we only need to send and request a single number
		xhr.open("GET", "php/removeVehicle.php?q=" + id, true);
	
		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send();
	}
}

//Sends a XMLHttp request to the server to use PHP to select a vehicle
function selectVehicle(){
	//Grabbing the requested vehicle id
	var vid = document.getElementById("editVehicleIDInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request
		xhr.open("GET", "php/selectVehicle.php?q=" + vid, true);
	
		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The PHP call returns an array so we catch it here
					//Then break set the appropriate form elements to their new values based on the array
					//Array values are in the order they appear in the database
					var jsonarray = JSON.parse(xhr.responseText);
					
					//If the result is null than it's an empty table
					if(jsonarray[0] != null){
						if(jsonarray.length == 1){
							//If the array's length is one than it is an error string so we display
							alert(xhr.responseText);
						} else {	
							document.getElementById("editDepartmentNameInput").value = jsonarray[1];
							document.getElementById("editMakeInput").value = jsonarray[2];
							document.getElementById("editModelInput").value = jsonarray[3];
							document.getElementById("editYearInput").value = jsonarray[4];
							document.getElementById("editVINInput").value = jsonarray[5];
							document.getElementById("editMileageInput").value = jsonarray[6];
							document.getElementById("editEngineInput").value = jsonarray[7];
							document.getElementById("editTiresInput").value = jsonarray[8];
							document.getElementById("editConditionInput").value = jsonarray[9];
							document.getElementById("editRequiredLicenseInput").value = jsonarray[10];
						}	
					} 
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send();
	}
}

//Sends a XMLHttp request to the server to use PHP to insert a record to the weekly checkup table
function insertCheckup(){
	//Collecting the vehicle id and current information
	var vid = document.getElementById("addVehicleIDInput").value;
	var mileage = document.getElementById("addCurrentMileageInput").value;
	var gas = document.getElementById("addCurrentGasPriceInput").value;
	var com = document.getElementById("addCurrentCommentsInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(vid);
	array.push(mileage);
	array.push(gas);
	array.push(com);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the values into a long data string for the query
		var dataString = 'vid=' + vid + '&mil=' + mileage + '&gas=' + gas + '&com=' + com;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Open the request and set the header
		xhr.open("POST", "php/insertWeeklyCheckUp.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to select the checkups related to the vehicle in question
function selectCheckup(checkupSelect, vehicleID){
	//This function is called by two different forms so we need to specify which elements we are using
	var vid = document.getElementById(vehicleID).value;
	
	//We don't validate anything because the actual query calls after the drop down as been filled
	var array = new Array();
		
	//If the Validation returns true we continue
	if(validateForm(array)){
		var datastring = 'vid=' + vid + '&cid=' + "*";

		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectCheckup.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							//Grabbing the dropdown we want to edit
							var checkupDrop = document.getElementById(checkupSelect);
							var string = "";
						
							//Loop to fill out the options for the drop down
							//We leave the value of each one as just the date of the record since we can pull the vehicleid from other elements in the form
							for(i = 0; i < jsonarray.length; i++){
								string += "<option value = '" + jsonarray[i][1] + "'>" + jsonarray[i][0] + ' ' + jsonarray[i][1] + "</option>";
							}
						
							//Update the select element with our new options
							checkupDrop.innerHTML = string;
						
							//Updating the form fields with the first element from the query
							selectCheckupDropDown();
						}
					} 
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
}

//Once the user picks a specific checkup up use we fill out the rest of the information
function selectCheckupDropDown(){
	var vid = document.getElementById("editVehicleIDInput").value;
	var cDate = document.getElementById("editCheckupInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		var dataString = 'vid=' + vid + '&cid=' + cDate;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectCheckup.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					var jsonarray = JSON.parse(xhr.responseText);
					//If the length is zero than it's an empty table
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array's length is one than it is an error string so we display
							alert(xhr.responseText);
						} else {	
							document.getElementById("editCurrentMileageInput").value = jsonarray[0][2];
							document.getElementById("editCurrentGasPriceInput").value = jsonarray[0][3];
							document.getElementById("editCurrentCommentsInput").value = jsonarray[0][4];
						}
					}
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to update a record in the checkup table
function updateCheckup(){
	var vid = document.getElementById("editVehicleIDInput").value;
	var cid = document.getElementById("editCheckupInput").value;
	var mileage = document.getElementById("editCurrentMileageInput").value;
	var gas = document.getElementById("editCurrentGasPriceInput").value;
	var comments = document.getElementById("editCurrentCommentsInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(vid);
	array.push(cid);
	array.push(mileage);
	array.push(gas);
	array.push(comments);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		var dataString = 'vid=' + vid + '&cid=' + cid + '&mileage=' + mileage + '&gas=' + gas + '&comments=' + comments;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request and setting the header
		xhr.open("POST", "php/updateCheckup.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to remove a record in the checkup table
function removeCheckup(){
	var vid = document.getElementById("removeVehicleIDInput").value;
	var cid = document.getElementById("removeCheckupInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(vid);
	array.push(cid);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		var dataString = 'vid=' + vid + '&cid=' + cid;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request and setting the header
		xhr.open("POST", "php/removeCheckup.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to select a vehicle
function selectPartialVehicle(formSet){
	//Grabbing the requested vehicle id
	if(formSet == "add"){
		var vid = document.getElementById("addVehicleIDInput").value;
	}
	if(formSet == "edit" || formSet == "vReport"){
		var vid = document.getElementById("editVehicleIDInput").value;
	}
	
	//We don't validate anything since this is called on change of a text field
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request
		xhr.open("GET", "php/selectVehicle.php?q=" + vid, true);
	
		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					var jsonarray = JSON.parse(xhr.responseText);
					//If the result is null than it's an empty table
					if(jsonarray[0] != null){
						if(jsonarray.length == 1){
							//If the array's length is one than it is an error string so we display
							alert(xhr.responseText);
						} else {
							//Decides which form we enter our query information into
							if(formSet == "add"){
								document.getElementById("addDepartmentNameInput").value = jsonarray[1];
								document.getElementById("addMakeInput").value = jsonarray[2];
								document.getElementById("addModelInput").value = jsonarray[3];
								document.getElementById("addYearInput").value = jsonarray[4];
								document.getElementById("addVINInput").value = jsonarray[5];
							}
							if(formSet == "edit"){
								document.getElementById("editDepartmentNameInput").value = jsonarray[1];
								document.getElementById("editMakeInput").value = jsonarray[2];
								document.getElementById("editModelInput").value = jsonarray[3];
								document.getElementById("editYearInput").value = jsonarray[4];
								document.getElementById("editVINInput").value = jsonarray[5];
							} if(formSet == "vReport") {
								document.getElementById("editDepartmentNameInput").value = jsonarray[1];
								document.getElementById("editMakeInput").value = jsonarray[2];
								document.getElementById("editModelInput").value = jsonarray[3];
								document.getElementById("editYearInput").value = jsonarray[4];
								document.getElementById("editVINInput").value = jsonarray[5];
								document.getElementById("editMileageInput").value = jsonarray[6];
							}
						}
					}
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send();
	}
}

//Sends a XMLHttp request to the sever to use PHP to add a maintenance appointment
function insertMaintenance(){
	//Getting id for the vehicle in question
	var vid = document.getElementById("addVehicleIDInput").value;
	
	//Getting all of the information needed for a maintenance appointment
	var laborCodeDiv = document.getElementsByClassName("addLaborCodeInputs");
	var mainDate = document.getElementById("addMaintenanceDateInput").value;
	var mechanic = document.getElementById("addMaintenanceMechanicInput").value;
	var mileage = document.getElementById("addMaintenanceMileageInput").value;
	var workType = document.getElementById("addMaintenanceWorkTypeInput").value;										
	var specialWork = document.getElementById("addMaintenanceSpecialWorkInput").value;
	var partsCost = document.getElementById("addMaintenancePartsCostInput").value;
	var laborCost = document.getElementById("addMaintenanceLaborCostInput").value;
	
	//Making a string for all our labor codes
	var laborCodes = "";
	for(var i = 0; i < laborCodeDiv.length; i++){
		laborCodes += laborCodeDiv[i].value + " ";
	}
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(vid);
	array.push(mainDate);
	array.push(laborCodes);
	array.push(mechanic);
	array.push(mileage);
	array.push(partsCost);
	array.push(laborCost);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the vehicle information into a string to send
		var dataString = 'vid=' + vid + '&laborCodes=' + laborCodes + '&mainDate=' + mainDate + '&mechanic=' + mechanic + '&workType=' + workType +
						 '&mileage=' + mileage + '&specialWork=' + specialWork + '&partsCost=' + partsCost + '&laborCost=' + laborCost;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Open the request and set the header
		xhr.open("POST", "php/insertMaintenance.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to update a record in the maintenance table
function updateMaintenance(){
	//Getting id for the vehicle in question
	var vid = document.getElementById("editVehicleIDInput").value;
	var mid = document.getElementById("editDateInput").value;
	
	//Getting all of the information needed for a maintenance appointment
	var laborCodeDiv = document.getElementsByClassName("editLaborCodeInputs");
	var mainDate = document.getElementById("editMaintenanceDateInput").value;
	var mechanic = document.getElementById("editMaintenanceMechanicInput").value;
	var mileage = document.getElementById("editMaintenanceMileageInput").value;
	var workType = document.getElementById("editMaintenanceWorkTypeInput").value;										
	var specialWork = document.getElementById("editMaintenanceSpecialWorkInput").value;
	var partsCost = document.getElementById("editMaintenancePartsCostInput").value;
	var laborCost = document.getElementById("editMaintenanceLaborCostInput").value;
	
	//Making a string for all our labor codes
	var laborCodes = "";
	for(var i = 0; i < laborCodeDiv.length; i++){
		laborCodes += laborCodeDiv[i].value + " ";
	}
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(vid);
	array.push(mid);
	array.push(mainDate);
	array.push(laborCodes);
	array.push(mechanic);
	array.push(mileage);
	array.push(partsCost);
	array.push(laborCost);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting the vehicle information into a string to send
		var dataString = 'mid=' + mid + '&vid=' + vid + '&laborCodes=' + laborCodes + '&mainDate=' + mainDate + '&mechanic=' + mechanic + '&workType=' + workType +
						 '&mileage=' + mileage + '&specialWork=' + specialWork + '&partsCost=' + partsCost + '&laborCost=' + laborCost;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Open the request and set the header
		xhr.open("POST", "php/updateMaintenance.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to remove a record in the maintenance table
function removeMaintenance(){
	var mainID = document.getElementById("removeDateInput").value;
	
	var datastring = 'mid=' + mainID;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(mainID);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the request and setting the header
		xhr.open("POST", "php/removeMaintenance.php?", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
}

//Sends a XMLHttp request to the server to use PHP to select the maintenance records related to the vehicle
function selectMaintenance(dateInput, vehicleId){
	//This function is called by two different forms so we need to specify which elements we are using
	var dateInput = document.getElementById(dateInput);
	var vid = document.getElementById(vehicleId).value;
	
	var datastring = 'vid=' + vid + '&mid=*';
	
	//We won't validate anything since this is called onchange of a text field
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectMaintenance.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);
					
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							var string = "";
							for(var i = 0; i < jsonarray.length; i++){
								string += "<option value = '" + jsonarray[i][0] + "'>" + jsonarray[i][4] + " " + jsonarray[i][5] + "</option>";
							}
						
							//Setting our dropdown and selecting the information for the first option
							dateInput.innerHTML = string;
							selectMaintenanceDropDown();
						}
					}
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
}

//Sends a XMLHttp request to the server to use PHP to select the record in question from the maintenance table
function selectMaintenanceDropDown(){
	//This function is called by two different forms so we need to specify which elements we are using
	var vid = document.getElementById("editVehicleIDInput").value
	var mid = document.getElementById("editDateInput").value;
	
	var datastring = 'vid=' + vid + '&mid=' + mid;
	
	//Making an array for our values to validate
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectMaintenance.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							var laborCodes = document.getElementsByClassName("editLaborCodeInputs");
							var databaseCodes = jsonarray[0][4].split(" ");
							
							for(var i = 0; i < databaseCodes.length; i++){
								if(laborCodes.length == databaseCodes.length){
									laborCodes[laborCodes.length-1].value = databaseCodes[i];
								} else {
									laborCodes[laborCodes.length-1].value = databaseCodes[i];
									addLaborInputField('edit');
								}
							}
							
							for(var i = 0; i < laborCodes.length; i++){
								laborCodes[i].onblur = function(){addLaborInputField('edit'); autocompleteLaborCodes('edit')};
							}
							
							document.getElementById("editLaborCodeInputs").value = jsonarray[0][4];
							document.getElementById("editMaintenanceDateInput").value = jsonarray[0][5];
							document.getElementById("editMaintenanceMechanicInput").value = jsonarray[0][2];
							document.getElementById("editMaintenanceMileageInput").value = jsonarray[0][3];
							document.getElementById("editMaintenanceWorkTypeInput").value = jsonarray[0][6];
							document.getElementById("editMaintenanceSpecialWorkInput").value = jsonarray[0][7];
							document.getElementById("editMaintenancePartsCostInput").value = jsonarray[0][8];
							document.getElementById("editMaintenanceLaborCostInput").value = jsonarray[0][9];
						}
					}
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
}

//Sends a XMLHttp request to the server to use PHP to select the whole maintenance table for a vehicle
function selectMaintenanceTable(vehicleID){
	//This function is called by two different forms so we need to specify which elements we are using
	var vid = document.getElementById(vehicleID).value;
	
	var datastring = 'vid=' + vid + '&mid=*';
	
	//Making an array for our values to validate
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectMaintenance.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);
					var mainTable = document.getElementById("maintenanceTable");
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							var string = "";
							
							string = "<tr>" +
									"<th>Maintenance ID</th>" +
									"<th>Vehicle ID</th>" +
									"<th>Mechanic</th>" +
									"<th>Mileage</th>" +
									"<th>Labor Codes</th>" +
									"<th>Date</th>" +
									"<th>Appointment Type</th>" +
									"<th>Special Work</th>" +
									"<th>Parts Cost</th>" +
									"<th>Labor Costs</th></tr>";
							
							var tableRow = "";
							for(var i = 0; i < jsonarray.length; i++){
								tableRow = "<tr>";
								for(var j = 0; j < jsonarray[0].length - 3; j++){
									if(j == 2){
										tableRow += "<td>" + jsonarray[i][11] + " " + jsonarray[i][12] + "</td>";
									} else {
										tableRow += "<td>" + jsonarray[i][j] + "</td>";
									}
								}
								tableRow += "</tr>";
								string += tableRow;
							}
							mainTable.innerHTML = string;
						}
					}
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
	
}

//Sends a XMLHttp request to the server to use PHP to select the whole maintenance table for a vehicle in a certain date range
function selectMaintenanceTableRange(vehicleID, start, end){
	//This function is called by two different forms so we need to specify which elements we are using
	var vid = document.getElementById(vehicleID).value;
	
	var datastring = 'vid=' + vid + '&mid=*' + '&sDate=' + start + '&eDate=' + end;
	
	//Making an array for our values to validate
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectMaintenanceTableRange.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);
					var mainTable = document.getElementById("vehicleMainTable");
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							var string = "";
							
							string = "<tr>" +
									"<th>Maintenance ID</th>" +
									"<th>Vehicle ID</th>" +
									"<th>Mechanic</th>" +
									"<th>Mileage</th>" +
									"<th>Labor Codes</th>" +
									"<th>Date</th>" +
									"<th>Appointment Type</th>" +
									"<th>Special Work</th>" +
									"<th>Parts Cost</th>" +
									"<th>Labor Costs</th></tr>";
							
							var tableRow = "";
							for(var i = 0; i < jsonarray.length; i++){
								tableRow = "<tr>";
								for(var j = 0; j < jsonarray[0].length - 3; j++){
									if(j == 2){
										tableRow += "<td>" + jsonarray[i][11] + " " + jsonarray[i][12] + "</td>";
									} else {
										tableRow += "<td>" + jsonarray[i][j] + "</td>";
									}
								}
								tableRow += "</tr>";
								string += tableRow;
							}
							mainTable.innerHTML = string;
						}
					}
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
	
}

//Sends a XMLHttp request to the server to use PHP to select the whole maintenance table for a license class
function selectMaintenanceTableClass(licenseClass, start, end){	
	if(licenseClass == "CLASS_ALL"){
		licenseClass = "*";
	}
	
	var datastring = 'licenseClass=' + licenseClass  + '&mid=*' + '&sDate=' + start + '&eDate=' + end;
	
	//Making an array for our values to validate
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectMaintenanceTableClass.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);
					var mainTable = document.getElementById("maintenanceTable");
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							var string = "";
							
							string = "<tr>" +
									"<th>Maintenance ID</th>" +
									"<th>Vehicle ID</th>" +
									"<th>Mechanic</th>" +
									"<th>Mileage</th>" +
									"<th>Labor Codes</th>" +
									"<th>Date</th>" +
									"<th>Appointment Type</th>" +
									"<th>Special Work</th>" +
									"<th>Parts Cost</th>" +
									"<th>Labor Costs</th></tr>";
							
							var tableRow = "";
							for(var i = 0; i < jsonarray.length; i++){
								tableRow = "<tr>";
								for(var j = 0; j < jsonarray[0].length; j++){
									if(j == 2){
										tableRow += "<td>" + jsonarray[i][11] + " " + jsonarray[i][12] + "</td>";
									} else if( j < 9){
										tableRow += "<td>" + jsonarray[i][j] + "</td>";
									}
								}
								tableRow += "</tr>";
								string += tableRow;
							}
							mainTable.innerHTML = string;
						}
					}
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
}

//Sends a XMLHttp request to the server to use PHP to select the appointments matching the date
function selectSchedule(){
	var date = document.getElementById("scheduleDateInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		var dataString = 'date=' + date;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectSchedule.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							//We send the array to a differnt function to make the calendar
							createCalendar(jsonarray);
						}
					} else {
						//Otherwise we clear the table
						setDefaultTable();
					} 
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sets the date pickers for the reports to the previous month
function setPreviousMonthDate(){
	//Grabbing todays date and setting the first and last days for the previous month
	var date = new Date();
	var firstDay = new Date(date.getFullYear(), date.getMonth() - 1, 01);
	var lastDay = new Date(date.getFullYear(), date.getMonth(), 00);
	
	//Grabbing the report elements we need
	var startList = document.getElementsByClassName("startReportDate");
	var endList = document.getElementsByClassName("endReportDate");
	
	//Loops through the two lists and sets them all to the date
	for(var i = 0; i < startList.length; i++){
		startList[i] = new Date();
		startList[i].valueAsDate = firstDay;
		
		endList[i] = new Date();
		endList[i].valueAsDate = lastDay;
	}
}

//Sends a XMLHttp request to the server to use PHP to select all of the departments from the department table
function selectAllDepartments(id){
	//Starting the ajax call
	var xhr;
	xhr = new XMLHttpRequest();
	
	var datastring = "did=*";
	
	//Opening the request
	xhr.open("POST", "php/selectDepartment.php?q=*", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;
	
	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				//Parse the result of the query
				var jsonarray = JSON.parse(xhr.responseText);
				//If the result is an array of length zero than the query was empty
				if(jsonarray.length != 0){
					if(jsonarray.length == 1){
						alert(xhr.responseText);
					} else {
						//Getting the element for the select options
						var departments = document.getElementById(id);
						var string = "";
						
						//Loops through the query result
						for(i = 0; i < jsonarray.length; i++){
							//Adding a html option element with the query information
							string += "<option value = '" + jsonarray[i][0] + "'>" + jsonarray[i][1] + "</option>";
						}
					
						//Adding all of the information to the element
						departments.innerHTML = string;
					}
				} 
			} else {
				alert("There was a problem with the request.");
			} 
		}
	}
	
	//Send the request
	xhr.send(datastring);
}

//Sends a XMLHttp request to the server to use PHP to select all of the mechanics from the mechanic table
function selectAllMechanics(id){
	//Starting the ajax call
	var xhr;
	xhr = new XMLHttpRequest();
	
	//Opening the request
	xhr.open("GET", "php/selectMechanic.php?q=*", true);
	
	//Set the function to call when the readystate changes
	xhr.onreadystatechange = display_data;
	
	function display_data(){
		if(xhr.readyState == 4){
			if(xhr.status == 200){
				//Parse the result of the query
				var jsonarray = JSON.parse(xhr.responseText);
				//If the result is an array of length zero than the query was empty
				if(jsonarray.length != 0){
					if(jsonarray.length == 1){
						alert(xhr.responseText);
					} else {
						//Getting the element for the select options
						var mechanics = document.getElementById(id);
						var string = "";
						
						//Loops through the query result
						for(i = 0; i < jsonarray.length; i++){
							//Adding a html option element with the query information
							string += "<option value = '" + jsonarray[i][0] + "'>" + jsonarray[i][1] + " " + jsonarray[i][2] + "</option>";
						}
					
						//Adding all of the information to the element
						mechanics.innerHTML = string;
					}
				} 
			} else {
				alert("There was a problem with the request.");
			} 
		}
	}
	
	//Send the request
	xhr.send();
}

//Sends a XMLHttp request to the server to use PHP to select all of the mechanics from the mechanic table
function insertAppointment(){
	//Gathering the appointment information
	var date = document.getElementById("addScheduleDateInput").value;
	var vid = document.getElementById("addVehicleIDInput").value;
	var mec = document.getElementById("addMechanicNameInput").value;
	var startTime = document.getElementById("addScheduleTimeStartInput").value;
	var timeMinutes = document.getElementById("addScheduleTimeRequired").value;
	var desc = document.getElementById("addScheduleDescription").value;
	
	var timeRequiredHours = Math.floor(timeMinutes/60);
	var timeRequiredMinutes = timeMinutes - timeRequiredHours*60;
	
	var timeRequired = timeRequiredHours + ":" + timeRequiredMinutes + ":" + 00;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(date);
	array.push(vid);
	array.push(mec);
	array.push(startTime);
	array.push(timeMinutes);
	array.push(desc);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting all of the information into a string
		var dataString = 'date=' + date + '&vid=' + vid + '&mec=' + mec + '&startTime=' + startTime + '&timeRequired=' + timeRequired + '&desc=' + desc;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Open the request and set the header
		xhr.open("POST", "php/insertAppointment.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
}

//Sends a XMLHttp request to the server to use PHP to update a record in the schedule table
function updateAppointment(){
	//Gathering the appointment information
	var date = document.getElementById("editScheduleDateInput").value;
	var sid = document.getElementById("scheduleDateInput").value;
	var vid = document.getElementById("editVehicleIDInput").value;
	var mec = document.getElementById("editMechanicNameInput").value;
	var startTime = document.getElementById("editScheduleTimeStartInput").value;
	var timeMinutes = document.getElementById("editScheduleTimeRequired").value;
	var desc = document.getElementById("editScheduleDescription").value;
	
	var timeRequiredHours = Math.floor(timeMinutes/60);
	var timeRequiredMinutes = timeMinutes - timeRequiredHours*60;
	
	var timeRequired = timeRequiredHours + ":" + timeRequiredMinutes + ":" + 00;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(date);
	array.push(vid);
	array.push(sid);
	array.push(mec);
	array.push(startTime);
	array.push(timeMinutes);
	array.push(desc);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting all of the information into a string
		var dataString = 'sid=' + sid + '&date=' + date + '&vid=' + vid + '&mec=' + mec + '&startTime=' + startTime + '&timeRequired=' + timeRequired + '&desc=' + desc;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Open the request and set the header
		xhr.open("POST", "php/updateAppointment.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}
	
}

//Sends a XMLHttp request to the server to use PHP to remove a record in the schedule table
function removeAppointment(){
	var sid = document.getElementById("removeScheduleDateInput").value;
	
	//Making an array for our values to validate
	var array = new Array();
	array.push(sid);
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Putting all of the information into a string
		var dataString = 'sid=' + sid;
	
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Open the request and set the header
		xhr.open("POST", "php/removeAppointment.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
		//Set the function to do when the readystate changes
		xhr.onreadystatechange = display_data;
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					alert(xhr.responseText);
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(dataString);
	}

}

//Sends a XMLHttp request to the server to use PHP to select all records associated with a vehicle in the schedule table
function selectAppointment(vehicleID, dateInput){
	//This function is called by two different forms so we need to specify which elements we are using
	var dateInput = document.getElementById(dateInput);
	var vid = document.getElementById(vehicleID).value;
	
	var datastring = 'vid=' + vid + '&sid=*';
	
	//We don't validate anything since this is called onchange of a text field
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectAppointment.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);
					
					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							var string = "";
							for(var i = 0; i < jsonarray.length; i++){
								string += "<option value = '" + jsonarray[i][0] + "'>" + jsonarray[i][3] + " " + jsonarray[i][4] + "</option>";
							}
						
							//Setting our dropdown and selecting the information for the first option
							dateInput.innerHTML = string;
							if(dateInput.id != "removeScheduleDateInput"){
								selectAppointmentDropDown();
							}
						}
					} 
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
}

//Sends a XMLHttp request to the server to select a specific appointment from the schedule table
function selectAppointmentDropDown(){
	//This function is called by two different forms so we need to specify which elements we are using
	var sid = document.getElementById('scheduleDateInput').value;
	
	var datastring = 'vid=-1' + '&sid=' + sid;
	
	//Making an array for our values to validate
	var array = new Array();
	
	//If the Validation returns true we continue
	if(validateForm(array)){
		//Starting the ajax call
		var xhr;
		xhr = new XMLHttpRequest();
	
		//Opening the Request and setting the header
		xhr.open("POST", "php/selectAppointment.php", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

		//Set the function to call when the readystate changes
		xhr.onreadystatechange = display_data;
	
		function display_data(){
			if(xhr.readyState == 4){
				if(xhr.status == 200){
					//The php call returns a multi-dimensional array so we catch it here
					var jsonarray = JSON.parse(xhr.responseText);

					//If the result is an array of length zero than the query was empty
					if(jsonarray.length != 0){
						if(jsonarray[0].length == 1){
							//If the array length is 1 than it is an error string
							alert(xhr.responseText);
						} else {
							//Gathering the appointment information
							document.getElementById("editScheduleDateInput").value = jsonarray[0][3];
							document.getElementById("editMechanicNameInput").value = jsonarray[0][2];
							document.getElementById("editScheduleTimeStartInput").value = jsonarray[0][4];
							document.getElementById("editScheduleDescription").value = jsonarray[0][6];

							//Converting the hh:mm:ss format to just mm
							var timeRequired = jsonarray[0][5];
							var timeComponentsArray = timeRequired.split(":");
							var timeHours = parseInt(timeComponentsArray[0]);
							var timeMinutes = parseInt(timeComponentsArray[1]);
							var appLength = Number(timeHours*60 + timeMinutes);
							
							document.getElementById("editScheduleTimeRequired").value = appLength;
						}
					}
				} else {
					alert("There was a problem with the request.");
				} 
			}
		}
	
		//Send the request
		xhr.send(datastring);
	}
}

//Creates the calender for the schedule page
function createCalendar(jsonarray){
	//Setting up the times for the table
	setDefaultTable();
	
	//Getting all unique mechanics from the array
	var mechanicArray = new Array();
	var firstName = "";
	var lastName = "";
	var name = "";
	
	//Decides wether or not we should enter the mechanic to the array
	var dontEnter = false;
	
	//Loops through all of the rows from the sql query
	for(var i = 0; i < jsonarray.length; i++){
		//Gathering the mechanics information
		firstName = jsonarray[i][8];
		lastName = jsonarray[i][9];
		name = firstName + " " + lastName;
		
		//Resetting the variable
		dontEnter = false;
		
		//Loops through the whole of the mechanic array
		for(var k = 0; k < mechanicArray.length; k++){
			//Checks if the mechanic already exists in the array
			if(mechanicArray[k] == name){
				dontEnter = true;
			} 
		}
		
		//If they arent, then we enter the new mechanic to the end of the array
		if(!dontEnter){
			mechanicArray.push(name);
		}
	}
	
	//Writing the headers for our schedule table
	for(var i = 0; i < mechanicArray.length; i++){
		document.getElementById("mechanics").innerHTML += "<th id ='" + mechanicArray[i] + "'>" + mechanicArray[i] + "</th>";
	}
	
	//Spot is which time the appointment goes too
	var spot;
	
	//Stores the time and appointment length of every appointment we enter
	var appointmentArray = new Array();
	
	//Loops through the query result
	for(var i = 0; i < jsonarray.length; i ++){
		//Various variables needed
		
		//Gathering mechanic information
		firstName = jsonarray[i][8];
		lastName = jsonarray[i][9];
		name = firstName + " " + lastName;
		var mechanic = name; //Which mechanic we are currently on
		var indexMechanic = mechanicArray.indexOf(mechanic);
		
		//The time required is stored in sql time format eg 23:00:00
		//So we parse it into it's three parts and take the hours and minutes out
		//The Schedule table is in 30 minute increments so convert the hours to half hours and add it to the minutes
		//json returns a string so we parse it into it's components to get the time
		var timeRequired = jsonarray[i][5]; 
		var timeComponentsArray = timeRequired.split(":");
		var timeHours = parseInt(timeComponentsArray[0]);
		var timeMinutes = parseInt(timeComponentsArray[1]);
		var appLength = Number(timeHours*60 + timeMinutes);
		
		//Converts the time required to how many 30 minute increments it is. We round up just to make the table neater.
		appLength = Math.ceil(appLength / 30); 
		
		//Changes our spot to the new one
		spot = document.getElementById(jsonarray[i][4]);
		
		//Getting our start time and calculating the end time
		var mechanicTime = jsonarray[i][4].split(":");
		var mechanicStartHour = Number(mechanicTime[0]);
		var mechanicStartMinutes = Number(mechanicTime[1]);
		var mechanicStartTime = mechanicStartHour*60 + mechanicStartMinutes;
		var mechanicEndTime = mechanicStartTime + appLength*30;
		
		//Holds the largest index of the appointments to the left of our current one
		var lastFilledAppointment = -1;
		var filledSpots = 0;
		
		//Loops through our appointments array to calculate the number of filled slots
		for(var j = 0; j < appointmentArray.length; j++){
			//Variables to hold the time information for the appointments we've already entered
			var time = appointmentArray[j][0].split(":");
			var startTimeHour = Number(time[0]);
			var startTimeMinutes = Number(time[1]);
			var startTime = startTimeHour*60 + startTimeMinutes;
			var endTime = startTime + appointmentArray[j][1]*30;
			
			//Checks if our appointment starts during another appointment. Basically if there is a filled spot to the
			//left of our appointment start time
			//If either is true that counts as a filled spot so increment that variable
			if(mechanicStartTime < endTime && mechanicStartTime >= startTime){
				//Count of the number of filled spots to the left of our start time
				filledSpots++;
			}
		}
		
		//Temp array to hold the appointment information
		var tempArray = new Array();
		
		//For the appointments to fall beneath the correct header we want an equal number of filled 
		//spots as equal to our index in the mechanic list
		//So this loop adds in empty cells until our counts are equal, html will automatically place the empty into the
		//first available cell in the row
		var count = filledSpots;
		while((count) < indexMechanic){
			spot.innerHTML += "<td></td>";
			count++;
			
			//We just push our information into the temp array then into the appointment array
			//This keeps the filled spots in the row correct
			tempArray.push(jsonarray[i][4]);
			tempArray.push(1);
			tempArray.push(indexMechanic);
			appointmentArray.push(tempArray);
			//Emptying the temp array for use later
			tempArray = new Array();
		}
		
		//Writing our information
		spot.innerHTML += "<td class = 'appointments' headers = '" + mechanicArray[indexMechanic] + "' rowspan = '" + appLength + "'>"+"Vehicle ID =" + jsonarray[i][1] + "<br>Description: " + jsonarray[i][6] + "<br>Start Time: " + jsonarray[i][4] + "</td>";
		
		
		
		//Adding all of the appointment information to the array
		tempArray.push(jsonarray[i][4]);
		tempArray.push(appLength);
		tempArray.push(indexMechanic);
		
		//We add this information to our appointments array
		appointmentArray.push(tempArray);
	}
}

//Gets the current date and sets the schedule input to it
function setCurrentDate(id){
	document.getElementById(id).valueAsDate = new Date()
}

//Sets the first spot of the table up with the times
function setDefaultTable(){
	document.getElementById("calendar").innerHTML = "<tr id = 'mechanics'><th>Time</th></tr>" +
													"<tr id = 07:00:00><td>07:00</td></tr>" +
													"<tr id = 07:30:00><td>07:30</td></tr>" +
													"<tr id = 08:00:00><td>08:00</td></tr>" +
													"<tr id = 08:30:00><td>08:30</td></tr>" +
													"<tr id = 09:00:00><td>09:00</td></tr>" +
													"<tr id = 09:30:00><td>09:30</td></tr>" +
													"<tr id = 10:00:00><td>10:00</td></tr>" +
													"<tr id = 10:30:00><td>10:30</td></tr>" +
													"<tr id = 11:00:00><td>11:00</td></tr>" +
													"<tr id = 11:30:00><td>11:30</td></tr>" +
													"<tr id = 12:00:00><td>12:00</td></tr>" +
													"<tr id = 12:30:00><td>12:30</td></tr>" +
													"<tr id = 13:00:00><td>13:00</td></tr>" +
													"<tr id = 13:30:00><td>13:30</td></tr>" +
													"<tr id = 14:00:00><td>14:00</td></tr>" +
													"<tr id = 14:30:00><td>14:30</td></tr>" +
													"<tr id = 15:00:00><td>15:00</td></tr>" +
													"<tr id = 15:30:00><td>15:30</td></tr>" +
													"<tr id = 16:00:00><td>16:00</td></tr>" +
													"<tr id = 16:30:00><td>16:30</td></tr>" +
													"<tr id = 17:00:00><td>17:00</td></tr>" +
													"<tr id = 17:30:00><td>17:30</td></tr>" +
													"<tr id = 18:00:00><td>18:00</td></tr>"
}