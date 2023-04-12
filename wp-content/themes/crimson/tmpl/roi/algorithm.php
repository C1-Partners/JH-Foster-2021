<?php

class Roi
{
    private $system_costs = 250000;
    private $number_of_robots = 2;
    private $shifts_per_day = 2;
    private $days_per_week = 5;
    private $weeks_per_year = 50;
    private $annaul_labor_costs = 45000;
    private $operators_per_shift_removed = 2;
    private $percent_of_labor_retained = 10;
    private $expected_productivity_gain = 27;
    private $maintenance_costs;
    private $maintenance_usual_costs = 1000;
    private $total_maintenance_costs = 0;
    private $operating_costs = 0;
    private $total_operating_costs = 0;
    private $labor_savings = 0;
    private $init_labor_savings = 0;
    private $total_labor_savings = 0;
    private $productivity_savings = 0;
    private $init_productivity_savings = 0;
    private $total_productivity_savings = 0;
    private $other_savings = 0;
    private $total_other_savings = 0;
    private $cash_flow = 0;
    private $datapoints = [];
    private $total_savings = 0;

    public function __construct()
    {
        $vars = get_class_vars(__CLASS__);
        foreach ($vars as $key => $val) {
            if (isset($_POST[$key])) {
                $this->$key = intval(str_replace(',', '', $_POST[$key]));
            }
        }

        $this->operating_costs = 1200 * $this->days_per_week;
        $this->total_operators_removed = $this->shifts_per_day * $this->operators_per_shift_removed;
        $this->labor_savings = ($this->annaul_labor_costs * $this->total_operators_removed) - ($this->annaul_labor_costs / $this->percent_of_labor_retained * $this->total_operators_removed);
    }

    public function systemCosts($y)
    {
        return $y == 1 ? $this->system_costs : 0;
    }

    public function maintenanceCosts($y)
    {
        $this->maintenance_costs = ($y == 5 ? $this->maintenance_costs * 10 : ($y == 10 ? $this->maintenance_costs * 60 : $this->maintenance_usual_costs));
        $this->total_maintenance_costs = $this->total_maintenance_costs + $this->maintenance_costs;

        return $this->maintenance_costs;
    }

    public function operatingCosts($y)
    {
        $this->operating_costs = $this->operating_costs * ($y > 1 ? 1.02 : 1);
        $this->total_operating_costs = $this->total_operating_costs + $this->operating_costs;

        return $this->operating_costs;
    }

    public function laborSavings($y)
    {
        $this->labor_savings = $this->labor_savings * ($y > 1 ? 1.02 : 1);
        $this->total_labor_savings = $this->total_labor_savings + $this->labor_savings;

        if( $y == 1 ) $this->init_labor_savings = $this->labor_savings;

        return $this->labor_savings;
    }

    public function productivitySavings()
    {
        $this->productivity_savings = $this->labor_savings * $this->expected_productivity_gain / 100;
        $this->init_productivity_savings = $this->init_labor_savings * $this->expected_productivity_gain / 100;
        $this->total_productivity_savings = $this->total_productivity_savings + $this->productivity_savings;

        return $this->productivity_savings;
    }

    public function otherSavings()
    {
        $this->total_other_savings = $this->other_savings + $this->total_other_savings;

        return $this->other_savings;
    }

    public function cashFlow($y)
    {
        $this->cash_flow = ($this->labor_savings + $this->productivity_savings)
                          - ($this->systemCosts($y) + $this->maintenance_costs + $this->operating_costs)
                          + $this->other_savings;

        return $this->cash_flow;
    }

    public function totalSavings($y)
    {
        $this->total_savings = $this->total_savings + $this->cash_flow;

        $this->datapoints[] = ['x' => $y, 'y' => $this->total_savings];

        return $this->total_savings;
    }

    public function totalMaintenanceCosts()
    {
        return $this->total_maintenance_costs;
    }

    public function totalOperatingCosts()
    {
        return $this->total_operating_costs;
    }

    public function totalLaborSavings()
    {
        return $this->total_labor_savings;
    }

    public function totalProductivitySavings()
    {
        return $this->total_productivity_savings;
    }

    public function totalOtherSavings()
    {
        return $this->total_other_savings;
    }
    public function dataPoints()
    {
        return $this->datapoints;
    }

    public function breakEven()
    {
        return $this->system_costs / ($this->init_productivity_savings + $this->init_labor_savings);
    }
}
