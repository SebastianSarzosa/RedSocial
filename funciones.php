<?php
function AntiCSRF() {
    if (!isset($_POST['btnAccion'])) {
       $_SESSION['AntiCSRF'] = md5(random_int(10000, 100000));
       return;
   }
   if (!isset($_POST['_csrf']) || $_POST['_csrf'] != $_SESSION['AntiCSRF']) {
       echo 'Su solicitud no puede ser tramitada';
       http_response_code(404);
       exit();
   }
   $_SESSION['AntiCSRF'] = md5(random_int(10000, 100000));
}

function GenerarAnctiCSRF(){
   $_SESSION['AntiCSRF'] = md5(random_int(10000, 100000));
   return $_SESSION['AntiCSRF'];
}
?>