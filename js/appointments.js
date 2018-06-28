var day_list = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
var month_list = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

//Note: some variables are taken from footer of home(includes/footer);

var tempMonth;
var tempYear;
var flag=0;

function initialisePage(){

	first_date=1;
	firstDay = new Date(currYear,currMonth,first_date).getDay();
  console.log("working");
  tempMonth = currMonth;
  tempYear = currYear;

	initialise_cal(firstDay,1,currMonth,currYear);

}

function initialise_cal(firstDay,date,month,year){

	initday = day_finder(firstDay);

	document.getElementById("monthDisp").innerHTML = month_list[month];
	document.getElementById("yearDisp").innerHTML = year;
	drawCalendar(initday,date,month,year);

}

function day_finder(firstDay){

  switch(firstDay){
    case 0: return 0;
            break;
    case 1: return 1;
            break;
    case 2: return 2;
            break;
    case 3: return 3;
            break;
    case 4: return 4;
            break;
    case 5: return 5;
            break;
    case 6: return 6;
            break;



  }

}

function drawCalendar(start,date,month,year){
  console.log("working");

  if(flag){
    //resetting...
    for(j=1;j<7;j++){
      for(i=0;i<7;i++){
        document.getElementById("r"+j+"c"+i).innerHTML = "";
        document.getElementById("r"+j+"c"+i).style.background = "none";
        document.getElementById("r"+j+"c"+i).removeEventListener("click",dateClick,false);
        document.getElementById("r"+j+"c"+i).removeEventListener("mouseenter",dateMouseEnter,false);
        document.getElementById("r"+j+"c"+i).removeEventListener("mouseenter",dateMouseLeave,false);

      }
    }
  }


	var temp=1;
  var i = start;

	for(var j=1;j<7;j++){
		for(;i<7;i++){

      if(temp<=endOfMonth(month,year)){
        document.getElementById("r"+j+"c"+i).innerHTML = temp;

        if(month==currMonth && year==currYear && temp==currDate){
          document.getElementById("r"+j+"c"+i).style.background = "yellow";
        }
        temp++;
      }
      document.getElementById("r"+j+"c"+i).addEventListener("click",dateClick,false);
      document.getElementById("r"+j+"c"+i).addEventListener("mouseenter",dateMouseEnter,false);
      document.getElementById("r"+j+"c"+i).addEventListener("mouseleave",dateMouseLeave,false);
		}
		i=0;
	}
}

document.getElementById("prevMonth").addEventListener("click",function(){
  flag=1;
	first_date=1;
	if(tempMonth!=0){
		tempMonth--;
	}
	else{
		tempMonth=11;
		tempYear--;
	}

	firstDay = new Date(tempYear,tempMonth,first_date).getDay();
	initialise_cal(firstDay,first_date,tempMonth,tempYear);

},false);

document.getElementById("nextMonth").addEventListener("click",function(){
  flag=1;
	first_date=1;
	if(tempMonth!=11){
		tempMonth++;
	}
	else{
		tempMonth=0;
		tempYear++;
	}

	firstDay = new Date(tempYear,tempMonth,first_date).getDay();
	initialise_cal(firstDay,first_date,tempMonth,tempYear);

},false);

function endOfMonth(month,year){

  if(month!=1){
    switch(month){
      case 0:
      case 2:
      case 4:
      case 6:
      case 7:
      case 9:
      case 11:return 31;
              break;
      case 3:
      case 5:
      case 8:
      case 10:return 30;
              break;

    }

  }
  else{
    if(isItLeapYear(year)==true){
      return 29;
    }
    else{
      return 28;
    }
  }
}

function isItLeapYear(year){
  if(year%100==0){
    if(year%400==0)return true;
  }
  else if(year%4==0)return true;
        else return false;
}

function dateClick(e){
  window.location = "home.php?date="+ tempYear + "-" + (tempMonth+1) + "-" + this.innerHTML;
}
function dateMouseEnter(e){
  if(e.target.innerHTML!="" && e.target.innerHTML!=currDate){
      e.target.style.background = "brown";
      console.log("coloration working");
  }

}
function dateMouseLeave(e){
  if(e.target.innerHTML!="" && e.target.innerHTML!=currDate)
  e.target.style.background = "none";
}


initialisePage();
