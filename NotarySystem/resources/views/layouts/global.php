<?php
    function alertSuccess($title,$message, $type) {
        switch ($type) {
            case 'success':
                $color='green';
                break;
            case 'error':
                $color='red';
                break;          
            
        }
        echo 
            "<script>    
                iziToast.show({
                    title: '".$title."',
                    message: '".$message."',
                    position: 'bottomRight',
                    color:'".$color."',
                    transitionIn:'fadeInUp'
                })
            </script>";    
    }
?>