<?php
class Zend_View_Helper_Userlist
{
    public function userlist()
    {
        return $this;
    }
    
    public function userNameList()
    {
        $customerMppObj = new Model_CustomerMapper();
        $customerArr = $customerMppObj->fetchCustomerList()->toArray();
        if(count($customerArr) > 0)
        {
            $HTML = '<select id="customer-list">
                        <option value="">--Select Customer--</option>';
            foreach ($customerArr as $value) 
            {
                $HTML .= '<option value="'.$value['customerid'].'">'.ucfirst($value['username']).'</option>';
            }
            $HTML .= '</select>';
        }
        return $HTML;
    }
    
    public function fruitNameList()
    {
        $productMppObj = new Model_ProductsMapper();
        $productsArr = $productMppObj->fetchProductData()->toArray();
        if(count($productsArr) > 0)
        {'<select name="main-fruit-list" id="main-fruit-list" multiple="multiple">';
            $HTML = '<table cellpadding="5px" cellspacing="1px" border="0">
                	<thead><tr><th colspan="2">Available Fruits</th></tr></thead>
                        <tbody>';
            foreach ($productsArr as $value) 
            {
                $HTML .= '<tr class="to-remove-background-color" id="product-'.$value['p_id'].'-tr-id" onclick="selectTr(\''.$value['p_id'].'\');return false;">
                            <td>'.ucfirst($value['product_name']).'</td>
                            <td>'.ucfirst($value['product_price']).'</td>
                        </tr>';
                
            }
            $HTML .= '</tbody>
                </table>';
        }
        return $HTML;
    }
    
    public function distinctDateForAdmin()
    {
        $customerOrderMppObj = new Model_CustomerorderMapper();
        $customerOrderArr = $customerOrderMppObj->fetchDistinctDate()->toArray();
        if(count($customerOrderArr) > 0)
        {
            $HTML = '<select name="date-list" id="date-list">
                        <option value="">--Select Date--</option>';
            foreach ($customerOrderArr as $value) 
            {
                $HTML .= '<option value="'.$value['orderdate'].'">'.date('j M Y',  strtotime($value['orderdate'])).'</option>';
                
            }
            $HTML .= '</select>';
        }
        return $HTML;
    }
}