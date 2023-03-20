
<?php
    function validatePassword($password) {
        $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        return preg_match($pattern, $password);
    }
    
    function validateEmail($email, $type) {
        if ($type == 1) {
            $pattern = '/^[a-zA-Z0-9._%+-]+@edu\.ece\.fr$/';
        } elseif ($type == 2) {
            $pattern = '/^[a-zA-Z0-9._%+-]+@(ece\.fr|omnesintervenant\.com)$/';
        } else {
            return false;
        }
        return preg_match($pattern, $email);
    }
?>