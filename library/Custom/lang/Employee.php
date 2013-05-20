<?php
class Custom_Lang_Employee
{
    public static function getEmp()
    {
        $objEmpDetailsMapper=new Model_EmployeedetailsMapper();
        $result = $objEmpDetailsMapper->fetchEmpName();
        $employee[null] = '---select---';
        foreach ($result as $key => $value)
        {
            $employee[$value['emp_id']] = $value['emp_name'];
        }
        return $employee;
    }

    public static function getEmpnames($arr=array())
    {
        $objEmpDetailsMapper=new Model_EmployeedetailsMapper();
        if($arr['AttendencePermission']=='view all attendence report')
        {
            $result = $objEmpDetailsMapper->fetchAllName($arr)->toArray();
        }
        elseif($arr['AttendencePermission']=='view sub-ordinate report')
        {
            $result = $objEmpDetailsMapper->fetchNameBySuperiorId($arr)->toArray();
        }
        else
        {
            throw new exception('Access Denied');
        }
        $employee[null] = '---select---';
        foreach ($result as $key => $value)
        {
            $employee[$value['emp_id']] = $value['emp_name'];
        }
        return $employee;
    }
 }