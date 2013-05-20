<?php

class Custom_Lang_Role
{
    public static function getRole()
    {
        $objRoleMapper = new Model_RolesMapper();
        $result =   $objRoleMapper->fetchRoles();
        $role[null] = '---select---';
        foreach ($result as $key => $value)
        {
            $role[$value['id']] = $value['role_name'];
        }
        return $role;
    }
}

?>
