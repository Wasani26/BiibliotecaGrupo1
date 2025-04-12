<?php

namespace App\Config;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class TokenJwt {

    private $secretKey;

    public function __construct() {
        // Clave secreta //
        $this->secretKey = 'tu_clave_secreta_s_d_y_';
    }

    public function generateTokenJwt(array $payload): string {
        $issuedAt = time();
        $expire = $issuedAt + (60 * 60); // Token expira en 1 hora //

        $payload = array(
            'iat' => $issuedAt,         
            'exp' => $expire,           // Tiempo de expiracion //
            'data' => $payload         // Datos del usuario //
        );

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function verifyTokenJwt(string $token): ?object {
        if (empty($token)) {
            return null;
        }

        try {
            $decoded = JWT::decode($token, new Key($this->secretKey, 'HS256'));
            return $decoded->data;
        } catch (Exception $e) {
            // Log de error //
            error_log("Error verifying token: " . $e->getMessage());
            return null; // Token inválido //
        }
    }

    public function getHeaders(): ?string {
        if (isset($_SERVER['Authorization'])) {
            return trim($_SERVER["Authorization"]);
        } elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) { 
            return trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for cgi environment
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            if (isset($requestHeaders['Authorization'])) {
                return trim($requestHeaders['Authorization']);
            }
        }
        return null;
    }

    public function extractTokenJwt(string $bearerToken): ?string {
        if (preg_match('/Bearer\s(\S+)/', $bearerToken, $matches)) {
            return $matches[1];
        }
        return null;
    }
}