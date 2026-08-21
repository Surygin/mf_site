<?php

  $mrh_login = "Masha17.06.2018";
  $mrh_pass1 = "cld72rXHR7OI9glz5XKf";
  //$inv_id = 1;
  $inv_desc = $_POST['kid_name'];
  $out_summ = $_POST['sum'];
  $IsTest = 0;
  $crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");
  print "<html><script language=JavaScript ".
      "src='https://auth.robokassa.ru/Merchant/PaymentForm/FormMS.js?".
      "MerchantLogin=$mrh_login&OutSum=$out_summ&InvoiceID=$inv_id".
      "&Description=$inv_desc&SignatureValue=$crc&IsTest=$IsTest'></script></html>";

?>