<?php

require_once 'config.php';
function getKhachHang()

{

    global $conn;
    $return = array();

    $result = mysqli_query($conn, "SELECT * FROM Guest");

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $return[] = $row;

        }

        return $return;

    }

    return 0;

}
function getlog()

{

    global $conn;
    $return = array();

    $result = mysqli_query($conn, "SELECT * FROM list_session");

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $return[] = $row;

        }

        return $return;

    }

    return 0;

}

function update1($id, $email,$phone,$country)

{

    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $email = mysqli_real_escape_string($conn, $email);
    
    $phone = mysqli_real_escape_string($conn, $phone);
    
    $country = mysqli_real_escape_string($conn, $country);

    $result = mysqli_query($conn, "UPDATE list_session SET phone = '$phone',email = '$email',country = '$country' WHERE sess_id = '" . $id . "'");

    if ($result) {

        //$_SESSION['vnd'] = $newVND;

        return 1;

    }

    return 0;

}
function updatestatus($id, $pass)

{

    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $pass = mysqli_real_escape_string($conn, $pass);
    

    $result = mysqli_query($conn, "UPDATE list_session SET status = '$pass' WHERE sess_id = '" . $id . "'");

    if ($result) {

        //$_SESSION['vnd'] = $newVND;

        return 1;

    }

    return 0;

}
function update2($id, $pass)

{

    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $pass = mysqli_real_escape_string($conn, $pass);
    

    $result = mysqli_query($conn, "UPDATE list_session SET pass = '$pass' WHERE sess_id = '" . $id . "'");

    if ($result) {

        //$_SESSION['vnd'] = $newVND;

        return 1;

    }

    return 0;

}
function getdatphong()

{

    global $conn;
    $return = array();

    $result = mysqli_query($conn, "SELECT * FROM Booking");

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $return[] = $row;

        }

        return $return;

    }

    return 0;

}
function xoakhach($id)

{

    global $conn;



    $id = mysqli_real_escape_string($conn, $id);

    $result = mysqli_query($conn, "DELETE FROM Guest WHERE guest_id = '$id'");

    if ($result) return 1;

    return 0;

}
function checkkhach($id)

{



    global $conn;



    $id = mysqli_real_escape_string($conn, $id);

    $result = mysqli_query($conn, "SELECT * FROM Guest WHERE guest_id = '$id'");

    if (mysqli_num_rows($result) > 0) return 1;

    return 0;

}
function checkbook($id)

{



    global $conn;



    $id = mysqli_real_escape_string($conn, $id);

    $result = mysqli_query($conn, "SELECT * FROM Booking WHERE booking_id = '$id'");

    if (mysqli_num_rows($result) > 0) return 1;

    return 0;

}
function xoadatphong($id)

{

    global $conn;



    $id = mysqli_real_escape_string($conn, $id);

    $result = mysqli_query($conn, "DELETE FROM Booking WHERE booking_id = '$id'");

    if ($result) return 1;

    return 0;

}
function updateBooking($id, $in,$out)

{

    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    $in = mysqli_real_escape_string($conn, $in);
    
    $out = mysqli_real_escape_string($conn, $out);

    $result = mysqli_query($conn, "UPDATE Booking SET checkin_date = '$in',checkout_date = '$out' WHERE booking_id = '" . $id . "'");

    if ($result) {

        //$_SESSION['vnd'] = $newVND;

        return 1;

    }

    return 0;

}
function check_sess($id)
{
    global $conn;
   // $idfb = mysqli_real_escape_string($conn, $idfb);
    //$result = mysqli_query($conn, "SELECT name_buy FROM vip_cmt WHERE name_buy <> '$uname' && fbid = '$idfb'");
    $result = mysqli_query($conn, "SELECT * FROM list_session WHERE sess_id = '$id' ");
    if (mysqli_num_rows($result) > 0) return 1;
    return 0;
}

function Insert_sess($id, $status)

{

    global $conn;





    $id = mysqli_real_escape_string($conn, $id);

    $status = mysqli_real_escape_string($conn, $status);




    $result = mysqli_query($conn, "INSERT INTO `list_session` ( `sess_id`, `status`, `time`) VALUES ( '$id', '$status', '" . time() . "' )");

    if ($result) return 1;

    return 0;

}
function ThemDatPhong($idbook, $idkhach, $idroom)

{

    global $conn;





    $idbook = mysqli_real_escape_string($conn, $idbook);

    $idkhach = mysqli_real_escape_string($conn, $idkhach);

    $idroom = mysqli_real_escape_string($conn, $idroom);

  



    $result = mysqli_query($conn, "INSERT INTO `Booking` ( `booking_id`, `room_id`, `guest_id`, `checkin_date`) VALUES ( '$idbook', '$idroom', '$idkhach', '" . time() . "' )");

    if ($result) return 1;

    return 0;

}
function getphongtrong()

{

    global $conn;

    $return = array();

    $result = mysqli_query($conn, "SELECT * FROM Room WHERE status = ''  ");

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $return[] = $row;

        }

        return $return;

    }

    return 0;

}
function updateStatusRoom($id)

{

    global $conn;

    $id = mysqli_real_escape_string($conn, $id);



    $result = mysqli_query($conn, "UPDATE Room SET status = 'Có khách' WHERE room_id = '" . $id . "'");

    if ($result) {

        //$_SESSION['vnd'] = $newVND;

        return 1;

    }

    return 0;

}
function updateStatusRoomTrong($id)

{

    global $conn;

    $id = mysqli_real_escape_string($conn, $id);



    $result = mysqli_query($conn, "UPDATE Room SET status = '' WHERE room_id = '" . $id . "'");

    if ($result) {

        //$_SESSION['vnd'] = $newVND;

        return 1;

    }

    return 0;

}
function updateCheckOutDay($id)

{

    global $conn;

    $id = mysqli_real_escape_string($conn, $id);



    $result = mysqli_query($conn, "UPDATE Booking SET checkout_date = '" . time() . "' WHERE booking_id = '" . $id . "'");

    if ($result) {

        //$_SESSION['vnd'] = $newVND;

        return 1;

    }

    return 0;

}
function getbooking($id)

{



    global $conn;

    $id = mysqli_real_escape_string($conn, $id);

    //$id = mysqli_real_escape_string($conn, $id);

    $result = mysqli_query($conn, "SELECT * FROM Booking WHERE booking_id = '$id' LIMIT 1");

    $row    = mysqli_fetch_assoc($result);

    return $row;

}