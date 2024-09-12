jQuery(document).ready(function($)
{
	$('#clock-brasil').thooClock({
		size:150,
		showNumerals:false,
		dialColor:'#FFFFFF',
		secondHandColor:'#0ea154',
		minuteHandColor:'#FFFFFF',
		hourHandColor:'#FFFFFF',
		hourCorrection:'+4',
	});

	$('#clock-dubai').thooClock({
		size:150,
		showNumerals:false,
		dialColor:'#FFFFFF',
		secondHandColor:'#0ea154',
		minuteHandColor:'#FFFFFF',
		hourHandColor:'#FFFFFF',
		hourCorrection:'+11',
	});

	$('#clock-hongkong').thooClock({
		size:150,
		showNumerals:false,
		dialColor:'#FFFFFF',
		secondHandColor:'#0ea154',
		minuteHandColor:'#FFFFFF',
		hourHandColor:'#FFFFFF',
		hourCorrection:'+3',
	});
	

});