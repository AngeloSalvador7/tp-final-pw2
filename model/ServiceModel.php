<?php


class ServiceModel
{
    private $database;

    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;
    }
}