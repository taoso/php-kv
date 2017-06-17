<?php
namespace Lvht\Key;

class Key
{
    /**
     * @var \PDO
     */
    private $db;

    /**
     * @var \PDOStatement
     */
    private $get_stmt;

    /**
     * @var \PDOStatement
     */
    private $set_stmt;

    /**
     * @param $type string
     * - "json" auto encode/decode $value by json
     * - "text" treat all value as plain text
     */
    public static function new(string $path, string $type = 'json') : self
    {
        switch ($type) {
        case 'json':
            return new JsonKey($path);
        case 'text':
            return new self($path);
        default:
            throw new \InvalidArgumentException("Unsupported type $type");
        }
    }

    private function __construct(string $path)
    {
        $this->db = new \PDO("sqlite:$path");

        $has_kv_table = $this->db->query('select 1 from __lv_kv');
        if (!$has_kv_table) {
            $this->db->exec('create table __lv_kv(k text primary key, v text)');
        }

        $this->set_stmt = $this->db->prepare('replace into __lv_kv(k,v) values(?, ?)');
        $this->get_stmt = $this->db->prepare('select * from __lv_kv where k = ?');
    }

    public function get(string $key)
    {
        $this->get_stmt->execute([$key]);
        $rows = $this->get_stmt->fetchAll();
        if (count($rows) == 0) {
            return null;
        }

        return $rows[0]['v'];
    }

    public function set(string $key, $value)
    {
        return $this->set_stmt->execute([$key, $value]);
    }
}
