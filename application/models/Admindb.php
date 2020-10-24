<?php

class Admindb extends CI_model
{
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


    /******* Update Data Data *************/
    public function UpdateData($Data,$Table,$Id,$FieldName)
    {/********start update /edit function********** */
        $this->db->where([$FieldName=>$Id]); /********where condition********** */
        $query = $this->db->update($Table,$Data);/**********update query********* */
        if($query){/***********if data updated********** */
            return true;/********return true******* */
        }else{/******else******** */
            return false;/*******return false******** */
        }/********condition end******** */
    }/*********data updated********** */

    /******* Update Data Data *************/
    public function UpdateData1($where,$data,$table)
    {/********start update /edit function********** */
        $this->db->where($where); /********where condition********** */
        $query = $this->db->update($table,$data);/**********update query********* */
        $affected = $this->db->affected_rows();
        if($affected){/*********** if data updated ********** */
            return true;/******** return true ******* */
        }else{/******else******** */
            return false;/******* return false ******** */
        }/********condition end******** */
    }/*********data updated********** */

    /************* Check Is Data **********/
    public function CheckVerifyData($data,$table,$keyname)
    {/*********check data on table********* */
        $this->db->where([$keyname=>$data,'IsDeleted'=>false]);/*********condition check on table*********** */
        $query = $this->db->get($table);/********get row********* */
        if ($query->num_rows() > 0) {/*******if row exist****** */
            return true;/********return true******** */
        }else{/********else ********** */
            return false;/******return false******* */
        }/********end of condition********** */
    }/**********end of function************ */

    /*********** get all Data from Table */
    public function getdata($where,$table,$orderid,$orderby)
    {/*******get data all******* */
        $this->db->where($where);/********where data not deleted******** */
        $this->db->order_by($orderid, $orderby);/********orderby all data******** */
        $query = $this->db->get($table);/********get row********* */
        if ($query->num_rows() > 0) {/********check rows********** */
            return $query->result();/********return data********* */
        }else{/*******else row not found********* */
            return false;/********return false********* */
        }/*******condition end******* */
    }/********function end********* */

    /*********** get all Data from Table */
    public function getrecord($where,$table,$field)
    {/*******get data all******* */
        $this->db->where($where);/********where data not deleted******** */
        $query = $this->db->get($table);/********get row********* */
        if ($query->num_rows() > 0) {/********check rows********** */
            return $query->row()->$field;
        }else{/*******else row not found********* */
            return false;/********return false********* */
        }/*******condition end******* */
    }/********function end********* */

    /*********** get all Data from Table with condition*/
    public function getconditiondata($FieldName,$Data,$table)
    {/*******get data all with condition******* */
        $this->db->where([$FieldName => $Data,'IsDeleted'=>false]);/********where data not deleted******** */
        $query = $this->db->get($table);/********get all data******** */
        if ($query->num_rows() > 0) {/********check rows********** */
            return $query->result();/********return data********* */
        }else{/*******else row not found********* */
            return false;/********return false********* */
        }/*******condition end******* */
    }/********function end********* */


    /*********** dues data ********* */
    //      Updated on 26-9-2020
    public function DuesRecord($where,$field,$table,$data)
    {
        $month = $data->MonthNumber;
        $year = $data->Year;

        $this->db->where($where);
        $this->db->select_sum($field);
        $query = $this->db->get($table);
//        $query = $this->db->query("SELECT
//              *,
//              STR_TO_DATE(
//                CONCAT(`year`, '-', MonthNumber, '-', 1),
//                '%Y-%m-%d'
//              ) AS dues_date,
//              (@sum := @sum + Dues) AS due_amount
//            FROM
//              `fee`
//              CROSS JOIN
//                (SELECT
//                  @sum := 0) params
//            WHERE `StudentId` LIKE '290334127141' and MONTHNumber <= $month
//            HAVING dues_date <= NOW()");
        if($query){
            return $query->row()->$field;
        }else{
            return false;
        }
    }

    /*********** sum data ********* */
    public function BulkRecord($where,$field,$table,$whereIn,$array)
    {
        $this->db->where($where);
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        if($query){
            return $query->row()->$field;
        }else{
            return false;
        }
    }

    /*********** sum data ********* */
    public function SumRecord($where,$field,$table)
    {
        $this->db->where($where);
        $this->db->select_sum($field);
        $query = $this->db->get($table);
        if($query){
            return $query->row()->$field;
        }else{
            return false;
        }
    }

    /*********** sum data ********* */
    public function SumRecordLimit($where,$field,$table,$limit)
    {
        $this->db->where($where);
        $this->db->select_sum($field);
        $this->db->limit($limit);
        $query = $this->db->get($table);
        if($query){
            return $query->row()->$field;
        }else{
            return false;
        }
    }
    /************ Delete A record *********/
    public function BlockRecord($table,$Id,$keyName,$data)
    {/********delete record or row******** */
        $this->db->where([$keyName=>$Id]);/********where Condition******* */
        $query = $this->db->update($table,$data);/********Update Record*********** */
        if ($query) {/********if query executed******** */
            return true;/*******return true****** */
        }else{/*******else******* */
            return false;/*******return false******* */
        }/******condition end****** */
    }/*******function end********* */


    /******** View Single row Data *********/
    public function RowData($FieldName,$Id,$table)
    {/*********function start for single row********** */
        $this->db->where([$FieldName => $Id, 'IsDeleted'=>false]); /********condition******* */
        $query = $this->db->get($table);/********get table******** */
        if ($query->num_rows() > 0) {/*********check row exist******** */
            return $query->row();/*******return row******* */
        }else{/********else********* */
            return false;/*******return false******* */
        }/*******end of condition******** */
    }/********end of function******* */

    /******** View Single row field *********/
    public function SingleRowField($where,$table,$search)
    {/*********function start for single row********** */
        $this->db->where($where); /********condition******* */
        $query = $this->db->get($table);/********get table******** */
        if ($query->num_rows() > 0) {/*********check row exist******** */
            return $query->row()->$search;/*******return row******* */
        }else{/********else********* */
            return false;/*******return false******* */
        }/*******end of condition******** */
    }/********end of function******* */

    /******** View Single row field *********/
    public function GetDec($limit,$table,$field,$decsasc,$search)
    {/*********function start for single row********** */
        $this->db->limit($limit);
        $this->db->order_by($field,$decsasc);
        $query = $this->db->get($table);/********get table******** */
        if ($query->num_rows() > 0) {/*********check row exist******** */
            return $query->row()->$search;/*******return row******* */
        }else{/********else********* */
            return false;/*******return false******* */
        }/*******end of condition******** */
    }/********end of function******* */
    
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

    /*********** Tabel Rows */
    public function CountRow($TableName)
    {/*********count rows function********** */
        $this->db->where(['IsDeleted'=>false]);/******where condition******* */
         $query = $this->db->get($TableName);/********get data from table******* */
         return $query->num_rows();/********send num rows******** */
    }/*******function end****** */

    /*********** Tabel Rows */
    public function CountRowDynamic($where,$table)
    {/*********count rows function********** */
        $this->db->where($where);/******where condition******* */
         $query = $this->db->get($table);/********get data from table******* */
         return $query->num_rows();/********send num rows******** */
    }/*******function end****** */

    /*********** Tabel Rows */
    public function CountRowCondition($TableName)
    {/*********count rows function********** */
        $this->db->where(['IsDeleted'=>false,'IsActive'=>false]);/******where condition******* */
         $query = $this->db->get($TableName);/********get data from table******* */
         return $query->num_rows();/********send num rows******** */
    }/*******function end****** */

     /************* Check Is Data Exist **********/
     public function CheckUser($Id,$table,$keyname)
     {/**********check user function********* */
         $this->db->where([$keyname=>$Id]);/*********where condition******* */
         $query = $this->db->get($table);/*********get data from database******** */
         if ($query->num_rows() > 0) {/******check rows***** */
             return $query->row();/******return rows****** */
         }else{/********else******** */
             return false;/*******return false******* */
         }/*******end of condition******* */
     }/**********end of function********** */

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

    /**************Two Two table Join************* */
    public function TwoJoinrow($where,$tableone,$tabletwo,$joinwhere,$tablethree,$joinwherethree,$field,$value,$select)
    {/*********Start Of Two Join********* */
        $this->db->select($select);/********Select all ********** */
        $this->db->from($tableone);/********from table one main table******** */
        $this->db->join($tabletwo, $joinwhere);/***   'category.id = articles.id'  table two with id*/
        $this->db->join($tablethree, $joinwherethree);/***   'category.id = articles.id'  table two with id*/
        $this->db->where($where);/*********use where********** */
        $this->db->order_by($field,$value); /*********order by************ */
        $query = $this->db->get();/*********get record********** */
        if($query->num_rows() > 0){/********check if num rows more then 0********* */
            return $query->row();/********return complete result******** */
        }else{/*********else******** */
            return false;/********return false******* */
        }/*******end of condition******** */
    }/*********end of Two join function********* */

    

     /**************Simple Two table Join************* */
    public function SimpleJoin($where,$tableone,$tabletwo,$joinwhere,$field,$value,$select)
    {/*********Start Of Simple Join********* */
        $this->db->select($select);/********Select all ********** */
        $this->db->from($tableone);/********from table one main table******** */
        $this->db->join($tabletwo, $joinwhere);/***   'category.id = articles.id'  table two with id*/
        $this->db->where($where);/*********use where********** */
        $this->db->order_by($field,$value); /*********order by************ */
        $query = $this->db->get();/*********get record********** */
        // echo $this->db->last_query();
        if($query->num_rows() > 0){/********check if num rows more then 0********* */
            return $query->result();/********return complete result******** */
        }else{/*********else******** */
            return false;/********return false******* */
        }/*******end of condition******** */
    }/*********end of simple join function********* */

    /**************Two Two table Join************* */
    public function TwoJoin($where,$tableone,$tabletwo,$joinwhere,$tablethree,$joinwherethree,$field,$value,$select)
    {/*********Start Of Two Join********* */
        $this->db->select($select);/********Select all ********** */
        $this->db->from($tableone);/********from table one main table******** */
        $this->db->join($tabletwo, $joinwhere);/***   'category.id = articles.id'  table two with id*/
        $this->db->join($tablethree, $joinwherethree);/***   'category.id = articles.id'  table two with id*/
        $this->db->where($where);/*********use where********** */
        $this->db->order_by($field,$value); /*********order by************ */
        $query = $this->db->get();/*********get record********** */
        // echo $this->db->last_query(); die();
        if($query->num_rows() > 0){/********check if num rows more then 0********* */
            return $query->result();/********return complete result******** */
        }else{/*********else******** */
            return false;/********return false******* */
        }/*******end of condition******** */
    }/*********end of Two join function********* */


    /**************Two Two table Join************* */
    public function TwoJoinGroupBy($where,$tableone,$tabletwo,$joinwhere,$tablethree,$joinwherethree,$field,$value,$select,$distinct)
    {/*********Start Of Two Join********* */
        
        $this->db->select($select);/********Select all ********** */
        $this->db->from($tableone);/********from table one main table******** */
        $this->db->join($tabletwo, $joinwhere);/***   'category.id = articles.id'  table two with id*/
        $this->db->join($tablethree, $joinwherethree);/***   'category.id = articles.id'  table two with id*/
        $this->db->where($where);/*********use where********** */
        $this->db->order_by($field,$value); /*********order by************ */
        $this->db->group_by($distinct);
        $query = $this->db->get();/*********get record********** */
        // echo $this->db->last_query(); die();
        if($query->num_rows() > 0){/********check if num rows more then 0********* */
            return $query->result();/********return complete result******** */
        }else{/*********else******** */
            return false;/********return false******* */
        }/*******end of condition******** */
    }/*********end of Two join function********* */


    /**************Three Three table Join************* */
    public function ThreeJoin($where,$tableone,$tabletwo,$joinwhere,$tablethree,$joinwherethree,$tablefour,$joinwherefour,$field,$value,$select)
    {/*********Start Of Two Join********* */
        $this->db->select($select);/********Select all ********** */
        $this->db->from($tableone);/********from table one main table******** */
        $this->db->join($tabletwo, $joinwhere);/***   'category.id = articles.id'  table two with id*/
        $this->db->join($tablethree, $joinwherethree);/***   'category.id = articles.id'  table two with id*/
        $this->db->join($tablefour, $joinwherefour);/***   'category.id = articles.id'  table two with id*/
        $this->db->where($where);/*********use where********** */
        $this->db->order_by($field,$value); /*********order by************ */
        $query = $this->db->get();/*********get record********** */
        if($query->num_rows() > 0){/********check if num rows more then 0********* */
            return $query->result();/********return complete result******** */
        }else{/*********else******** */
            return false;/********return false******* */
        }/*******end of condition******** */
    }/*********end of Two join function********* */

    /**************Four Four table Join************* */
    public function FourJoin($where,$tableone,$tabletwo,$joinwhere,$tablethree,$joinwherethree,$tablefour,$joinwherefour,$tablefive,$joinwherefive,$field,$value,$select)
    {/*********Start Of Two Join********* */
        $this->db->select($select);/********Select all ********** */
        $this->db->from($tableone);/********from table one main table******** */
        $this->db->join($tabletwo, $joinwhere);/***   'category.id = articles.id'  table two with id*/
        $this->db->join($tablethree, $joinwherethree);/***   'category.id = articles.id'  table two with id*/
        $this->db->join($tablefour, $joinwherefour);/***   'category.id = articles.id'  table two with id*/
        $this->db->join($tablefive, $joinwherefive);/***   'category.id = articles.id'  table two with id*/
        $this->db->where($where);/*********use where********** */
        $this->db->order_by($field,$value); /*********order by************ */
        $query = $this->db->get();/*********get record********** */
        if($query->num_rows() > 0){/********check if num rows more then 0********* */
            return $query->result();/********return complete result******** */
        }else{/*********else******** */
            return false;/********return false******* */
        }/*******end of condition******** */
    }/*********end of Two join function********* */

    public function TruncateTable($table){
        $this->db->truncate($table);
    }

    /********** Update Panel Data ****************/
    public function UpdateLogin($Id,$date,$time)
    {/********update login function********* */
        $this->db->where(['SessionId'=>$Id]);/*******session id******* */
        $query = $this->db->update('loginlogs',['LogoutDate'=>$date,'LogoutTime'=>$time,'IsActive'=>false]);/*****update login******* */
        if($query){/******if query executed****** */
            return true;/******return true**** */
        }else{/******else****** */
            return false;/*****return false****** */
        }/******end of condition***** */
    }/*******end of update login function******** */


    public function LoginDetails($Id)
    {
        // $this->db->where(['UserId'=>$Id]);
        // $query = $this->db->get('loginlogs');
        $query = $this->db->query('SELECT *
        FROM loginlogs
        WHERE MONTH(LoginDate) = MONTH(CURRENT_DATE())
        AND YEAR(LoginDate) = YEAR(CURRENT_DATE())
        AND UserId = '.$Id.'');
        if ($query->num_rows() > 0) {
            return $query->result();
        }else{
            return false;
        }
    }
    /********* Get Company Detail ************/
    public function CompanyList()
    {/********company info function****** */
        $query = $this->db->get('company');/*******get company info******* */
        if ($query->num_rows() > 0) {/******check num rows******* */
            return $query->row();/********send row***** */
        }else{/*******else****** */
            return false;/*******return false******* */
        }/*********end of condition******* */
    }/*********end of company list********* */


    /********* Get Event Details for show in calendar ********/
    public function EventList()
    {/**********Event list functon******** */
        $query = $this->db->query('SELECT *
        FROM eventlist
        WHERE MONTH(EventDate) = MONTH(CURRENT_DATE())
        AND YEAR(EventDate) = YEAR(CURRENT_DATE())'); /********query of event******** */
        if ($query->num_rows() > 0) {/*******if rows exist******* */
            return $query->result();/*******send result******* */
        }else{/*******else******* */
            return false;/*******return false******* */
        }/*******end of condition******** */
    }/********en dof event list function******** */

    /********* Get Holiday Details for show in calendar ********/
    public function HolidayList()
    {/**********Holiday list functon******** */
        $query = $this->db->query('SELECT *
        FROM holiday'); /********query of Holiday******** */
        if ($query->num_rows() > 0) {/*******if rows exist******* */
            return $query->result();/*******send result******* */
        }else{/*******else******* */
            return false;/*******return false******* */
        }/*******end of condition******** */
    }/********en dof Holiday list function******** */

    /********* Get Exams Details for show in calendar ********/
    // public function ExamsList()
    // {/**********Exams list functon******** */
    //     $query = $this->db->query('SELECT *
    //     FROM examstimetable'); /********query of Exams******** */
    //     if ($query->num_rows() > 0) {/*******if rows exist******* */
    //         return $query->result();/*******send result******* */
    //     }else{/*******else******* */
    //         return false;/*******return false******* */
    //     }/*******end of condition******** */
    // }/********en dof Exams list function******** */

    /********* Get Holiday Details for show in calendar ********/
    public function ScheduleList()
    {/**********Holiday list functon******** */
        $query = $this->db->query('SELECT *
        FROM schedule where `IsDeleted`= false'); /********query of Holiday******** */
        if ($query->num_rows() > 0) {/*******if rows exist******* */
            return $query->result();/*******send result******* */
        }else{/*******else******* */
            return false;/*******return false******* */
        }/*******end of condition******** */
    }/********en dof Holiday list function******** */

     /********** Update Company Data ****************/
     public function UpdateCompany($CompanyData)
     {/*********Update Company********* */
         $query = $this->db->update('company',$CompanyData);/*******Update database****** */
         if($query){/*******if query executed******* */
             return true;/*******return true***** */
         }else{/*******else****** */
             return false;/********return false***** */
         }/******end of condition***** */
     }/*********end of function******** */

       /*********** get all Language from Table */
       public function language()
       {/**********start of login function******** */
           $query = $this->db->get('language');/********get language ******** */
           if ($query->num_rows() > 0) {/*******check num rows******* */
               return $query->result();/********send result data******* */
           }else{/*******else******* */
               return false;/******return false***** */
           }/******end of condition******* */
       }/*******Language function end********* */


}

?>