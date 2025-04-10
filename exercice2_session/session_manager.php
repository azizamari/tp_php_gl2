<?php
class SessionManager {
    
    public function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    
    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    
    public function get($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

 
    public function remove($key) {
        unset($_SESSION[$key]);
    }

    
    public function destroy() {
        session_unset();
        session_destroy();
    }
}
?>

