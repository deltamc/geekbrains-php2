<?php
class GalleryModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllObjects()
    {
        $sql = "SELECT *  FROM  gallery";
        $sth = $this->db->query($sql);
        $data = array();
        while ($row = $sth->fetchObject()) {
            $data[] = $row;
        }

        return $data;
    }

    public function getOneObjects($id)
    {
        $id = (int) $id;
        $sql = "SELECT *  FROM  gallery WHERE id={$id}";
        $sth = $this->db->query($sql);
        $object = $sth->fetchObject();

        return $object;
    }
}