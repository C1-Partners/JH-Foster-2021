
<div class="roi-content">
	<div class="inner">
      
      <form name="robotROI" id="robotROI" method="post" action="" onsubmit="return checkForm();">
      <p class="roi-title">Variable for Total System Cost</p>
      <div class="intro-form">
      <div class="inline-form-block">
      <label style="position:relative;margin-right:5px;"><span class="tip medium systemcosttip tooltipstered">?</span><strong>Total System Cost:</strong>&nbsp;$</label> <input class="long" name="system_costs" id="system_costs" value="250,000" onkeyup="formatNumberWithCommas('system_costs');" maxlength="11" tabindex="1" type="text">
      </div><div class="inline-form-block"><label style="margin-right:5px"><strong>Quantity of Robots:</strong></label><input name="number_of_robots" id="number_of_robots" value="2" maxlength="3" class="med" tabindex="2" type="text"></div>
      </div>
      
      <p class="roi-title">Variables for Current Operational Costs</p>
      <div class="roi-form-wrap">
      <table class="roi-form-table">
      <tbody>
      <tr>
      <td class="number-col"><div class="number">1</div></td>
      <td class="title-col"><strong>Robot System Usage:</strong><span><strong>Disclaimer:</strong> Average Robot Electrical costs are roughly $.50 per hour</span></td>
      <td class="input-col"><div class="inline-form-block"><input name="shifts_per_day" id="shifts_per_day" value="2" maxlength="1" class="short" style="margin-right:5px" tabindex="3" type="text"><label>Shifts/Day</label></div><div class="inline-form-block"><input name="days_per_week" id="days_per_week" value="5" maxlength="1" class="short" style="margin-right:5px" tabindex="4" type="text"><label>Days/Week</label></div><div class="inline-form-block"><input name="weeks_per_year" id="weeks_per_year" value="50" maxlength="2" class="short" style="margin-right:5px" tabindex="5" type="text"><label>Weeks/Year</label></div></td>
      </tr>
      
      <tr>
      <td class="number-col"><div class="number">2</div></td>
      <td class="title-col"><strong>Annual Labor Costs per Operator,Including Fringe Benefits:</strong><span><strong>Disclaimer:</strong> Average Robot Electrical costs are roughly $.50 per hour</span></td>
      <td class="input-col">$&nbsp;<input name="annaul_labor_costs" id="annaul_labor_costs" value="45,000" maxlength="11" class="long" tabindex="6" onkeyup="formatNumberWithCommas('annaul_labor_costs');" type="text"></td>
      </tr>
      
      <tr>
      <td class="number-col"><div class="number">3</div></td>
      <td class="title-col"><strong>Number of Operators per Shift Removed:</strong></td>
      <td class="input-col"><input name="operators_per_shift_removed" id="operators_per_shift_removed" value="2" maxlength="3" class="short" tabindex="7" type="text"></td>
      </tr>
      
      <tr>
      <td class="number-col"><div class="number">4</div></td>
      <td class="title-col"><strong>Percentage of Labor Retained to Operate System per Shift:</strong></td>
      <td class="input-col"><input name="percent_of_labor_retained" id="percent_of_labor_retained" value="10" maxlength="3" class="med" style="margin-right:5px" tabindex="8" type="text">%</td>
      </tr>
      
      <tr>
      <td class="number-col"><div class="number">5</div></td>
      <td class="title-col"><strong>Expected Productivity Gain:</strong></td>
      <td class="input-col"><input name="expected_productivity_gain" id="expected_productivity_gain" value="27" maxlength="3" class="med" style="margin-right:5px" tabindex="9" type="text">%</td>
      </tr>
      
      <tr>
      <td class="number-col"><div class="number">6</div></td>
      <td class="title-col"><strong>Other Estimated Savings:</strong><span><strong>Additional Statement:</strong> We have found that there are often a number of additional unforeseen or industry specific values associated with the installation of Robotic Systems, such as: Scrap/Rework Saving, Material Savings, etc.</span></td>
      <td class="input-col">$&nbsp;<input name="other_savings" id="other_savings" value="0" maxlength="11" class="long" tabindex="10" onkeyup="formatNumberWithCommas('other_savings');" type="text"></td>
      </tr>
      </tbody>
      </table>
      </div>
      <p align="center"><input class="roi-submit" value="Calculate..." tabindex="11" type="submit"></p>
      </form>
      <div style="text-align:center;"><p class="label warning">
          The pre-filled sections of the tool above, display an example study where 2 robots were installed and operating for 2 shifts each day, 5 days a week.
      </p></div>
            
	</div> 
</div>