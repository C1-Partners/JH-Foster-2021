
<form action="/?results" id="recalc" method="post">
	
    <input type="hidden" name="system_cost" value="250,000">
    <input type="hidden" name="number_of_robots" value="2">
    <input type="hidden" name="shifts_per_day" value="2">
    <input type="hidden" name="days_per_week" value="5">
    <input type="hidden" name="weeks_per_year" value="50">
    <input type="hidden" name="annaul_labor_costs" value="45,000">
    <input type="hidden" name="operators_per_shift_removed" value="2">
    <input type="hidden" name="percent_of_labor_retained" value="10">
    <input type="hidden" name="expected_productivity_gain" value="27">
    <input type="hidden" name="other_savings" value="0">
	
</form>

<div class="roi-content">
    <div class="inner">
    
    <p class="answer-title">Total Robotic System Cost Vs. Current Operational Costs</p>
    <div class="gridrow three-up">
     
        <div class="gridcol">
            <div class="answer-number">
            	
                <div class="inline"><b id="break1"></b> <span>YEAR</span></div>
                <div class="inline"><b id="break2"></b><span>MONTHS</span></div>
                
            </div>
            <div class="answer-label">Break Even Point</div>
        </div>
        
        <div class="gridcol">
            <div class="answer-number"><div class="inline" style="white-space: nowrap;"><b id="answer2"></b><span>US DOLLARS</span></div></div>
            <div class="answer-label">Labor Savings</div>
        
        </div>
        
        <div class="gridcol">
            <div class="answer-number"><div class="inline" style="white-space: nowrap;"><b id="answer3"></b><span>US DOLLARS</span></div></div>
            <div class="answer-label">Productivity Savings</div>
        
        </div>
    
    </div>
    
    <p style="margin-top:30px" align="center"><a class="run-again" href="">Return to Calculator</a></p>
    
    </div>
</div>

<div class="roi-chart">
<div class="inner">

<p class="answer-title">ROI Chart <span class="tip large roicharttip tooltipstered">?</span></p>
	<table id="roi-data" class="roi-chart mobile-check">
    	<thead>
    	<tr>
        	<th valign="top">Year</th>
            <td valign="top">System Costs<span class="tip system tooltipstered">?</span></td>
            <td valign="top">Maintenance Costs<span class="tip maintenance tooltipstered">?</span></td>
            <td valign="top">Operating Costs*<span class="tip operating tooltipstered">?</span></td>
            <td valign="top">Labor Savings**<span class="tip labor tooltipstered">?</span></td>
            <td valign="top">Productivity Savings***<span class="tip productivity tooltipstered">?</span></td>
            <td valign="top">Other Savings</td>
            <td valign="top">Yearly Cash Flow</td>
            <th valign="top">Cumulative Cash Flow</th>        
	</tr></thead>
    <tbody>

        <?php $roi = new Roi();
        for($y=1; $y<16; $y++) : ?>            
		<tr>
        	<th><?php echo $y; ?></th>
            <td class="numberBlock"><?php echo $y == 1 ? '$' . number_format($roi->systemCosts($y)) : '' ?></td>
            <td class="numberBlock">$<?php echo number_format($roi->maintenanceCosts($y)) ?></td>
            <td class="numberBlock">$<?php echo number_format($roi->operatingCosts($y)) ?></td>
            <td class="numberBlock">$<?php echo number_format($roi->laborSavings($y)) ?></td>
            <td class="numberBlock">$<?php echo number_format($roi->productivitySavings()) ?></td>
            <td class="numberBlock">$<?php echo number_format($roi->otherSavings()) ?></td>
            <td class="numberBlock">$<?php echo number_format($roi->cashFlow($y)) ?></td>
            <th class="numberBlock">$<?php echo number_format($roi->totalSavings($y)) ?></th>
        </tr>
        <?php endfor; ?>
        
		<tr class="roi-chart-totals">
        	<th>TOTALS</th>
            <td></td>
            <td class="numberBlock">$<?php echo number_format($roi->totalMaintenanceCosts()) ?></td>
            <td class="numberBlock">$<?php echo number_format($roi->totalOperatingCosts()) ?></td>
            <td class="numberBlock">$<?php echo number_format($roi->totalLaborSavings()) ?></td>
            <td class="numberBlock">$<?php echo number_format($roi->totalProductivitySavings()) ?></td>
            <td class="numberBlock">$<?php echo number_format($roi->totalOtherSavings()) ?></td>
            <td></td>
        	<td></td>
        </tr>
    </tbody>
    </table>
    
    <div id="info" class="chart-text" 
         data-breakeven="<?php echo $roi->breakEven() ?>" 
         data-laborsavings="$<?php echo number_format($roi->totalLaborSavings()) ?>" 
         data-productivitysavings="$<?php echo number_format($roi->totalProductivitySavings()) ?>">
      <p>*for medium size robot; small robot has 1/10th power consumption and large robot has twice power consumption. Assumes 2% annual inflation in electrical power costs        </p>
      <p>**assumes 2% annual inflation cost of labor        </p>
      <p>***additional labor required for same output as robot system </p>
    </div>

	<div id="chartContainer" style="height: 300px; width: 70%; margin:0 auto 30px;"></div>

    <script type="text/javascript" >
        var datapoints = <?php echo json_encode($roi->dataPoints(), JSON_NUMERIC_CHECK); ?>;
    </script>    

</div>
</div>
