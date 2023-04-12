<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>ROI</title>

    <link href="/css/grid.css" rel="stylesheet" type="text/css" />
    <link href="/css/roi.css" rel="stylesheet" type="text/css" />
    <link href="/css/tooltipster.css" rel="stylesheet" type="text/css" />

</head>
<body id="roi-calculator">

<?php 

    if( isset( $_GET['results'] ) ) 
    {    
        include 'results.php';
    } else {
        include 'calculator.php';
    }        
?>

<script type="text/javascript" src="/js/roi.js"></script>
<script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/js/jquery.tooltipster.min.js"></script>
<script type="text/javascript" src="/js/canvasjs.min.js"></script>
<script>
$(document).ready(function() {
	
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

});
</script>
<script type="text/javascript">
	window.onload = function () {
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
</script>
</body>
</html>