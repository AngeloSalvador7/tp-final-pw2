<?php


class MecanicoModel
{

    private $database;

    public function __construct(MysqlDatabase $database)
    {
        $this->database = $database;
    }
}