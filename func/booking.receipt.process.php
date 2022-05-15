<?php
    include("database-connect.func.php");
    include("booking.func.php");
    if(isset($_POST['card_submit'])) {
        $ticket_id = $_POST['ticket_id'];
        init_creditCard($conn,$_POST['receipt'],$_POST['pay_method'],$_POST['discount'],
        $_POST['subtotal'],$_POST['tax'],$_POST['cardno'],$_POST['cardname'],$_POST['cardexp'],$_POST['cvv']);
        book($conn,$ticket_id,$_POST['passportno'],$_POST['receipt']);
        header("location:../back.card.receipt.php?id=$ticket_id");
    }
    else if(isset($_POST['scb_submit'])) {
        $ticket_id = $_POST['ticket_id'];
        init_Bank_Counter($conn,$_POST['receipt'],$_POST['pay_method'],$_POST['discount'],
        $_POST['subtotal'],$_POST['tax']);
        book($conn,$_POST['ticket_id'],$_POST['passportno'],$_POST['receipt']);
        header("location:../back.bank.receipt.php?id=$ticket_id");
    }
    else if(isset($_POST['counter_submit'])) {
        init_Bank_Counter($conn,$_POST['receipt'],$_POST['pay_method'],$_POST['discount'],
        $_POST['subtotal'],$_POST['tax']);
        book($conn,$_POST['ticket_id'],$_POST['passportno'],$_POST['receipt']);
        header("location:../back.bank.receipt.php?id=$ticket_id");
    }
    else {
        echo "You're not supposed to be here!";
    }
?>