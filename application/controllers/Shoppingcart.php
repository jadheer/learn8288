<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shoppingcart extends CI_Controller
{
    protected $ci;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('Website_functions_model');
        $this->load->model('Admin_functions_model');
    }
    function cartview()
    {
      //  $this->load->model('Home_model');
      //  $headdata  = $this->Home_model->category();
       // $topproducts =$this->Home_model->topproducts();
       // $image=$this->Home_model->image();
       // $newproducts =$this->Home_model->newproducts();
        // $cms_email = $this->Admin_functions_model->getCmsDetails(5);
        $this->load->view('website/cart');
    }
    function count()
    {
        $count = 0;
        foreach ($this->cart->contents() as $items) 
        {
            $count++;
        }
        echo $count;
    }

    function add()
    {
        $cart_session=$this->session->userdata('cart_session');
        $data = array(
            "id"  => $_POST["product_id"],
            "user"  => $cart_session,
            "name"  => $_POST["product_name"],
            "type"  => $_POST["type"],
            "price"  => $_POST["product_price"],
            "qty"  => $_POST["quantity"]

        );
        if(!empty($_POST["preferable_date"])){ 
            $basedata = array(
                "id"  => $_POST["product_id"],
                "user"  => $cart_session,
                "name"  => $_POST["product_name"],
                "price"  => $_POST["product_price"],
                "qty"  => $_POST["quantity"],
                "preferable_date"  => $_POST["preferable_date"],
            );
        }
        else{
            $basedata = array(
                "id"  => $_POST["product_id"],
                "user"  => $cart_session,
                "name"  => $_POST["product_name"],
                "price"  => $_POST["product_price"],
                "qty"  => $_POST["quantity"],

            );
        }
// print_r($basedata);die;
        $this->Website_functions_model->insertcart($basedata);

        $this->cart->insert($data);//return  row id

        echo $this->view();

    }
    public function load()
    {
        echo $this->view();
    }
    function remove()
    {
        $cart_session=$this->session->userdata('cart_session');
        $row_id = $_POST["row_id"];
        $productid=$_POST["productid"];

        $this->Website_functions_model->removecart($productid,$cart_session);

        $data = array(
            'rowid' => $row_id,
            'qty'    => 0
        );
        $this->cart->update($data);
        echo $this->view();
    }
    function update()
    {
        $cart_session=$this->session->userdata('cart_session');
        $productid = $_POST["product_id"];
        $row_id = $_POST["row_id"];
        $quantity = $_POST["quantity"];

        $this->Website_functions_model->updatecart($productid,$quantity,$cart_session);
        $data = array(
            'rowid' => $row_id,
            'qty'    => $quantity
        );
        $this->cart->update($data);
        echo $this->view();
    }
    function clear(){
        $cart_session=$this->session->userdata('cart_session');
        $this->Website_functions_model->clearcart($cart_session);
        $this->cart->destroy();
        echo $this->view();
    }

    function view()
    {

        $output = '';
        $count = 0;
        foreach ($this->cart->contents() as $items) {
            $count++;
            $output .='

            <tr>
                <td class="row-close close-2" data-title="product-remove">

                <a href="#" class="btn-remove fas fa-times remove_inventory" data-productid="'.$items["id"].'" id="'.$items["rowid"].'"><span class="sr-only">remove</span></a>

                </td>
                <td data-title="Product" class="col01">
                    <div>
                        <div class="pro-name-wrap">

                            <div class="descr-wrap">
                                <h3 class="fw-normal">'.$items["name"].'</h3>
                            </div>
                        </div>
                    </div>
                </td>
                <td data-title="Price">
                    <span><strong class="price element-block"> $'.$items["price"].'</strong></span>
                </td>
                <td>
                <div class="quantity buttons_added">
                <input type="button" value="-" data-rowid="'.$items["rowid"].'" data-qty="'.$items["qty"].'" data-productid="'.$items["id"].'" class="minus btnChangeMinus"><input type="number" step="1" min="1" max="" name="quantity" data-productid="'.$items["id"].'" id="'.$items["rowid"].'" value="'.$items["qty"].'" title="Qty" class="input-text qty text" size="4" pattern="" inputmode="" disabled><input type="button" value="+" data-rowid="'.$items["rowid"].'" class="plus btnChangePlus" data-qty="'.$items["qty"].'" data-productid="'.$items["id"].'">
                </div>
                </td>
                <td data-title="Total"><span><strong class="element-block price"> $'.$items["subtotal"].'</strong></span></td>
            </tr>
            ';

        }
        if($count == 0)
        {
            $output .='
            <tr class="row-3">
            <td colspan="6">Empty</td>
            </tr>';
        }
        $output .='
        <tr class="row-3">
        <td class="row-close close-1" data-title="product-remove">&nbsp;</td>
        <td colspan="3" class="row-img">Total</td>
        <td class="product-total" data-title="Subprice"><p><i class="fa fa-inr"></i>'.$this->cart->total().'</p></td>
        </tr>
        
        <tr>
            <td colspan="3" class="row-img">&nbsp;</td>
            <td  class="text-right btn-actions">
                <div>
                    <a href='.base_url('web/products').' class="btn btn-secondary cont">
                        <i class="fa fa-chevron-left"></i> Continue Shopping</a>
                </div>
            </td>
            <td  class="text-right btn-actions">
                <div>
                    <a href='.base_url('customer-data').' class="btn btn-warning btn-theme font-lato fw-bold text-uppercase element-block">
                        <i class="fa fa-refresh"></i> Proceed to Checkout</a>
                </div>
            </td>
        </tr>

        ';
        
        return $output;
    }

}

/* End of file Shoppingcart.php */
/* Location: ./application/controllers/Shoppingcart.php */
