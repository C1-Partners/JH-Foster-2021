
document.addEventListener('DOMContentLoaded', function(event) {
    
    const   calcBlock = document.getElementById('robotCalulator'),
            robotInputCost = document.getElementById('robotCost'),
            robotServiceCost = document.getElementById('robotSrvCost'),
            employeeSalary = document.getElementById('empSalary'),
            taxBenefits = document.getElementById('taxBenefits'),
            calcButton = document.getElementById('calculate'),
            resetButton = document.getElementById('reset');

    if(!calcBlock) {
        return
    }

    let benefits = taxBenefits.value.replace(/,/g, ""),
        totalEmpYrlyCosts = 0,
        totalRobotYrlyCosts = 0,
        totalRobotHrs = 0;
        totalEmpHrs = 0;

    
        
    const costData = [
        {
            '': 'Robot',
            cost: parseInt(robotInputCost.value.replace(/,/g, ""), 10),
            annualHrs: 2080,
            costPerHr: 0,
            unitsPerHr: 100,
            costPerUnit: 0,    
        },
        {   
            '': 'Employee',
            cost: parseInt(employeeSalary.value.replace(/,/g, "")) + parseInt(benefits),
            annualHrs: 2080,
            costPerHr: 0,
            unitsPerHr: 80,
            costPerUnit: 0,
        }, 
        {
            '': 'Robot Vs. Employee',
            cost: 0,
            annualHrs: '',
            costPerHr: 0,
            unitsPerHr: '',
            costPerUnit: 0,
        },
    ];

    const costDataTotals = [
        {
            '': 'Robot',
            cost: 0,
            annualHrs: 0,
            costPerHr: 0,
            unitsPerHr: 100,
            costPerUnit: 0,    
        },
        {   
            '': 'Employee',
            cost: 0,
            annualHrs: 0,
            costPerHr: 0,
            unitsPerHr: 0,
            costPerUnit: 0,
        }, 
        {
            '': 'Robot Vs. Employee',
            cost: 0,
            annualHrs: '',
            costPerHr: 0,
            unitsPerHr: '',
            costPerUnit: 0,
        },
    ];

    const meritIncrease = .03;
    

    // Update cost data
    function updateCostValues() {
        costData[0].costPerHr = roundToTwo(costData[0].cost/costData[0].annualHrs); // Robot cost per hour
        costData[1].costPerHr = roundToTwo(costData[1].cost/costData[1].annualHrs); // Employee cost per hour
        costData[1].cost = Math.round(costData[1].cost);
        costData[0].costPerUnit = roundToTwo(costData[0].costPerHr/costData[0].unitsPerHr); // Robot cost per unit
        costData[1].costPerUnit = roundToTwo(costData[1].costPerHr/costData[1].unitsPerHr); // Employee cost per unit
        costData[2].cost = Math.round(costData[0].cost - costData[1].cost); // Difference cost between robot and employee
        costData[2].costPerHr = roundToTwo(costData[0].costPerHr - costData[1].costPerHr); // Difference cost per hour between robot and employee
        costData[2].costPerUnit = roundToTwo(costData[0].costPerUnit - costData[1].costPerUnit); // Difference cost per unit between robot and employee
    }
    // Updates costs before table render when user adjusts costs inputs
    function updateCostValuesBeforeRender() {
        taxBenefits.value = numberWithCommas(parseInt(employeeSalary.value.replace(/,/g, ""), 10) * .3);
        robotInputCost.value = numberWithCommas(robotInputCost.value.replace(/,/g, ""), 10);
        employeeSalary.value = numberWithCommas(employeeSalary.value.replace(/,/g, ""), 10);
        costData[0].cost = parseInt(robotInputCost.value.replace(/,/g, ""), 10);
        costData[1].cost = parseInt(employeeSalary.value) + parseInt(taxBenefits.value.replace(/,/g, ""), 10);

        updateCostValues();
    }

    // Just refresh page for now
    function resetCalculator() {
       location.reload();
    }

    function setInputsAsReadOnly() {
        const inputs = [robotInputCost, robotServiceCost, employeeSalary];

        for (let i = 0; i < inputs.length; i++) {
            inputs[i].setAttribute('readonly', true);
            inputs[i].classList.add('read-only');
        }
    }
    
    /***
     * 
     *  The Calculating function
     * 
     ***/
    function calculateCumulativeValues() {
        
        const table = document.getElementById('results');
        const data = Object.keys(costData[0]);
        
        let empYrlyCosts = costData[1].cost;
        let robotYrlyCosts = robotServiceCost.value * costData[0].cost;
        let years = 3;
        let annualRobotHrs = costData[0].annualHrs;
        let annualEmpHrs = costData[1].annualHrs;
     
        // Assign initial robot cost before interation
        totalRobotYrlyCosts = costData[0].cost;
        // Assign initial robot & emp hours before interation
        totalRobotHrs = costData[0].annualHrs;
        totalEmpHrs = costData[1].annualHrs;
        // Assign the initial emp units per hr
        empUnitsPerHr = costData[1].unitsPerHr;
      

        updateCostValues();
        setInputsAsReadOnly();
        calcButton.classList.add('d-none');
        resetButton.classList.remove('d-none');
  
        for(let i = 0; i < years; i++) {
            // Accumulate and store total employee costs each year. Includes factoring in 10% a year for emp overtime.
            totalEmpYrlyCosts += empYrlyCosts + (empYrlyCosts * .1);
    
            // After the first year 
            if(i > 0) {
             
                empYrlyCosts += empYrlyCosts * meritIncrease;
                costData[1].cost = roundToTwo(empYrlyCosts);
                // Add robot yearly costs after the first year to total robot costs
                totalRobotYrlyCosts += robotYrlyCosts
                // Add yearly robot & emp hours for year 2 and 3 to initial operating hours
                totalRobotHrs += annualRobotHrs;
                totalEmpHrs += annualEmpHrs;
                
            }

            if(i >= 1) {
                newRowLabel(table, i+1, -1);
                // Set the calculated robot cost (initial*service cost) for years 2 and 3 only
                costData[0].cost = robotYrlyCosts;
                empUnitsPerHr += 5;
                costData[1].unitsPerHr = empUnitsPerHr;
            }
          
            updateCostValues();
            generateTable(table, costData);
        }

        // Update final costs for rendering of last table
        costDataTotals[0].cost = Math.round(totalRobotYrlyCosts);
        costDataTotals[1].cost = Math.round(totalEmpYrlyCosts);
        costDataTotals[2].cost = Math.round(costDataTotals[0].cost - costDataTotals[1].cost);
        costDataTotals[0].annualHrs = totalRobotHrs;
        costDataTotals[1].annualHrs = totalEmpHrs;
        costDataTotals[0].costPerHr = roundToTwo(costDataTotals[0].cost/costDataTotals[0].annualHrs);
        costDataTotals[1].costPerHr = roundToTwo(costDataTotals[1].cost/costDataTotals[1].annualHrs);
        costDataTotals[2].costPerHr = roundToTwo(costDataTotals[0].costPerHr - costDataTotals[1].costPerHr);
        costDataTotals[1].unitsPerHr = 85; // Suppossed avg per client request
        costDataTotals[0].costPerUnit = roundToTwo(costDataTotals[0].costPerHr/costDataTotals[0].unitsPerHr);
        costDataTotals[1].costPerUnit = roundToTwo(costDataTotals[1].costPerHr/costDataTotals[1].unitsPerHr);
        costDataTotals[2].costPerUnit = roundToTwo(costDataTotals[0].costPerUnit - costDataTotals[1].costPerUnit);
        
        generateTableHead(table, data);
        newRowLabel(table, 3, 0);
        generateTable(table, costDataTotals);
        changeHeaderNames();
        addCommasToNumbers();
        addDollarSigns();
    }

    // A terrible fix and hack function. Sorry.
    function changeHeaderNames() {
        th = document.getElementsByClassName('table-header');

        const headerTitles = [
            ' ',
            'Cost',
            'Annual Hrs.',
            'Cost Per Hr.',
            'Units Per Hr.',
            'Cost Per Unit',
        ]

        for (let i = 1; i < headerTitles.length; i++) {
            th[i].innerHTML = headerTitles[i];
        }
    }

    // add commas to numbers in the table element
    function addCommasToNumbers() {
        const table = document.getElementById('results');
        const td = table.getElementsByTagName('td');
    
        for (let i=0; i < td.length; i++) {
            if(!isNaN(td[i].innerHTML)) {
                td[i].innerHTML = numberWithCommas(td[i].innerHTML);
            }
        }
    }

    // regex function to add commas to numbers
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // 
    function addDollarSigns() {
        const table = document.getElementById('results');
        const tr = table.getElementsByTagName('tbody')[0].children;
       
        for (let i = 0; i < tr.length; i++) {
            // only grabbing rows that are not year labels
            if (i!==3 || i!==7 || i!==11) {
                let td = tr[i].children
                
                for (let j = 0; j < td.length; j++ ) {  
                    // only grabbing currency based cells to update for dollar sign
                    if (j===1 || j===3 || j===5) {                   
                        td[j].innerHTML = '$' + td[j].innerHTML;
                        // because this client is annoying 
                        td[j].innerHTML = td[j].innerHTML.replace('$-', '-$')
                    }
                }
            }
        }
    }

    function newRowLabel(table, i, total) {
        let lastRow = table.rows[ table.rows.length - 1 ];
        let newrow = document.createElement("tr");
        
        if(total) {
            newrow.innerHTML = '<td colSpan="6" class="year-label">Year ' + i + '</td>';
        } else {
            newrow.innerHTML = '<td colSpan="6" class="year-label">Total After 3 Years</td>';
        }
        
        lastRow.insertAdjacentElement('afterend', newrow);
    }

    // Rounding function to two decimal places
    function roundToTwo(num) {    
        return +(Math.round(num + "e+2")  + "e-2");
    }
        
    function generateTableHead(table, data) {
        
        let thead = table.createTHead();
        let header = table.getElementsByTagName('thead')[0];
        let row = thead.insertRow();
        let insertRow = header.insertRow(1);

        for (let key of data) {
            let th = document.createElement('th');
            let text = document.createTextNode(key);
            th.appendChild(text);
            row.appendChild(th);
            th.classList.add('table-header');
            insertRow.classList.add('year-label');
        }

        insertRow.innerHTML = '<td colSpan="6">Year 1</td>';
        header.setAttribute('colSpan', 5);
    }
          
    function generateTable(table, data) {
        
        for (const element of data) { 
            let row = table.insertRow();
            for (key in element) {
                let cell = row.insertCell();
                let text = document.createTextNode(element[key]);
                cell.appendChild(text);
            } 
        }
    }
    
    resetButton.addEventListener('click', resetCalculator);
    employeeSalary.addEventListener('input', updateCostValuesBeforeRender);
    robotInputCost.addEventListener('input', updateCostValuesBeforeRender);
    calcButton.addEventListener('click', calculateCumulativeValues);
  
})