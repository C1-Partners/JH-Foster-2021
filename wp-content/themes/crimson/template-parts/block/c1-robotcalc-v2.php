
<section class="block-robot-fte-v2" id="robotCalv2">
        <div class="row settings">
            <div class="robot-settings col-md-6">
                <p class="as-h3">Robot</p>
                <div>
                    <label for="robotcost">Cost ($)</label>
                    <input type="text" name="robotcost" id="robotCost" value="50,000">
                </div>
                <div>
                    <label for="servicecost">Service Cost</label>
                    <input type="text" name="robotcost" id="robotSrvCost" value=".1">
                </div>
            </div>
            <div class="fte-settings col-md-6">
                <p class="as-h3">Full-Time Employee</p>
                <div>
                    <label for="ftesalary">Annual Salary ($)</label>
                    <input type="text" name="ftesalary" id="empSalary" value="41,600">
                </div>
                <div>
                    <label for="taxbenefits">Tax & Benefits ($)</label>
                    <input class="read-only" type="text" name="taxbenefits" id="taxBenefits" value="12,480" readonly>
                </div>
                <div>
                    <label for="fteot">Overtime (1.5)*</label>
                    
                    <input type="text" name="fteot" id="fteot" value="0">
                    <label style="font-size:12px;max-width:195px;" for="fteot">*Enter Total Overtime Hours X Hourly Rate. The value is then multiplied by 1.5</label>
                </div>
            </div>
        </div> 
        <div class="row mx-0">
        <?php 
            $years    = 4;
            $readonly = "class='read-only' readonly";
            for ($i = 1; $i < $years; $i++ ) {
                $html = "
                <h3>Year {$i}</h3>
                <table>
                    <tr>
                        <th>&nbsp;</th>
                        <th>Cost</th>
                        <th>Annual Hours</th>
                        <th>Cost/Hour</th>
                        <th>Units/Hour</th>
                        <th>Cost/Unit</th>
                        <th>Inflation / Raise (%)</th>
                    </tr>
                    <tr>
                        <th>Robot</th>
                        <td><input type='text' name='robotcost' id='rc{$i}' value='0' $readonly</td>
                        <td><input type='text' name='annual hours' id='ah{$i}' value='2080' " . ($i<2 ? "" : $readonly)."></td>
                        <td><input type='text' name='robotcost hr' id='rch{$i}' value='0' $readonly></td>
                        <td><input type='text' name='robot units hour' id='ruh{$i}' value='1' " . ($i<2 ? "" : $readonly)."></td>
                        <td><input type='text' name='robotcost unit' id='rcu{$i}' value='0' $readonly></td>
                        <td>&nbsp;</td>
                        
                    </tr>
                    <tr>
                        <td>Full-Time Employee</td>
                        <td><input type='text' name='ftecost' id='ftec{$i}' value='0' $readonly></td>
                        <td><input type='text' name='fte hours' id='fteah{$i}' value='2080' " . ($i<2 ? "" : $readonly)."></td>
                        <td><input type='text' name='ftecost hour' id='ftech{$i}' value='0' $readonly></td>
                        <td><input type='text' name='fteunits hour' id='fteuh{$i}' value='1' " . ($i<2 ? "" : $readonly)."></td>
                        <td><input type='text' name='ftecost unit' id='ftecu{$i}' value='0' $readonly></td>
                        <td><input type='text' name='inflation' id='inf{$i}' value='" . (($i===2 || $i===3 ) ? "0" : "")."' " . ($i>1 ? "" : $readonly)."></td>
                    </tr>
                    <tr>
                        <td>Robot Vs. Full-Time Employee</td>
                        <td><input class='read-only' type='text' name='ftvrcost' id='ftvrc{$i}' value='0' $readonly></td>
                        <td>&nbsp;</td>
                        <td><input class='read-only' type='text' name='ftvrcost hour' id='ftvrch{$i}' value='0' $readonly></td>
                        <td>&nbsp;</td>
                        <td><input class='read-only' type='text' name='ftvrcost unit' id='ftvrcu{$i}' value='0' $readonly></td>
                        <td>&nbsp;</td>
                    </tr>
                </table><br>";
                echo $html;
            }
        ?>    
        </div>
</section>