<?php
class Custom_Lang_Department
{
    public static function getDept()
    {
        $objDeptMapper = new Model_DepartmentMapper();
        $result =   $objDeptMapper->fetchDept();
        $department[null] = '---select---';
        foreach ($result as $key => $value)
        {
            $department[$value['id']] = $value['department_name'];
        }     
        return $department;
    }
}