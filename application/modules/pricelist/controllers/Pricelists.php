<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pricelists extends MX_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('login', 'refresh');
        }

        $this->load->model('pricelist');
    }

    public function index() {
        $data['add_access'] = $this->user_profile->get_user_access('Created', 'pricelist');
        $data['print_limited_access'] = $this->user_profile->get_user_access('PrintLimited', 'pricelist');
        $data['print_unlimited_access'] = $this->user_profile->get_user_access('PrintUnlimited', 'pricelist');
        $data['products'] = Product::where('deleted', '0')->get();
        $this->load->blade('pricelist.views.pricelist.page', $data);
    }

    public function fetch_data() {
        $database_columns = array(
            't_pricelist.id',
            'product_code',
            'm_product.name',
            'barcode_product',
            'barcode_carton',
            'packing_size',
            'qty',
            'length',
            'height',
            'width',
            'volume',
            'weight',
            'normal_price',
            'company_before_tax_pcs',
            'company_before_tax_ctn',
            'company_after_tax_pcs',
            'company_after_tax_ctn',
            'stock_availibility',
            'dipo_discount',
            'dipo_before_tax_pcs',
            'dipo_before_tax_ctn',
            'dipo_after_tax_pcs',
            'dipo_after_tax_ctn',
            'dipo_after_tax_round_up',
            'mitra_discount',
            'mitra_before_tax_pcs',
            'mitra_before_tax_ctn',
            'mitra_after_tax_pcs',
            'mitra_after_tax_ctn',
            'mitra_after_tax_round_up',
            'customer_discount',
            'customer_before_tax_pcs',
            'customer_before_tax_ctn',
            'customer_after_tax_pcs',
            'customer_after_tax_ctn',
            'customer_after_tax_round_up',
            'het_round_up_pcs',
            'het_round_up_ctn',
            't_pricelist.date_created',
        );

        $header_columns = array(
            'product_code',
            'm_product.name',
            'barcode_product',
            'barcode_carton',
            'packing_size',
            'qty',
            'length',
            'height',
            'width',
            'volume',
            'weight',
            'company_before_tax_pcs',
            'company_before_tax_ctn',
            'company_after_tax_pcs',
            'company_after_tax_ctn',
            'stock_availibility',
            'dipo_discount',
            'dipo_before_tax_pcs',
            'dipo_before_tax_ctn',
            'dipo_after_tax_pcs',
            'dipo_after_tax_ctn',
            'dipo_after_tax_round_up',
            'mitra_discount',
            'mitra_before_tax_pcs',
            'mitra_before_tax_ctn',
            'mitra_after_tax_pcs',
            'mitra_after_tax_ctn',
            'mitra_after_tax_round_up',
            'customer_discount',
            'customer_before_tax_pcs',
            'customer_before_tax_ctn',
            'customer_after_tax_pcs',
            'customer_after_tax_ctn',
            'customer_after_tax_round_up',
            'het_round_up_pcs',
            'het_round_up_ctn',
            't_pricelist.date_created',
        );

        $from = "t_pricelist";
        $where = "t_pricelist.deleted = 0";
        $order_by = $header_columns[$this->input->get('iSortCol_0')] . " " . $this->input->get('sSortDir_0');
        $join[] = array('m_product', 'm_product.id = t_pricelist.product_id', 'inner');

        if ($this->input->get('sSearch') != '') {
            $sSearch = str_replace(array('.', ','), '', $this->db->escape_str($this->input->get('sSearch')));
            if((bool)strtotime($sSearch)){
                $sSearch = date('Y-m-d',strtotime($sSearch));
            }
            $where .= " AND (";
            $where .= "m_product.name LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.product_code LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.barcode_product LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.barcode_carton LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.packing_size LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.qty LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.length LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.height LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.width LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.volume LIKE '%" . $sSearch . "%' OR ";
            $where .= "m_product.weight LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.normal_price LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.company_before_tax_pcs LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.company_before_tax_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.company_after_tax_pcs LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.company_after_tax_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.stock_availibility LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.dipo_discount LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.dipo_before_tax_pcs LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.dipo_before_tax_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.dipo_after_tax_pcs LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.dipo_after_tax_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.dipo_after_tax_round_up LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.mitra_discount LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.mitra_before_tax_pcs LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.mitra_before_tax_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.mitra_after_tax_pcs LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.mitra_after_tax_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.mitra_after_tax_round_up LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.customer_discount LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.customer_before_tax_pcs LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.customer_before_tax_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.customer_after_tax_pcs LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.customer_after_tax_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.customer_after_tax_round_up LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.het_round_up_pcs LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.het_round_up_ctn LIKE '%" . $sSearch . "%' OR ";
            $where .= "t_pricelist.date_created LIKE '%" . $sSearch . "%'";
            $where .= ")";
        }

        $this->datatables->set_index('t_pricelist.id');
        $this->datatables->config('database_columns', $database_columns);
        $this->datatables->config('from', $from);
        $this->datatables->config('join', $join);
        $this->datatables->config('where', $where);
        $this->datatables->config('order_by', $order_by);
        $selected_data = $this->datatables->get_select_data();
        $aa_data = $selected_data['aaData'];
        $new_aa_data = array();
        
        foreach ($aa_data as $row) {
            $row_value = array();

            $btn_action = '';
            if($this->user_profile->get_user_access('Updated', 'pricelist')){
                $btn_action .= '<a href="javascript:void()" onclick="viewData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-warning btn-icon-only btn-circle" data-toggle="ajaxModal" title="' . lang('update') . '"><i class="fa fa-edit"></i> </a>';
            }
            if($this->user_profile->get_user_access('Deleted', 'pricelist')){
                $btn_action .= '<a href="javascript:void()" onclick="deleteData(\'' . uri_encrypt($row->id) . '\')" class="btn btn-danger btn-icon-only btn-circle" title="' . lang('delete') . '"><i class="fa fa-trash-o"></i></a>';
            }

            $row_value[] = $row->product_code;
            $row_value[] = $row->barcode_product;
            $row_value[] = $row->barcode_carton;
            $row_value[] = $row->name;
            $row_value[] = $row->packing_size;
            $row_value[] = $row->qty;
            $row_value[] = $row->length;
            $row_value[] = $row->width;
            $row_value[] = $row->height;
            $row_value[] = $row->volume;
            $row_value[] = $row->weight;
            $row_value[] = $row->normal_price;
            $row_value[] = $row->company_before_tax_pcs;
            $row_value[] = $row->company_before_tax_ctn;
            $row_value[] = $row->company_after_tax_pcs;
            $row_value[] = $row->company_after_tax_ctn;
            $row_value[] = $row->stock_availibility;
            $row_value[] = $row->dipo_discount;
            $row_value[] = $row->dipo_before_tax_pcs;
            $row_value[] = $row->dipo_before_tax_ctn;
            $row_value[] = $row->dipo_after_tax_pcs;
            $row_value[] = $row->dipo_after_tax_ctn;
            $row_value[] = $row->dipo_after_tax_round_up;
            $row_value[] = $row->mitra_discount;
            $row_value[] = $row->mitra_before_tax_pcs;
            $row_value[] = $row->mitra_before_tax_ctn;
            $row_value[] = $row->mitra_after_tax_pcs;
            $row_value[] = $row->mitra_after_tax_ctn;
            $row_value[] = $row->mitra_after_tax_round_up;
            $row_value[] = $row->customer_discount;
            $row_value[] = $row->customer_before_tax_pcs;
            $row_value[] = $row->customer_before_tax_ctn;
            $row_value[] = $row->customer_after_tax_pcs;
            $row_value[] = $row->customer_after_tax_ctn;
            $row_value[] = $row->customer_after_tax_round_up;
            $row_value[] = $row->het_round_up_pcs;
            $row_value[] = $row->het_round_up_ctn;
            $row_value[] = date('d-m-Y',strtotime($row->date_created));
            $row_value[] = $btn_action;
            
            $new_aa_data[] = $row_value;
        }
        
        $selected_data['aaData'] = $new_aa_data;
        $this->output->set_content_type('application/json')->set_output(json_encode($selected_data));
    }

    public function save() {
        if ($this->input->is_ajax_request()) {
            $user = $this->ion_auth->user()->row();
            $id_pricelist = $this->input->post('id');
           if (empty($id_pricelist)) {
                if (!empty($get_pricelist->product_id)) {
                    $status = array('status' => 'unique', 'message' => lang('already_exist'));
                }else{
                    $product_id = $this->input->post('product_id');
                    $normal_price = $this->input->post('normal_price');
                    $company_before_tax_pcs = $this->input->post('company_before_tax_pcs');
                    $company_before_tax_ctn = $this->input->post('company_before_tax_ctn');
                    $company_after_tax_pcs = $this->input->post('company_after_tax_pcs');
                    $company_after_tax_ctn = $this->input->post('company_after_tax_ctn');
                    $stock_availibility = $this->input->post('stock_availibility');
                    $dipo_discount = $this->input->post('dipo_discount');
                    $dipo_before_tax_pcs = $this->input->post('dipo_before_tax_pcs');
                    $dipo_before_tax_ctn = $this->input->post('dipo_before_tax_ctn');
                    $dipo_after_tax_pcs = $this->input->post('dipo_after_tax_pcs');
                    $dipo_after_tax_ctn = $this->input->post('dipo_after_tax_ctn');
                    $dipo_after_tax_round_up = $this->input->post('dipo_after_tax_round_up');
                    $mitra_discount = $this->input->post('mitra_discount');
                    $mitra_before_tax_pcs = $this->input->post('mitra_before_tax_pcs');
                    $mitra_before_tax_ctn = $this->input->post('mitra_before_tax_ctn');
                    $mitra_after_tax_pcs = $this->input->post('mitra_after_tax_pcs');
                    $mitra_after_tax_ctn = $this->input->post('mitra_after_tax_ctn');
                    $mitra_after_tax_round_up = $this->input->post('mitra_after_tax_round_up');
                    $customer_discount = $this->input->post('customer_discount');
                    $customer_before_tax_pcs = $this->input->post('customer_before_tax_pcs');
                    $customer_before_tax_ctn = $this->input->post('customer_before_tax_ctn');
                    $customer_after_tax_pcs = $this->input->post('customer_after_tax_pcs');
                    $customer_after_tax_ctn = $this->input->post('customer_after_tax_ctn');
                    $customer_after_tax_round_up = $this->input->post('customer_after_tax_round_up');
                    $het_round_up_pcs = $this->input->post('het_round_up_pcs');
                    $het_round_up_ctn = $this->input->post('het_round_up_ctn');

                    $model = new Pricelist();
                    $model->product_id = $product_id;
                    $model->normal_price = $normal_price;
                    $model->company_before_tax_pcs = $company_before_tax_pcs;
                    $model->company_before_tax_ctn = $company_before_tax_ctn;
                    $model->company_after_tax_pcs = $company_after_tax_pcs;
                    $model->company_after_tax_ctn = $company_after_tax_ctn;
                    $model->stock_availibility = $stock_availibility;
                    $model->dipo_discount = $dipo_discount;
                    $model->dipo_before_tax_pcs = $dipo_before_tax_pcs;
                    $model->dipo_before_tax_ctn = $dipo_before_tax_ctn;
                    $model->dipo_after_tax_pcs = $dipo_after_tax_pcs;
                    $model->dipo_after_tax_ctn = $dipo_after_tax_ctn;
                    $model->dipo_after_tax_round_up = $dipo_after_tax_round_up;
                    $model->mitra_discount = $mitra_discount;
                    $model->mitra_before_tax_pcs = $mitra_before_tax_pcs;
                    $model->mitra_before_tax_ctn = $mitra_before_tax_ctn;
                    $model->mitra_after_tax_pcs = $mitra_after_tax_pcs;
                    $model->mitra_after_tax_ctn = $mitra_after_tax_ctn;
                    $model->mitra_after_tax_round_up = $mitra_after_tax_round_up;
                    $model->customer_discount = $customer_discount;
                    $model->customer_before_tax_pcs = $customer_before_tax_pcs;
                    $model->customer_before_tax_ctn = $customer_before_tax_ctn;
                    $model->customer_after_tax_pcs = $customer_after_tax_pcs;
                    $model->customer_after_tax_ctn = $customer_after_tax_ctn;
                    $model->customer_after_tax_round_up = $customer_after_tax_round_up;
                    $model->het_round_up_pcs = $het_round_up_pcs;
                    $model->het_round_up_ctn = $het_round_up_ctn;

                    $model->user_created = $user->id;
                    $model->date_created = date('Y-m-d');
                    $model->time_created = date('H:i:s');
                    $save = $model->save();

                    $product_name = Product::find($product_id)->name;

                    if ($save) {
                        $data_notif = array(
                            'Product'                           => $product_name,
                            'Normal Price'                      => $normal_price,
                            'Company Before Tax in Pcs'         => $company_before_tax_pcs,
                            'Company Before Tax in Ctn'         => $company_before_tax_ctn,
                            'Company After Tax in Pcs'          => $company_after_tax_pcs,
                            'Company After Tax in Pcs'          => $company_after_tax_ctn,
                            'Stock Availibility'                => $stock_availibility,
                            'Dipo Discount'                     => $dipo_discount,
                            'Dipo Before Tax in Pcs'            => $dipo_before_tax_pcs,
                            'Dipo Before Tax in Ctn'            => $dipo_before_tax_ctn,
                            'Dipo After Tax in Pcs'             => $dipo_after_tax_pcs,
                            'Dipo After Tax in Pcs'             => $dipo_after_tax_ctn,
                            'Dipo After Tax Round Up in Ctn'    => $dipo_after_tax_round_up,
                            'Mitra Discount'                    => $mitra_discount,
                            'Mitra Before Tax in Pcs'           => $mitra_before_tax_pcs,
                            'Mitra Before Tax in Ctn'           => $mitra_before_tax_ctn,
                            'Mitra After Tax in Pcs'            => $mitra_after_tax_pcs,
                            'Mitra After Tax in Pcs'            => $mitra_after_tax_ctn,
                            'Mitra After Tax Round Up in Ctn'   => $mitra_after_tax_round_up,
                            'Customer Discount'                 => $customer_discount,
                            'Customer Before Tax in Pcs'        => $customer_before_tax_pcs,
                            'Customer Before Tax in Ctn'        => $customer_before_tax_ctn,
                            'Customer After Tax in Pcs'         => $customer_after_tax_pcs,
                            'Customer After Tax in Pcs'         => $customer_after_tax_ctn,
                            'Customer After Tax Round Up in Ctn'=> $customer_after_tax_round_up,
                            'HET Round Up in Pcs'               => $het_round_up_pcs,
                            'HET Round Up in Ctn'               => $het_round_up_ctn,
                        );
                        $message = "Add " . strtolower(lang('pricelist')) . " " . $product_name . " succesfully by " . $user->full_name;
                        $this->activity_log->create($user->id, json_encode($data_notif), NULL, NULL, $message, 'C', 4);
                        $status = array('status' => 'success', 'message' => lang('message_save_success'));
                    } else {
                        $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                    }
                }
            } elseif(!empty($id_pricelist)) {
                $model = Pricelist::find($id_pricelist);
                $name = ucwords($this->input->post('name'));
                $category_id = $this->input->post('category_id');
                $product_code = $this->input->post('product_code');
                $description = $this->input->post('description');
                $feature = $this->input->post('feature');
                $barcode_product = $this->input->post('barcode_product');
                $barcode_carton = $this->input->post('barcode_carton');
                $packing_size = $this->input->post('packing_size');
                $qty = $this->input->post('qty');
                $weight = $this->input->post('weight');
                $length = $this->input->post('length');
                $width = $this->input->post('width');
                $height = $this->input->post('height');
                $volume = $this->input->post('volume');
            
                $data_old = array(
                    'Name'            => $model->name,
                    'Category'        => $model->category_id,
                    'Product Code'    => $model->product_code,
                    'Description'     => $model->description,
                    'Feature'         => $model->feature,
                    'Barcode Product' => $model->barcode_product,
                    'Barcode Carton'  => $model->barcode_carton,
                    'Packing Size'    => $model->packing_size,
                    'Qty'             => $model->qty,
                    'Length'     => $model->length,
                    'Height'     => $height,
                    'Width'     => $width,
                    'Volume'   => $volume,
                    'Weight'          => $weight,
                );

                $model->name            = $name;
                $model->category_id     = $category_id;
                $model->product_code    = $product_code;
                $model->description     = $description;
                $model->feature         = $feature;
                $model->barcode_product = $barcode_product;
                $model->barcode_carton  = $barcode_carton;
                $model->packing_size    = $packing_size;
                $model->qty             = $qty;
                $model->length          = $length;
                $model->height          = $height;
                $model->width           = $width;
                $model->volume          = $volume;
                $model->weight          = $weight;

                $model->user_modified = $user->id;
                $model->date_modified = date('Y-m-d');
                $model->time_modified = date('H:i:s');
                $update = $model->save();

                if ($update) {
                    $data_new = array(
                        'Name'            => $name,
                        'Category'        => $category_id,
                        'Product Code'    => $product_code,
                        'Description'     => $description,
                        'Feature'         => $feature,
                        'Barcode Product' => $barcode_product,
                        'Barcode Carton'  => $barcode_carton,
                        'Packing Size'    => $packing_size,
                        'Qty'             => $qty,
                        'Length'          => $length,
                        'Height'          => $height,
                        'Width'           => $width,
                        'Volume'          => $volume,
                        'Weight'          => $weight,
                    );

                    $data_change = array_diff_assoc($data_new, $data_old);
                    $message = "Update " . strtolower(lang('pricelist')) . " " .  $model->name . " succesfully by " . $user->full_name;
                    $this->activity_log->create($user->id, json_encode($data_new), json_encode($data_old), json_encode($data_change), $message, 'U', 4);
                    $status = array('status' => 'success', 'message' => lang('message_save_success'));
                } else {
                    $status = array('status' => 'error', 'message' => lang('message_save_failed'));
                }
            } else {
                $status = array('status' => 'error', 'message' => lang('message_save_failed'));
            }
            $data = $status;
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
    
    public function view() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $model = array('status' => 'success', 'data' => Product::find($id));
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function getProductData() {
        if ($this->input->is_ajax_request()) {
            $id = (int)$this->input->get('id');
            $model = array('status' => 'success', 'data' => Product::find($id));
        } else {
            $model = array('status' => 'error', 'message' => 'Not Found.');
        }
        $data = $model;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function delete() {
        if ($this->input->is_ajax_request()) {
            $id = (int) uri_decrypt($this->input->get('id'));
            $user = $this->ion_auth->user()->row();
            $model = Product::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Name'            => $model->name,
                    'Category'        => Product::find($category_id)->name,
                    'Product Code'    => $model->product_code,
                    'Description'     => $model->description,
                    'Feature'         => $model->feature,
                    'Barcode Product' => $barcode_product,
                    'Barcode Carton'  => $barcode_carton,
                    'Packing Size'    => $packing_size,
                    'Qty'             => $qty,
                    'Length'          => $length,
                    'Height'          => $height,
                    'Width'           => $width,
                    'Volume'          => $volume,
                    'Weight'          => $weight,
                );
                $message = "Delete " . strtolower(lang('pricelist')) . " " .  $model->name . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 4);
                $status = array('status' => 'success');
            } else {
                $status = array('status' => 'error');
            }
        } else {
            $status = array('status' => 'error');
        }
        $data = $status;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function deleteImage() {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->get('id');
            $user = $this->ion_auth->user()->row();
            $model = ProductImage::find($id);
            if (!empty($model)) {
                $model->deleted = 1;
                $model->user_deleted = $user->id;
                $model->date_deleted = date('Y-m-d');
                $model->time_deleted = date('H:i:s');
                $delete = $model->save();

                $data_notif = array(
                    'Image' => $model->image,
                );
                $message = "Delete " . strtolower(lang('pricelist')) . " " .  $model->image . " succesfully by " . $user->full_name;
                $this->activity_log->create($user->id, NULL, json_encode($data_notif), NULL, $message, 'D', 4);
                $status = array('status' => 'success');
            } else {
                $status = array('status' => 'error');
            }
        } else {
            $status = array('status' => 'error');
        }
        $data = $status;
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function pdf(){
        $data['pricelists'] = Product::where('t_pricelist.deleted', 0)->orderBy('id', 'DESC')->get();
        $html = $this->load->view('pricelist/pricelist/pricelist_pdf', $data, true);
        $this->pdf_generator->generate($html, 'pricelist pdf', $orientation='Portrait');
    }

    function excel(){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=pricelist.xls");
        $data['pricelists'] = Product::where('deleted', 0)->orderBy('id', 'DESC')->get();
        $this->load->view('pricelist/pricelist/pricelist_pdf', $data);
    }

}