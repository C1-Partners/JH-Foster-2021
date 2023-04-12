
var datapoints = datapoints || [];

var info = document.getElementById("info"),
    brk1 = document.getElementById("break1"),
    brk2 = document.getElementById("break2"),
    put2 = document.getElementById("answer2"),
    put3 = document.getElementById("answer3");

if ( info ) { 

    var dataset = function(i, d) { 
        return i.dataset ? i.dataset[d] : i.getAttribute('data-' + d);
    }
    
    //One month is approximately 8.34% of a year. - 8.34 x 12 = 100.08 (close enough)
    var brk = (dataset(info, 'breakeven') / 8.33) * 100,       
        year = Math.floor(brk / 12),
        mths = Math.ceil(brk % 12);

    brk1.innerHTML = year;
    brk2.innerHTML = mths;
    put2.innerHTML = dataset(info, 'laborsavings');
    put3.innerHTML = dataset(info, 'productivitysavings');
}

function recalc() {
	document.getElementById('recalc').submit();
}
    	
function formatNumberWithCommas(fid) {
	var newString=document.getElementById(fid).value.trim();
	newString=newString.replace(/\D/g,'');
    newString=newString.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	document.getElementById(fid).value=newString;
}

function checkForm() {
	var error=false;
	var error_message='';
	var focus_set=false; 

	var tts=document.getElementById('system_costs').value.trim();
	if (tts == '') {
		error=true;
	    error_message=error_message +'\nPlease enter the total system costs.';
		if (!focus_set) {
			document.getElementById('system_costs').focus();
			focus_set=true;
			}
		} else if (tts.match(/[^,\d]/)) {
		error=true;
	    error_message=error_message +'\nThe total system cost must be a whole dollar amount greater than 0.';
		if (!focus_set) {
			document.getElementById('total_system_cost').focus();
			focus_set=true;
			}
	} else if (tts < 1) {
		error=true;
	    error_message=error_message +'\nThe total system cost must be a whole dollar amount greater than 0.';
		if (!focus_set) {
			document.getElementById('total_system_cost').focus();
			focus_set=true;
			}
	}

	var nor=document.getElementById('number_of_robots').value.trim();
	if (nor == '') {
		error=true;
	    error_message=error_message +'\nPlease enter the number of robots.';
		if (!focus_set) {
			document.getElementById('number_of_robots').focus();
			focus_set=true;
			}
		} else if (nor.match(/[^,\d]/)) {
		error=true;
	    error_message=error_message +'\nThe number of robots must be a whole number greater than 0.';
		if (!focus_set) {
			document.getElementById('number_of_robots').focus();
			focus_set=true;
			}
	} else if (nor < 1) {
		error=true;
	    error_message=error_message +'\nThe number of robots must be a whole number greater than 0.';
		if (!focus_set) {
			document.getElementById('number_of_robots').focus();
			focus_set=true;
			}
	}

	var spd=document.getElementById('shifts_per_day').value.trim();
	if (spd == '') {
		error=true;
	    error_message=error_message +'\nPlease enter the number of shifts per day.';
		if (!focus_set) {
			document.getElementById('shifts_per_day').focus();
			focus_set=true;
			}
		} else if (spd.match(/[^,\d]/)) {
		error=true;
	    error_message=error_message +'\nThe number of shifts per day must be a whole number greater than 0.';
		if (!focus_set) {
			document.getElementById('shifts_per_day').focus();
			focus_set=true;
			}
	} else if (spd < 1) {
		error=true;
	    error_message=error_message +'\nThe number of shifts per day must be a whole number greater than 0.';
		if (!focus_set) {
			document.getElementById('shifts_per_day').focus();
			focus_set=true;
			}
	}

	var dpw=document.getElementById('days_per_week').value.trim();
	if (dpw == '') {
		error=true;
	    error_message=error_message +'\nPlease enter the number of days per week.';
		if (!focus_set) {
			document.getElementById('days_per_week').focus();
			focus_set=true;
			}
		} else if (dpw.match(/[^,\d]/)) {
		error=true;
	    error_message=error_message +'\nThe number of number of days per week must be a whole number from 1 to 7.';
		if (!focus_set) {
			document.getElementById('days_per_week').focus();
			focus_set=true;
			}
	} else if (dpw < 1 || dpw > 7) {
		error=true;
	    error_message=error_message +'\nThe number of shifts per day must be a whole number from 1 to 7.';
		if (!focus_set) {
			document.getElementById('days_per_week').focus();
			focus_set=true;
			}
	}

	var wpy=document.getElementById('weeks_per_year').value.trim();
	if (wpy == '') {
		error=true;
	    error_message=error_message +'\nPlease enter the number of weeks per year.';
		if (!focus_set) {
			document.getElementById('weeks_per_year').focus();
			focus_set=true;
			}
		} else if (wpy.match(/[^,\d]/)) {
		error=true;
	    error_message=error_message +'\nThe number of number of weeks per year must be a whole number from 1 to 52.';
		if (!focus_set) {
			document.getElementById('weeks_per_year').focus();
			focus_set=true;
			}
	} else if (wpy < 1 || wpy > 52) {
		error=true;
	    error_message=error_message +'\nThe number of weeks per year must be a whole number from 1 to 52.';
		if (!focus_set) {
			document.getElementById('weeks_per_year').focus();
			focus_set=true;
			}
	}

	var alc=document.getElementById('annaul_labor_costs').value.trim();
	if (alc == '') {
		error=true;
	    error_message=error_message +'\nPlease enter the annual labor costs.';
		if (!focus_set) {
			document.getElementById('annaul_labor_costs').focus();
			focus_set=true;
			}
		} else if (alc.match(/[^,\d]/)) {
		error=true;
	    error_message=error_message +'\nThe annual labor cost must be a whole dollar amount greater than 0.';
		if (!focus_set) {
			document.getElementById('annaul_labor_costs').focus();
			focus_set=true;
			}
	} else if (alc < 1) {
		error=true;
	    error_message=error_message +'\nThe annual labor cost must be a whole dollar amount greater than 0.';
		if (!focus_set) {
			document.getElementById('annaul_labor_costs').focus();
			focus_set=true;
			}
	}

	var opsr=document.getElementById('operators_per_shift_removed').value.trim();
	if (opsr == '') {
		error=true;
	    error_message=error_message +'\nPlease enter the number of operators per shift removed.';
		if (!focus_set) {
			document.getElementById('operators_per_shift_removed').focus();
			focus_set=true;
			}
		} else if (opsr.match(/[^,\d]/)) {
		error=true;
	    error_message=error_message +'\nThe number of operators per shift removed must be a whole number greater than 0.';
		if (!focus_set) {
			document.getElementById('operators_per_shift_removed').focus();
			focus_set=true;
			}
	} else if (opsr < 1) {
		error=true;
	    error_message=error_message +'\nThe number of operators per shift removed must be a whole number greater than 0.';
		if (!focus_set) {
			document.getElementById('operators_per_shift_removed').focus();
			focus_set=true;
			}
	}

	var plr=document.getElementById('percent_of_labor_retained').value.trim();
	if (plr == '') {
		error=true;
	    error_message=error_message +'\nPlease enter the percent of labor retained.';
		if (!focus_set) {
			document.getElementById('percent_of_labor_retained').focus();
			focus_set=true;
			}
		} else if (plr.match(/[^,\d]/)) {
		error=true;
	    error_message=error_message +'\nThe percent of labor retained must be a whole number percentage from 1 to 100.';
		if (!focus_set) {
			document.getElementById('percent_of_labor_retained').focus();
			focus_set=true;
			}
	} else if (plr < 1 || plr > 100) {
		error=true;
	    error_message=error_message +'\nThe percent of labor retained must be a whole number percentage from 1 to 100.';
		if (!focus_set) {
			document.getElementById('percent_of_labor_retained').focus();
			focus_set=true;
			}
	}

	var epg=document.getElementById('expected_productivity_gain').value.trim();
	if (epg == '') {
		error=true;
	    error_message=error_message +'\nPlease enter the expected productivity gain.';
		if (!focus_set) {
			document.getElementById('expected_productivity_gain').focus();
			focus_set=true;
			}
		} else if (epg.match(/[^,\d]/)) {
		error=true;
	    error_message=error_message +'\nThe expected productivity gain must be a whole number percentage from 1 to 100.';
		if (!focus_set) {
			document.getElementById('expected_productivity_gain').focus();
			focus_set=true;
			}
	} else if (epg < 1 || epg > 100) {
		error=true;
	    error_message=error_message +'\nThe expected productivity gain must be a whole number percentage from 1 to 100.';
		if (!focus_set) {
			document.getElementById('expected_productivity_gain').focus();
			focus_set=true;
			}
	}

	var oes=document.getElementById('other_savings').value.trim();
	if (oes == '') {
		error=true;
	    error_message=error_message +'\nPlease enter the other estimated savings.';
		if (!focus_set) {
			document.getElementById('other_savings').focus();
			focus_set=true;
			}
		} else if (oes.match(/[^-,\d]/)) {
		error=true;
	    error_message=error_message +'\nThe other estimated savings must be a whole dollar and may be negative.';
		if (!focus_set) {
			document.getElementById('other_savings').focus();
			focus_set=true;
			}
		}

	if (error) {
		alert(error_message);
		return false;
	} else {
		return true;
	}
}

(function($){

	$('.systemcosttip').tooltipster({
	   theme: 'tooltipster-light',
	   maxWidth:300,
	   position:'top',
       content: $('<div class="roi-tip"><p>System costs include TOTAL system, including robot(s), installation, training, and spare parts.</p></div>')
    });

	$('.roicharttip').tooltipster({
	 theme: 'tooltipster-light',
	 maxWidth:300,
	 position:'top',
     content: $('<div class="roi-tip"><p>This analysis illustrates the REAL value of a robotic system based on comparing the operating costs of a robot to those of manual labor over an extended life of a project.  A typical medium-size robot (11-200 kg payload) currently costs about 50 cents per hour to operate (energy consumption), while manual labor costs are many times greater than this.  The Robotic System Value Calculator details the DRAMATIC cash flow savings that occur over the 10-15 year life of a robot.  An example system with medium-size robots is presented, and the user can input values for specific applications to analyze the resultant expected cash flow and return-on-investment for automation projects.  </p></div>')
    });
			
    $('.system').tooltipster({
	 theme: 'tooltipster-light',
	 maxWidth:300,
	 position:'top',
     content: $('<div class="roi-tip"><p>System costs include TOTAL system, including robot(s), installation, training, and spare parts.</p></div>')
    });

    $('.maintenance').tooltipster({
	 theme: 'tooltipster-light',
	 maxWidth:300,
	 position:'top',
     content: $('<div class="roi-tip"><p>Robots are extremely reliable and their maintenance costs are minimal.  For the first 5 years, typical maintenance costs are about $500 for lubrication and possible battery maintenance.  Depending on the application, in the 5th year some replacement of wear parts may be expected and this is reflected in the example as a cost of $5,000 per robot.  At year 10, some applications may require refurbishment of the robot and this is reflected in the example as a cost of $30,000 per medium-size robot.</p></div>')
            });
			
 $('.operating').tooltipster({
	 theme: 'tooltipster-light',
	 maxWidth:300,
	 position:'top',
     content: $('<div class="roi-tip"><p>Medium-size robots cost about 50 cents per hour to operate, based on the most recent cost for industrial electricity of 10 cents per KWH and average robot usage of 5 KW.  Smaller robots (1-10 kg payload) consume about 1/5 the amount of energy for a cost of about 10 cents per hour, while larger robots (200-1000 kg payload) use about twice as much energy for a cost of $1 per hour. The calculator assumes 2% annual inflation in electrical power costs.</p></div>')
    });

    $('.labor').tooltipster({
	 theme: 'tooltipster-light',
	 maxWidth:300,
	 position:'top',
     content: $('<div class="roi-tip"><p>These costs should reflect the annual cost of an operator including benefits. The calculator assumes 2% annual inflation in labor costs.</p></div>')
    });	

    $('.productivity').tooltipster({
	 theme: 'tooltipster-light',
	 maxWidth:300,
	 position:'top',
     content: $('<div class="roi-tip"><p>The expected percentage productivity gain should be an evaluated. This normally results from two factors: (1) a robot can work at a faster pace than an operator, especially when heavy parts are being handled; and (2) manual labor breaks and other downtime are eliminated.  The calculator determines how much additional labor would be required for the same output as the robot system and the associated cost savings.</p></div>')
    });	
    
})(jQuery);

window.onload = function() {
        
	var chart = new CanvasJS.Chart("chartContainer",
	{
		zoomEnabled: false,
        animationEnabled: true,
		title:{
			text: "Robotic System Cumulative Cash Flow"
		},
		axisY2:{
			//valueFormatString:"0.0 bn",
			
			maximum: 1.2,
			interval: .2,
			interlacedColor: "#F5F5F5",
			gridColor: "#D7D7D7",      
 			tickColor: "#D7D7D7"								
		},
                    theme: "theme2",
                    toolTip:{
                        shared: true
                    },
		legend:{
			verticalAlign: "bottom",
			horizontalAlign: "center",
			fontSize: 15,
			fontFamily: "Lucida Sans Unicode"

		},
		data: [
		{        
			type: "line",
			lineThickness:3,
			axisYType:"primary",
			showInLegend: true,           
			name: "Cumulative Cash Flow", 
			dataPoints: datapoints 
		},
		],
      legend: {
        cursor:"pointer",
        itemclick : function(e) {
          if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
          e.dataSeries.visible = false;
          }
          else {
            e.dataSeries.visible = true;
          }
          chart.render();
        }
      }
    });

    chart.render();
}