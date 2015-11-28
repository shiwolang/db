<?php
/**
 * Created by zhou.
 * User: zhou
 * Date: 2015/11/28
 * Time: 10:26
 */

namespace shiwolang\db;


class Log
{
    /**
     * @var string
     */
    private $sql    = "";
    private $params = [];
    /**
     * @var null|DB
     */
    private $db = null;

    public function __construct($db, $sql = "", $params = [])
    {
        $this->db     = $db;
        $this->sql    = $sql;
        $this->params = $params;
    }

    public function getSql($raw = false)
    {
        if ($raw) {
            return $this->getRawSql();
        } else {
            return $this->sql;
        }
    }

    public function getRawSql()
    {
        if (empty($this->params)) {
            return $this->sql;
        }
        $params = $this->params;
        $sql    = '';
        if (isset($params[0])) {
            foreach (explode('?', $this->sql) as $i => $part) {
                if (!empty($part)) {
                    $param = (isset($params[$i]) ? $params[$i] : '');
                    $sql .= $part . $this->db->getPdo()->quote($param);
                }
            }
        } else {
            $sql = $this->sql;
            foreach ($params as $name => $param) {
                $sql = strtr($sql, [$name => $this->db->getPdo()->quote($param)]);
            }
        }

        return $sql;
    }


    function __debugInfo()
    {
        return [
            "sql"    => [$this->getSql(), $this->params],
            "rawSql" => $this->getRawSql()
        ];
    }

    function __toString()
    {
        return $this->getRawSql();
    }
}