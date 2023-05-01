<?php


class Country
{
    public $country_id;
    public $country_name;
    public $region_id;
    public $region_name;

    public function __construct($country_id, $country_name, $region_id, $region_name)
    {
        $this->country_id = $country_id;
        $this->country_name = $country_name;
        $this->region_id = $region_id;
        $this->region_name = $region_name;
    }

    public static function getAll() {
        $list = [];
        $req = DatabaseConnection::query("SELECT c.*, r.region_name FROM countries c JOIN regions r ON c.region_id = r.region_id");
        foreach($req as $country) {
            $list[] = new Country($country['country_id'], $country['country_name'], $country['region_id'], $country['region_name']);
        }
        return $list;
    }

    public static function findById($country_id) {
        $req = DatabaseConnection::query("SELECT c.*, r.region_name FROM countries c JOIN regions r ON c.region_id = r.region_id WHERE c.country_id = '$country_id'");
        $country = $req[0];
        return new Country($country['country_id'], $country['country_name'], $country['region_id'], $country['region_name']);
    }

    public static function save($country_id, $country_name, $region_id)
    {
        return DatabaseConnection::query("INSERT INTO countries (country_id, country_name, region_id) VALUES ('$country_id', '$country_name', $region_id)");
    }

    public static function update($country_id, $country_name, $region_id)
    {
        return DatabaseConnection::query("UPDATE countries SET country_id = '$country_id', country_name = '$country_name', region_id = $region_id  WHERE country_id = '$country_id'");
    }

    public static function delete($country_id)
    {
        return DatabaseConnection::query("DELETE FROM countries WHERE country_id = '$country_id'");
    }


}