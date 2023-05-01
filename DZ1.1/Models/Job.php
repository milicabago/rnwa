<?php


class Job
{
    public $job_id;
    public $job_title;
    public $min_salary;
    public $max_salary;

    public function __construct($job_id, $job_title, $min_salary, $max_salary)
    {
        $this->job_id = $job_id;
        $this->job_title = $job_title;
        $this->min_salary = $min_salary;
        $this->max_salary = $max_salary;
    }

    public static function getAll() {
        $list = [];
        $req = DatabaseConnection::query("SELECT * FROM jobs");
        foreach($req as $job) {
            $list[] = new Job($job['job_id'], $job['job_title'],$job['min_salary'], $job['max_salary']);
        }
        return $list;
    }

    public static function findById($job_id) {
        $req = DatabaseConnection::query("SELECT * FROM jobs WHERE job_id = '$job_id'");
        $job = $req[0];
        return new Job($job['job_id'], $job['job_title'],$job['min_salary'], $job['max_salary']);
    }

    public static function save($job_id, $job_title, $min_salary, $max_salary)
    {
        return DatabaseConnection::query("INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES ('$job_id', '$job_title', $min_salary, $max_salary)");
    }

    public static function update($job_id, $job_title, $min_salary, $max_salary)
    {
        return DatabaseConnection::query("UPDATE jobs SET job_id = '$job_id', job_title = '$job_title', min_salary = $min_salary, max_salary = $max_salary  WHERE job_id = '$job_id'");
    }

    public static function delete($job_id)
    {
        return DatabaseConnection::query("DELETE FROM jobs WHERE job_id = '$job_id'");
    }


}