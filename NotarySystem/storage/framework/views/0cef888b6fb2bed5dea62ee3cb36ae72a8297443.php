<?php
foreach ($transactions as $key => $transaction) {
    

header("Content-Type:".$transaction->mime);
if(($transaction->mime)=="image/jpeg"){
    echo '<img src="data:image/jpeg;base64,'.base64_encode($transaction->generatedContract).'"/>';
}

if(($transaction->mime)=="application/pdf") {
//     $file='storage/images/'.$transaction->name;
//    $filename=$transaction->name;
//    header("Content-Type:".$transaction->mime);
//    header('Content-Disposition:inline; filename="'.$filename .'"');
//    header('Content-Transfer-Encoding:binary');
//    header('Accept-Ranges:bytes');
//   @readfile($file);
echo $transaction->generatedContract;


}
if(($transaction->mime)=="image/png"){
    echo '<img src="data:image/png;base64,'.base64_encode($transaction->generatedContract).'"/>';
}
//echo '<img src="data:image/jpeg;base64,'.base64_encode($row['data']).'"/>';
}

?>