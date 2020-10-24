<?php

class Logindb extends CI_model
{

    /**************************
    login service
    ****************************/
    public function verifyuser($params)
    {
        if ($params['LoginType'] == 'staff') {
            /********* Start Of Staff Login *******/
            $Email = $params['Email'];
            $query = $this->db->query('SELECT * FROM 
            staff a,
            staffrole b
            WHERE a.`StaffEmail` = "'.$Email.'"
            AND a.`IsActive` = true
            AND a.`IsDeleted` = false
            AND a.`StaffId`= b.`StaffId`');
            if ($query->num_rows() > 0) {
                return $query->row();
            }else{
                return false;
            }
            /********* End Of Staff Login ********/
        }else{
            return false;
        }
    }


    /**********************
     * Insert User Login Log
     */

    public function insert_loginlog($login_logs)
    {
        $query = $this->db->insert('loginlogs',$login_logs);
        if ($query) {
            return true;
        }else{
            return false;
        }
    }

    /******* Insert Data *************/
    public function InsertData($AssetData,$TableName)
    {/********insert data function *********** */
        $query = $this->db->insert($TableName,$AssetData); /**********insert data into table********* */
        if($query){/********if data inserted******** */
            return true;/********return true******** */
        }else{/******if not inserted****** */
            return false;/*******return false***** */
        }/*******condition end******* */
    }/******data inserted function end****** */

    /******** View Single row Data *********/
    public function CheckConditionData($Where,$table)
    {/*********function start for single row********** */
        $this->db->where($Where); /********condition******* */
        $query = $this->db->get($table);/********get table******** */
        if ($query->num_rows() > 0) {/*********check row exist******** */
            return $query->row();/*******return row******* */
        }else{/********else********* */
            return false;/*******return false******* */
        }/*******end of condition******** */
    }/********end of function******* */


    /**************Simple Two table Join************* */
    public function SimplesingleJoin($where,$tableone,$tabletwo,$joinwhere,$field,$value,$select)
    {/*********Start Of Simple Join********* */
        $this->db->select($select);/********Select all ********** */
        $this->db->from($tableone);/********from table one main table******** */
        $this->db->join($tabletwo, $joinwhere);/***   'category.id = articles.id'  table two with id*/
        $this->db->where($where);/*********use where********** */
        $this->db->order_by($field,$value); /*********order by************ */
        $query = $this->db->get();/*********get record********** */
        if($query->num_rows() > 0){/********check if num rows more then 0********* */
            return $query->row();/********return complete result******** */
        }else{/*********else******** */
            return false;/********return false******* */
        }/*******end of condition******** */
    }/*********end of simple join function********* */
}

?>