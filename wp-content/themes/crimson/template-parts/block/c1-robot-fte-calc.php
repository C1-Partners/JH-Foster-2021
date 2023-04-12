

<section class="block-robot-fte" id="robotCalulator">
    <form action="" method="get" class="robot-calc">
        <div class="row">
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
            </div>
        </div> 
        <div class="btn-row">
            <button type="button" class="btn btn-primary" id="calculate">Calculate</button>
            <button type="button" class="d-none btn btn-primary" id="reset">Reset</button>
        </div>
    </form>
    <div class="table=responsive">
        <table id="results"></table>
    </div>
</section>