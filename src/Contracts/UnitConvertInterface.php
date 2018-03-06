<?php namespace DevSquared\UnitConvert\Contracts;

interface UnitConvert
{
    /**
     * Attempt to convert a measurement.
     *
     * @param string $from
     * @param string $to
     *
     * @return UnitConvert
     */
    public function convert(string $from, string $to);

    /**
     * Attempt to compare two measurements.
     *
     * @param string $first
     * @param string $second
     *
     * @return UnitConvert
     */
    public function compare(string $first, string $comparison, string $second);

    /**
     * Get measurement amount
     *
     * @return float
     */
    public function getAmount();

    /**
     * Get measurement success.
     *
     * @return bool
     */
    public function getSuccess();

    /**
     * Get measurement result.
     *
     * @return bool
     */
    public function getResult();

    /**
     * Get measurement unit.
     *
     * @return string
     */
    public function getUnit();

    /**
     * Get measurement display value.
     *
     * @return string
     */
    public function getDisplay();
}