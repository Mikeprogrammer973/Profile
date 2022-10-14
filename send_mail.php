<?php

 $tipo_mail = $_REQUEST["tipo"];
 
 if($tipo_mail == "sim"){
   // code...
   $from = $_REQUEST["from"];
   $to = "mikepascal.delta@gmail.com";
   $sbj = "Mike Portafólio";
   $msg = "<h1>New Portofólio Message:</h1>";
   $msg .= "<p>".$_REQUEST["msg"]."</p>";
   $header = "From:$from \r\n";
   $header .= "Cc: mikepascaleleven@gmail.com \r\n";
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-type: text/html\r\n";
   $sent = mail($to,$sbj,$msg,$header);
   
   if($sent){
     header("location:index.php?info=Mensagem enviada com sucesso!");
   }else{
     header("location:index.php?info=Erro ao enviar a mensagem, tente mais tarde!");
   }
   
 }elseif ($tipo_mail == "com") {
   // code...
   $from = $_REQUEST["email"];
   $to = "mikepascal.delta@gmail.com";
   $email_= "Cliente: ".$_REQUEST["nome_cli"]."\nContato: ".$_REQUEST["cel"]."\n";
   $email_ .= "Mensagem: ".$_REQUEST["desc-t"]."\n";
   
   $sbj = "Pedido de orçamento";
   
   @$filea = $_REQUEST["desc-pdf"];

  if(@$filea)
  {
    move_uploaded_file($_FILES["desc_pdf"]["tmp_name"],"../Tmp".basename($_FILES["desc_pdf"]["name"]));
    
    function send_mail($from,$to,$sbj,$msg,$att)
    {
      $fileatt = $att;//Caminho do arquivo
      $fileatt_type = "application/octet-stream";//Tipo do arquivo 
      $init = strrpos($att,"/") == -1?strrchr($att,"//"):strrpos($att,"/")+1;//Ponto inicial da leitura do arquivo
      $fileatt_name = substr($att,$init,strlen($att));//Novo nome do arquivo 
      $email_from = $from;//Quem enviou o email
      $email_subject = $sbj;//Assunto do email
      $email_txt = $msg;//Mensagem do email
      $email_to = $to;//Destinatario da mensagem
      $headers = "From:".$email_from;
      
      //Leitura do arquivo 
      $file = fopen($fileatt,"r");
      $data = fread($file,$init,filesize($fileatt));
      fclose($file);
      //
      
      $msg_txt = "\n\nVocê recebeu uma nova mensagem de $from";
      $semi_rand = md5(time());
      $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
      $headers .= "\nMIME-Version:1.0\n"."Content-type:multipart/mixed;\n"."boundary:\"{$mime_boundary}\"";
      
      $email_txt .= $msg_txt;
      $email_msg = "This a multi-part message in MIME format.\n\n"."--{$mime_boundary}\n"."Content-type:text/html;charset= \"iso-8859-1\"\n"."Content-Transfer-Encoding:7bit\n\n".$email_txt."\n\n";
      
      $data = chunk_split(base64_encode($data));
      $email_msg .= "--{$mime_boundary}\n"."Content-type:{$fileatt_type}\n"."name:\"{$fileatt_name}\"\n"."Content-Disposition:attachment;\n"."filename:\"{$fileatt_name}\"\n"."Content-Transfer-Encodig:
      base64\n\n".$data."\n\n"."--{$mime_boundary}--\n";
      
      $sent = mail($email_to,$email_subject,$email_msg,$headers);
      
      if($sent){
        mail($from,"Pedido de orçamento","O seu pedido de orçamento está em análise, receberás o resultado em breve!\n\nCordialmente, Mike D. Pascal\n","From:$to\r\nCc: mikepascaleleven@gmail.com\r\nMIME-Version:1.0\r\nContent-type:text/html\r\n");
        header("location:index.php?info=Pedido de orçamento enviado com sucesso! Obterás a sua resposta em breve!");
        unlink($att);
      }else{
        header("location:index php?info=Erro ao enviar o pedido, tente mais tarde!");
      }
      
    }
    
    send_mail($from,$to,$sbj,$email_,("Tmp".$_FILES["e
    desc-pdf"]["name"]));
  }else{
    $sent = mail($to,$sbj,$email_,"From:$from\r\nCc: mikepascaleleven@gmail.com\r\nMIME-Version:1.0\r\tContent-type:text/html\r\n");
    if($sent){
        mail($from,"Pedido de orçamento","O seu pedido de orçamento está em análise, receberás o resultado em breve!\n\nCordialmente, Mike D. Pascal\n","From:$to\r\nCc: mikepascaleleven@gmail.com\r\nMIME-Version:1.0\r\nContent-type:text/html\r\n");
        header("location:index.php?info=Pedido de orçamento enviado com sucesso! Obterás a sua resposta em breve!");
      }else{
        header("location:index php?info=Erro ao enviar o pedido, tente mais tarde!");
      }
  }
  
 }

?>
