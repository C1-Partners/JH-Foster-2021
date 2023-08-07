document.addEventListener('DOMContentLoaded', function(event) {
    
    const   calcBlock = document.getElementById('robotCalv2')
            robotInputCost = document.getElementById('robotCost'),
            robotServiceCost = document.getElementById('robotSrvCost'),
            employeeSalary = document.getElementById('empSalary'),
            taxBenefits = document.getElementById('taxBenefits')
            employeeOt = document.getElementById('fteot');

    if(!calcBlock) {
        return
    }

    let     // Year 1 Robot Inputs
            robotCost1 = document.getElementById('rc1'),
            robotYrHrs1 = document.getElementById('ah1'),
            robotCostHr1 = document.getElementById('rch1'),
            robotUnitHr1 = document.getElementById('ruh1'),
            robotCostUnit1 = document.getElementById('rcu1'),
            // Year 1 Employee inputs
            empCost1 = document.getElementById('ftec1'),
            empYrHrs1 = document.getElementById('fteah1'),
            empCostHr1 = document.getElementById('ftech1'),
            empUnitsHr1 = document.getElementById('fteuh1'),
            empCostUnit1 = document.getElementById('ftecu1'),
            // Year 1 Robot vs Employee inputs
            robotVsEmpCost1 = document.getElementById('ftvrc1'),
            robotVsEmpCostHr1 = document.getElementById('ftvrch1'),
            robotVsEmpCostUnit1 = document.getElementById('ftvrcu1'),
            // Year 2 Robot Inputs
            robotCost2 = document.getElementById('rc2'),
            robotYrHrs2 = document.getElementById('ah2'),
            robotCostHr2 = document.getElementById('rch2'),
            robotUnitHr2 = document.getElementById('ruh2'),
            robotCostUnit2 = document.getElementById('rcu2'),
            // Year 2 Employee inputs
            empCost2 = document.getElementById('ftec2'),
            empYrHrs2 = document.getElementById('fteah2'),
            empCostHr2 = document.getElementById('ftech2'),
            empUnitsHr2 = document.getElementById('fteuh2'),
            empCostUnit2 = document.getElementById('ftecu2'),
            
            // Year 1 Robot vs Employee inputs
            robotVsEmpCost2 = document.getElementById('ftvrc2'),
            robotVsEmpCostHr2 = document.getElementById('ftvrch2'),
            robotVsEmpCostUnit2 = document.getElementById('ftvrcu2'),

            // Year 3 Robot Inputs
            robotCost3 = document.getElementById('rc3'),
            robotYrHrs3 = document.getElementById('ah3'),
            robotCostHr3 = document.getElementById('rch3'),
            robotUnitHr3 = document.getElementById('ruh3'),
            robotCostUnit3 = document.getElementById('rcu3'),
            // Year 1 Employee inputs
            empCost3 = document.getElementById('ftec3'),
            empYrHrs3 = document.getElementById('fteah3'),
            empCostHr3 = document.getElementById('ftech3'),
            empUnitsHr3 = document.getElementById('fteuh3'),
            empCostUnit3 = document.getElementById('ftecu3'),
            // Year 1 Robot vs Employee inputs
            robotVsEmpCost3 = document.getElementById('ftvrc3'),
            robotVsEmpCostHr3 = document.getElementById('ftvrch3'),
            robotVsEmpCostUnit3 = document.getElementById('ftvrcu3'),

            // inflation year 2 - employee
            Inflation2 = document.getElementById('inf2'),
            // inflation year 3 - employee
            Inflation3 = document.getElementById('inf3');

    // Updates costs  when user adjusts costs inputs
    function updateCostValues() {
        taxBenefits.value = numberWithCommas(parseInt(employeeSalary.value.replace(/,/g, ""), 10) * .3);
        robotInputCost.value = numberWithCommas(robotInputCost.value.replace(/,/g, ""), 10);
        employeeSalary.value = numberWithCommas(employeeSalary.value.replace(/,/g, ""), 10);
    }
    // update cell values for year 1
    function yearOne() {
        // robot values
        robotCost1.value = robotInputCost.value;
        robotCostHr1.value = roundToTwo(stingToInteger(robotCost1.value)/stingToInteger(robotYrHrs1.value));
        robotCostUnit1.value = roundToTwo(stingToInteger(robotCostHr1.value)/stingToInteger(robotUnitHr1.value));
        // employee values
        empCost1.value = numberWithCommas(stingToInteger(employeeSalary.value) + stingToInteger(taxBenefits.value) + stingToInteger(employeeOt.value));
        empCostHr1.value = roundToTwo(stingToInteger(empCost1.value)/stingToInteger(empYrHrs1.value));
        empCostUnit1.value = roundToTwo(stingToInteger(empCostHr1.value)/stingToInteger(empUnitsHr1.value));
        // robot vs employee result values
        robotVsEmpCost1.value = roundToTwo(stingToInteger(robotCost1.value) - stingToInteger(empCost1.value));
        robotVsEmpCostHr1.value = roundToTwo(stingToInteger(robotCostHr1.value) - stingToInteger(empCostHr1.value));
        robotVsEmpCostUnit1.value = numberWithCommas(stingToInteger(robotCostUnit1.value) - stingToInteger(empCostUnit1.value));
    }
    yearOne();
     // update cell values for year 2
     function yearTwo() {
        // robot/employee annual hours
        robotYrHrs2.value = robotYrHrs1.value;
        empYrHrs2.value = empYrHrs1.value;
         // robot/employee units/hour
        robotUnitHr2.value = robotUnitHr1.value;
        empUnitsHr2.value = empUnitsHr1.value;
        // robot values
        robotCost2.value = numberWithCommas(stingToInteger(robotInputCost.value) * (robotServiceCost.value * 1) + (truncateToDecimals(Inflation2.value/100) * (stingToInteger(robotCost1.value))) * (robotServiceCost.value * 1));

        // console.log(numberWithCommas(stingToInteger(robotInputCost.value) * (robotServiceCost.value * 1) + (truncateToDecimals(Inflation2.value/100) * (stingToInteger(robotCost1.value))) * (robotServiceCost.value * 1)));

        robotCostHr2.value = roundToTwo(stingToInteger(robotCost2.value)/stingToInteger(robotYrHrs2.value));
        robotCostUnit2.value = roundToTwo(stingToInteger(robotCostHr2.value)/stingToInteger(robotUnitHr2.value));
        // employee values
        empCost2.value = numberWithCommas(stingToInteger(empCost1.value) +  truncateToDecimals(Inflation2.value/100) * (stingToInteger(empCost1.value)));
        empCostHr2.value = roundToTwo(stingToInteger(empCost2.value)/stingToInteger(empYrHrs2.value));
        empCostUnit2.value = roundToTwo(stingToInteger(empCostHr2.value)/stingToInteger(empUnitsHr2.value));
        // robot vs employee result values
        robotVsEmpCost2.value = numberWithCommas(stingToInteger(robotCost2.value) - stingToInteger(empCost2.value));
        robotVsEmpCostHr2.value = roundToTwo(stingToInteger(robotCostHr2.value) - stingToInteger(empCostHr2.value));
        robotVsEmpCostUnit2.value = numberWithCommas(stingToInteger(robotCostUnit2.value) - stingToInteger(empCostUnit2.value));

    }
    yearTwo();
    // update cell values for year 3
    function yearThree() {
        // robot/employee annual hours
        robotYrHrs3.value = robotYrHrs1.value;
        empYrHrs3.value = empYrHrs1.value;
        // robot/employee units/hour
        robotUnitHr3.value = robotUnitHr1.value;
        empUnitsHr3.value = empUnitsHr1.value;
        // robot values
        robotCost3.value = numberWithCommas(stingToInteger(robotInputCost.value) * (robotServiceCost.value * 1) + (truncateToDecimals(Inflation3.value/100) * (stingToInteger(robotCost1.value))) * (robotServiceCost.value * 1));
        robotCostHr3.value = roundToTwo(stingToInteger(robotCost3.value)/stingToInteger(robotYrHrs3.value));
        robotCostUnit3.value = roundToTwo(stingToInteger(robotCostHr3.value)/stingToInteger(robotUnitHr3.value));
        // employee values
        empCost3.value = numberWithCommas(stingToInteger(empCost2.value) +  truncateToDecimals(Inflation3.value/100) * (stingToInteger(empCost2.value)))
        empCostHr3.value = roundToTwo(stingToInteger(empCost3.value)/stingToInteger(empYrHrs3.value));
        empCostUnit3.value = roundToTwo(stingToInteger(empCostHr3.value)/stingToInteger(empUnitsHr3.value));
        // robot vs employee result values
        robotVsEmpCost3.value = roundToTwo(stingToInteger(robotCost3.value) - stingToInteger(empCost3.value));
        robotVsEmpCostHr3.value = roundToTwo(stingToInteger(robotCostHr3.value) - stingToInteger(empCostHr3.value));
        robotVsEmpCostUnit3.value = numberWithCommas(stingToInteger(robotCostUnit3.value) - stingToInteger(empCostUnit3.value));       
    }
    yearThree();

    [robotInputCost, robotServiceCost, employeeSalary ].forEach( input => {
        input.addEventListener('change', () => {
            updateCostValues();
            yearOne();
            yearTwo();
            yearThree();
        });
    });

    if (employeeOt) {
        employeeOt.addEventListener('change', () => {
            employeeOt.value = numberWithCommas(stingToInteger(employeeOt.value) * 1.5); 
            yearOne();
            yearTwo();
            yearThree();
        })
    }
    
    [robotUnitHr1, robotYrHrs1, empYrHrs1, empUnitsHr1].forEach( input => {
        input.addEventListener('change', () => {
            yearOne();
            yearTwo();
            yearThree();
        });
    });

    //changes to robot/employee annual hours
    [robotYrHrs1, empYrHrs1].forEach( input => {
        input.addEventListener('change', () => {
            yearTwo();
            yearThree();
        });
    });

    //changes to employee inflation
    [Inflation2, Inflation3].forEach( input => {
        input.addEventListener('change', () => {
            yearOne();
            yearTwo();
            yearThree();
        });
    });

    // regex function to add commas to numbers
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    // strip commas from string and convert to integer 
    function stingToInteger(string) {
        return parseInt(string.replace(/\,/g,'', 10));
    }
    //caluate employee hourly OT rate base on 40hr work week
    function caluateOvertimePay(salary) {
       const annualSalary = stingToInteger(salary);
       const annualHours = 2080;
       return annualSalary/annualHours * 1.5;
    }
     // Rounding function to two decimal places
     function roundToTwo(num) {    
        return +(Math.round(num + "e+2")  + "e-2");
    }

    function truncateToDecimals(num, dec = 2) {
        const calcDec = Math.pow(10, dec);
        return Math.trunc(num * calcDec) / calcDec;
    }
    
    
});