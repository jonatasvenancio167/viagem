<?php
class Utils {
    public function verificaData($date){
        return (DateTime::createFromFormat('m/d/Y', $date) !== false);
    }
}
?>