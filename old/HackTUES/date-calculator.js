var clock;

$(document).ready(function() {

	var currentDate = new Date();

	var futureDate  = new Date(2015, 5, 26, 8, 0, 0, 0);
	var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

	clock = $('.clock').FlipClock(diff, {
		clockFace: 'DailyCounter',
		countdown: true
	});
});