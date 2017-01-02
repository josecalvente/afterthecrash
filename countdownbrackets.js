function updateTimer(deadline){
	var time = deadline - new Date ();
	return {
		"days": Math.floor( time/(1000*60*60*24) ),
		"hours": Math.floor( (time/(1000*60*60)) % 24 ),
		"total": time
	};
}
function startTimer(id, deadline){
	var timerInterval = setInterval(function(){
		var clock = document.getElementById(id);
		var timer = updateTimer(deadline);

clock.innerHTML = "<span>" + timer.days + "</span>"
                +  "<span>" + timer.hours + "</span>"               	
	if(timer.total < 1){
		clearInterval(timerInterval);
		clock.innerHTML = "<span>0</span><span>0</span>";
	}
	}, 1000);
}

function updateTimer(deadline){
	var time = deadline - new Date ();
	return {
		"days": Math.floor( time/(1000*60*60*24) ),
		"hours": Math.floor( (time/(1000*60*60)) % 24 ),
		"total": time
	};
}
function startTimer(id, deadline){
	var timerInterval = setInterval(function(){
		var clock = document.getElementById(id);
		var timer = updateTimer(deadline);

clock.innerHTML = "<span>" + timer.days + "</span>"
                +  "<span>" + timer.hours + "</span>"               	
	if(timer.total < 1){
		clearInterval(timerInterval);
		clock.innerHTML = "<span>0</span><span>0</span>";
	}
	}, 1000);
}
window.onload = function(){
	var deadline = new Date("January 15, 2018 00:00:00");
	startTimer("clock", deadline);
    var deadline = new Date("May 31, 2018 00:00:00");
	startTimer("clockTwo", deadline);


};





