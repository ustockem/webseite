<?php
// Session starten, falls noch nicht aktiv
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

/**
 * Prüft, ob der eingeloggte Benutzer Adminrechte hat.
 *
 * @return bool true, wenn Rolle 'admin', sonst false
 */
function isAdmin(): bool {
  return isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
}

/**
 * Optional: Prüfen, ob ein Benutzer eingeloggt ist
 *
 * @return bool true, wenn eine user_id existiert
 */
function isLoggedIn(): bool {
  return isset($_SESSION['user_id']);
}