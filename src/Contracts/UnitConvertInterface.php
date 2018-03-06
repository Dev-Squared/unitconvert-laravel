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
     * Attempt to retrieve the information for a unit of measurement.
     *
     * @param string $measurement
     *
     * @return UnitConvert
     */
    public function getMeasurementInfo(string $measurement);

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

    /**
     * Get measurement category.
     *
     * @return string
     */
    public function getCategory();

    /**
     * Get measurement variants.
     *
     * @return array
     */
    public function getVariants();

    /**
     * Get measurement options for converting.
     *
     * @return array
     */
    public function getConvertableTo();

    /**
     * Show response error.
     *
     * @return string
     */
    public function getError();
}