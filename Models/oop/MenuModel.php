<?php

class MenuModel extends Dmodel {

    public function __construct() {
        parent::__construct();
    }

    public function select_all_menus_and_submenus() {
        $sql = "
            SELECT cate_id.*, paren_id.*
            FROM category AS parent
            LEFT JOIN category AS child ON child.parent_id = parent.cate_id
            WHERE parent.parent_id IS NULL
        ";
        return $this->getConn()->select($sql);
    }

    public function select_all_by_id($cate_id){
        $sql = "
            select * from category
            where cate_id = :cate_id
        ";
        $params = [':cate_id' => $cate_id];
        return $this->getConn()->select($sql, $params);
    }

    public function select_all_by_paren_id($paren_id){
        $sql = "
            select * from category
            where paren_id = :paren_id
        ";
        $params = [':paren_id' => $paren_id];
        return $this->getConn()->select($sql, $params);
    }

}

