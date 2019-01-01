<?php
foreach ($transactions as $key => $transaction) {
    
$id=$transaction->id;
header("Content-Type:".$transaction->mime);
if(($transaction->mime)=="image/jpeg"){
    echo '<img src="data:image/jpeg;base64,'.base64_encode($transaction->generatedContract).'"/>';
}

if(($transaction->mime)=="application/pdf") {

header("Content-Type:".$transaction->mime);
return response()->download(storage_path($buyer->firstname.$buyer->lastname.'.docx'));
// echo $transaction->generatedContract;

}
if(($transaction->mime)=="image/png"){
    echo '<img src="data:image/png;base64,'.base64_encode($transaction->generatedContract).'"/>';
}

}

?>